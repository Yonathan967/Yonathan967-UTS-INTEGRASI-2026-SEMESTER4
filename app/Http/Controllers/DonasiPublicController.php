<?php

namespace App\Http\Controllers;

use App\Models\DonasiPertanian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class DonasiPublicController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);
        \Midtrans\Config::$isSanitized  = true;
        \Midtrans\Config::$is3ds        = true;
    }

    // [UPDATED] Tambah $topDonatur, $allDonaturTicker, $targetDonasi
    public function index()
    {
        // Donasi terbaru (status success)
        $recentDonations = DonasiPertanian::success()
            ->latest('created_at')
            ->take(6)
            ->get();

        // Stats total
        $totalDonasi  = DonasiPertanian::success()->sum('jumlah');
        $totalDonatur = DonasiPertanian::success()->count();

        // Target donasi bulan ini (ubah sesuai kebutuhan)
        $targetDonasi = 500000;

        // Top donatur dikelompok per nama, jumlah terbesar di atas (untuk podium)
        $topDonatur = DonasiPertanian::success()
            ->selectRaw('nama_donatur, SUM(jumlah) as total')
            ->groupBy('nama_donatur')
            ->orderByDesc('total')
            ->take(10)
            ->get();


        $allDonaturTicker = DonasiPertanian::success()
            ->latest('created_at')
            ->take(20)
            ->get();

        return view('donasi.public.index', compact(
            'recentDonations',
            'totalDonasi',
            'totalDonatur',
            'targetDonasi',
            'topDonatur',
            'allDonaturTicker'
        ));
    }

    public function create(Request $request)
    {
        $preselectedAmount = $request->get('jumlah', 50000);
        return view('donasi.public.create', compact('preselectedAmount'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_donatur'      => 'required|string|max:255',
            'email'             => 'nullable|email|max:255',
            'phone'             => 'nullable|string|max:20',
            'jumlah'            => 'required|numeric|min:1000',
            'metode_pembayaran' => 'required|in:transfer,ewallet,qris,credit_card',
            'pesan'             => 'nullable|string|max:500',
        ]);

        $validated['order_id'] = 'DONASI-' . strtoupper(Str::random(8)) . '-' . time();
        $validated['status']   = DonasiPertanian::STATUS_PENDING;

        $donasi = DonasiPertanian::create($validated);

        // Midtrans Payment Configuration
        $params = [
            'transaction_details' => [
                'order_id'     => $donasi->order_id,
                'gross_amount' => (int) $donasi->jumlah,
            ],
            'customer_details' => [
                'first_name' => $donasi->nama_donatur,
                'email'      => $donasi->email ?? '',
                'phone'      => $donasi->phone ?? '',
            ],
            // Fix untuk ngrok
            'callbacks' => [
                'finish' => route('donasi.public.success'),
                'error' => route('donasi.public.error'),
                'pending' => route('donasi.public.pending'),
            ],
            'item_details' => [
                [
                    'id'       => 'DONASI-' . $donasi->id,
                    'price'    => (int) $donasi->jumlah,
                    'quantity' => 1,
                    'name'     => 'Donasi Pertanian - Reece Farms',
                ]
            ],
            'custom_field1' => $donasi->pesan ?? '',
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $donasi->update(['payment_token' => $snapToken]);

            // Save donor email to session
            session(['donor_email' => $donasi->email]);

            return response()->json([
                'success'    => true,
                'snap_token' => $snapToken,
                'client_key' => config('midtrans.client_key'),
                'donasi_id'  => $donasi->id,
                'order_id'   => $donasi->order_id,
                'redirect'   => [
                    'success' => route('donasi.public.success'),
                    'pending' => route('donasi.public.pending'),
                    'error'   => route('donasi.public.error'),
                ],
            ]);

        } catch (\Exception $e) {
            $donasi->delete();

            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pembayaran: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function payment(DonasiPertanian $donasi)
    {
        // Check if donation is still pending
        if ($donasi->status !== DonasiPertanian::STATUS_PENDING) {
            return redirect()->route('donasi.public.show', $donasi)
                ->with('message', 'Donasi ini tidak dapat dilanjutkan pembayarannya.');
        }

        // Check if payment token still valid
        if (!$donasi->payment_token) {
            return redirect()->route('donasi.public.show', $donasi)
                ->with('error', 'Token pembayaran tidak valid. Silakan buat donasi baru.');
        }

        return view('donasi.public.payment', compact('donasi'));
    }

    public function show(DonasiPertanian $donasi)
    {
        return view('donasi.public.show', compact('donasi'));
    }

    public function success(Request $request)
    {
        $order_id = $request->get('order_id');
        $donasi   = null;

        if ($order_id) {
            $donasi = DonasiPertanian::where('order_id', $order_id)->first();
            if ($donasi) {
                $donasi->update([
                    'status'         => DonasiPertanian::STATUS_SUCCESS,
                    'tanggal_donasi' => now(),
                ]);
            }
        }

        return view('donasi.public.success', compact('donasi'));
    }

    public function pending(Request $request)
    {
        return view('donasi.public.pending');
    }

    public function error(Request $request)
    {
        return view('donasi.public.error');
    }

    //callback 
    public function notification(Request $request)
    {
        try {
            // Log request untuk debugging
            error_log("Webhook received: " . json_encode($request->all()));
            
            // Gunakan raw request data untuk ngrok compatibility
            $orderId = $request->order_id;
            $transaction = $request->transaction_status;
            $fraud = $request->fraud_status;
            $type = $request->payment_type;

            // Error logging untuk debugging
            error_log("Order ID $orderId: transaction status = $transaction, fraud status = $fraud");
            
            // Cari donasi berdasarkan order_id
            $donasi = DonasiPertanian::where('order_id', $orderId)->first();
            
            if (!$donasi) {
                error_log("Donasi not found for order_id: $orderId");
                return response('Donasi not found', 404);
            }

        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $donasi->update(['status' => DonasiPertanian::STATUS_PENDING]);
                error_log("Payment challenge for order_id: $orderId");
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $donasi->update([
                    'status' => DonasiPertanian::STATUS_SUCCESS, 
                    'tanggal_donasi' => now()
                ]);
                error_log("Payment success for order_id: $orderId");
            }
        }
        else if ($transaction == 'settlement') {
            $donasi->update([
                'status' => DonasiPertanian::STATUS_SUCCESS, 
                'tanggal_donasi' => now()
            ]);
            error_log("Payment settlement for order_id: $orderId");
        }
        else if ($transaction == 'pending') {
            $donasi->update(['status' => DonasiPertanian::STATUS_PENDING]);
            error_log("Payment pending for order_id: $orderId");
        }
        else if ($transaction == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $donasi->update(['status' => DonasiPertanian::STATUS_FAILED]);
                error_log("Payment cancel with challenge for order_id: $orderId");
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $donasi->update(['status' => DonasiPertanian::STATUS_FAILED]);
                error_log("Payment cancel accepted for order_id: $orderId");
            }
        }
        else if ($transaction == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $donasi->update(['status' => DonasiPertanian::STATUS_FAILED]);
            error_log("Payment denied for order_id: $orderId");
        }
        else if ($transaction == 'expire') {
            $donasi->update(['status' => DonasiPertanian::STATUS_EXPIRED]);
            error_log("Payment expired for order_id: $orderId");
        }

        return response('OK', 200)
                ->header('Content-Type', 'text/plain')
                ->header('Connection', 'close');
                
        } catch (\Exception $e) {
            error_log("Webhook error: " . $e->getMessage());
            return response('Webhook Error', 500);
        }
    }

    public function getStats()
    {
        return response()->json([
            'total_donasi'     => DonasiPertanian::success()->sum('jumlah'),
            'total_donatur'    => DonasiPertanian::success()->count(),
            'donasi_bulan_ini' => DonasiPertanian::success()->byMonth()->sum('jumlah'),
        ]);
    }

    // API END POINT UNTUK DATA
    public function getDonors()
    {
        $recentDonations = DonasiPertanian::success()
            ->latest('created_at')
            ->take(6)
            ->get()
            ->map(function($d) {
                return [
                    'id' => $d->id,
                    'nama_donatur' => $d->nama_donatur,
                    'jumlah' => $d->jumlah,
                    'pesan' => $d->pesan,
                    'created_at' => $d->created_at->diffForHumans(),
                    'avatar' => strtoupper(substr($d->nama_donatur, 0, 1))
                ];
            });

        return response()->json([
            'success' => true,
            'donors' => $recentDonations
        ]);
    }

    // API endpoint untuk check status pembayaran
    public function checkStatus($orderId)
    {
        $donasi = DonasiPertanian::where('order_id', $orderId)->first();
        
        if (!$donasi) {
            return response()->json([
                'success' => false,
                'message' => 'Donasi tidak ditemukan'
            ], 404);
        }

        // Check dengan Midtrans API untuk status terbaru
        try {
            $serverKey = config('midtrans.server_key');
            $url = config('midtrans.is_production') 
                ? 'https://api.midtrans.com/v2/' . $orderId . '/status'
                : 'https://api.sandbox.midtrans.com/v2/' . $orderId . '/status';
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($serverKey . ':')
            ]);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if ($httpCode === 200) {
                $midtransData = json_decode($response, true);
                $transactionStatus = $midtransData['transaction_status'] ?? 'unknown';
                
                // Update status di database
                if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                    $donasi->update([
                        'status' => DonasiPertanian::STATUS_SUCCESS,
                        'tanggal_donasi' => now()
                    ]);
                    
                    return response()->json([
                        'success' => true,
                        'status' => 'success',
                        'message' => 'Pembayaran berhasil! Donasi Anda telah diterima.'
                    ]);
                } elseif ($transactionStatus === 'pending') {
                    $donasi->update(['status' => DonasiPertanian::STATUS_PENDING]);
                    
                    return response()->json([
                        'success' => true,
                        'status' => 'pending',
                        'message' => 'Pembayaran masih menunggu konfirmasi.'
                    ]);
                } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
                    $donasi->update(['status' => DonasiPertanian::STATUS_FAILED]);
                    
                    return response()->json([
                        'success' => true,
                        'status' => 'failed',
                        'message' => 'Pembayaran gagal atau kadaluarsa.'
                    ]);
                }
            }
        } catch (\Exception $e) {
            error_log("Midtrans API error: " . $e->getMessage());
        }
        
        // Fallback ke database status
        $statusMessage = match($donasi->status) {
            'success' => 'Pembayaran berhasil! Donasi Anda telah diterima.',
            'pending' => 'Pembayaran masih menunggu konfirmasi.',
            'failed' => 'Pembayaran gagal. Silakan coba lagi.',
            'expired' => 'Pembayaran kadaluarsa. Silakan buat donasi baru.',
            default => 'Status tidak diketahui.'
        };
        
        return response()->json([
            'success' => true,
            'status' => $donasi->status,
            'message' => $statusMessage
        ]);
    }
}