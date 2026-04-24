<?php

namespace App\Services;

use App\Models\Bibit;
use App\Models\Pemanenan;
use App\Models\Penjualan;
use App\Models\Penanaman;
use App\Models\Perawatan;
use App\Models\Pengadaanbibit;
use App\Models\DonasiPertanian;
use App\Models\Penggajian;
use Illuminate\Support\Facades\DB;

class StokService
{
    public function cekStokBibit($jenisBibit, $jumlahDibutuhkan)
    {
        // Hitung total bibit dari pengadaan
        $totalPengadaan = Pengadaanbibit::where('jenis_bibit', $jenisBibit)->sum('jumlah_pembelian');
        
        if ($totalPengadaan == 0) {
            return [
                'status' => false,
                'message' => "Jenis bibit {$jenisBibit} tidak ditemukan dalam data pengadaan",
                'stok_tersedia' => 0
            ];
        }

        // Hitung total yang sudah ditanam
        $totalDitanam = Penanaman::where('jenis_bibit', $jenisBibit)->sum('jumlah_bibit');
        $stokTersedia = max(0, $totalPengadaan - $totalDitanam);

        return [
            'status' => $stokTersedia >= $jumlahDibutuhkan,
            'message' => $stokTersedia >= $jumlahDibutuhkan 
                ? "Stok bibit mencukupi" 
                : "Stok bibit tidak mencukupi. Tersedia: {$stokTersedia}, Dibutuhkan: {$jumlahDibutuhkan}",
            'stok_tersedia' => $stokTersedia
        ];
    }

    public function cekStokPanen($jenisTanaman, $jumlahDibutuhkan)
    {
        $pemanenan = Pemanenan::where('jenis_tanaman', $jenisTanaman)->get();
        
        if ($pemanenan->isEmpty()) {
            return [
                'status' => false,
                'message' => "Data pemanenan untuk {$jenisTanaman} tidak ditemukan",
                'stok_tersedia' => 0
            ];
        }

        $totalStok = $pemanenan->sum(function($item) {
            $totalTerjual = Penjualan::where('jenis_tanaman', $item->jenis_tanaman)->sum('jumlah_pembelian');
            return max(0, $item->jumlah_panen - $totalTerjual);
        });

        return [
            'status' => $totalStok >= $jumlahDibutuhkan,
            'message' => $totalStok >= $jumlahDibutuhkan 
                ? "Stok panen mencukupi" 
                : "Stok panen tidak mencukupi. Tersedia: {$totalStok}, Dibutuhkan: {$jumlahDibutuhkan}",
            'stok_tersedia' => $totalStok
        ];
    }

    public function getDashboardStats()
    {
        // Hitung stok bibit dari pengadaan
        $totalPengadaan = Pengadaanbibit::sum('jumlah_pembelian');
        $totalDitanam = Penanaman::sum('jumlah_bibit');
        $totalStokBibit = max(0, $totalPengadaan - $totalDitanam);

        // Hitung stok panen secara manual untuk menghindari konflik accessor
        $pemanenans = Pemanenan::all();
        $totalStokPanen = 0;
        
        foreach ($pemanenans as $pemanenan) {
            $totalTerjual = Penjualan::where('jenis_tanaman', $pemanenan->jenis_tanaman)->sum('jumlah_pembelian');
            $totalStokPanen += max(0, $pemanenan->jumlah_panen - $totalTerjual);
        }

        // Hitung donasi
        $totalDonasi = DonasiPertanian::success()->sum('jumlah');
        $totalDonatur = DonasiPertanian::success()->count();

        return [
            'total_tanaman' => Penanaman::sum('jumlah_tanaman'),
            'total_perawatan' => Perawatan::count(),
            'total_pemanenan' => Pemanenan::count(),
            'total_penjualan' => Penjualan::count(),
            'stok_bibit' => $totalStokBibit,
            'stok_panen' => $totalStokPanen,
            'total_pengadaan' => $totalPengadaan,
            'total_donasi' => $totalDonasi,
            'total_donatur' => $totalDonatur,
        ];
    }

    public function getFinancialStats()
    {
        // Pengeluaran: pembelian bibit + gaji karyawan
        $pengeluaranBibit = Pengadaanbibit::sum(DB::raw('jumlah_pembelian * harga'));
        $pengeluaranGaji = Penggajian::where('status', 'paid')->sum('gaji');
        $totalPengeluaran = $pengeluaranBibit + $pengeluaranGaji;

        // Pemasukan: penjualan
        $totalPemasukan = Penjualan::sum(DB::raw('jumlah_pembelian * harga'));

        // Keuntungan
        $keuntungan = $totalPemasukan - $totalPengeluaran;

        return [
            'pengeluaran' => $totalPengeluaran,
            'pemasukan' => $totalPemasukan,
            'keuntungan' => $keuntungan,
        ];
    }

    public function updateStokSetelahPenanaman($jenisBibit, $jumlahDitanam)
    {
        return $this->cekStokBibit($jenisBibit, $jumlahDitanam);
    }

    public function updateStokSetelahPenjualan($jenisTanaman, $jumlahTerjual)
    {
        return $this->cekStokPanen($jenisTanaman, $jumlahTerjual);
    }
}
