<?php

namespace App\Http\Controllers;

use App\Models\DonasiPertanian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class DonasiController extends Controller
{
    public function __construct()
    {                                                           
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('Mid-server-kdh42m7Z-14gDvzqIBsNvSHY'); //SERVER KEY
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    public function index()
    {
        $donasi = DonasiPertanian::latest()->paginate(10);
        return view('donasi.admin.index', compact('donasi'));
    }

    public function create()
    {
        return view('//');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'jumlah' => 'required|numeric|min:1000',
            'metode_pembayaran' => 'required|in:transfer,ewallet,qris,credit_card',
            'pesan' => 'nullable|string|max:500',
        ]);

        // Generate unique order ID
        $validated['order_id'] = 'DONASI-' . strtoupper(Str::random(8)) . '-' . time();
        $validated['status'] = DonasiPertanian::STATUS_PENDING;

        $donasi = DonasiPertanian::create($validated);

        // Midtrans Payment Configuration (Snap Token)
        $params = array(
            'transaction_details' => array(
                'order_id' => $donasi->order_id,
                'gross_amount' => $donasi->jumlah,
            ),
            'customer_details' => array(
                'first_name' => $donasi->nama_donatur,
                'email' => $donasi->email,
                'phone' => $donasi->phone,
            ),
            'item_details' => array(
                array(
                    'id' => 'DONASI-' . $donasi->id,
                    'price' => $donasi->jumlah,
                    'quantity' => 1,
                    'name' => 'Donasi Pertanian - Reece Farms',
                )
            ),
        );

       
    }

    public function show(DonasiPertanian $donasi)
    {
        return view('donasi.admin.show', compact('donasi'));
    }

    public function cetak()
    {
        $data = DonasiPertanian::success()->get();
        return view('donasi.admin.cetak', compact('data'));
    }

    public function payment(DonasiPertanian $donasi)
    {
        // TODO: Integrasi Midtrans di sini
        // - Tampilkan popup payment Midtrans
        // - Atau redirect ke payment page
        
        return view('donasi.admin.payment', compact('donasi'));
    }

    public function success(Request $request)
    {
        // TODO: Handle Midtrans success callback
        $order_id = $request->get('order_id');
        
        $donasi = DonasiPertanian::where('order_id', $order_id)->first();
        if ($donasi) {
            $donasi->update([
                'status' => DonasiPertanian::STATUS_SUCCESS,
                'tanggal_donasi' => now(),
            ]);
        }

        return view('donasi.admin.success', compact('donasi'));
    }

    public function pending(Request $request)
    {
        // TODO: Handle Midtrans pending callback
        return view('donasi.admin.pending');
    }

    public function error(Request $request)
    {
        // TODO: Handle Midtrans error callback
        return view('donasi.admin.error');
    }

    // API untuk dashboard stats
    public function getStats()
    {
        $totalDonasi = DonasiPertanian::success()->sum('jumlah');
        $totalDonatur = DonasiPertanian::success()->count();
        $pendingDonasi = DonasiPertanian::pending()->count();
        
        // Donasi bulan ini
        $donasiBulanIni = DonasiPertanian::success()
            ->byMonth()
            ->sum('jumlah');

        return response()->json([
            'total_donasi' => $totalDonasi,
            'total_donatur' => $totalDonatur,
            'pending_donasi' => $pendingDonasi,
            'donasi_bulan_ini' => $donasiBulanIni,
        ]);
    }

    // Callback handler untuk Midtrans 
    public function callback(Request $request)
    {
        // TODO: Handle Midtrans webhook callback
        // - Verifikasi signature key
        // - Update status donasi
        // - Kirim email notifikasi
        
        return response()->json(['status' => 'success']);
    }
}
