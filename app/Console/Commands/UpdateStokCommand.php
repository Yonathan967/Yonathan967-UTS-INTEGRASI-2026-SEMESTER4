<?php

namespace App\Console\Commands;

use App\Models\Pemanenan;
use App\Models\Penjualan;
use App\Models\Penanaman;
use App\Models\Pengadaanbibit;
use Illuminate\Console\Command;

class UpdateStokCommand extends Command
{
    protected $signature = 'stok:update';
    protected $description = 'Update stok tersedia untuk bibit dan pemanenan';

    public function handle()
    {
        $this->info('Menghitung stok bibit dari pengadaan...');
        
        // Hitung stok bibit dari pengadaan
        $totalPengadaan = Pengadaanbibit::sum('jumlah_pembelian');
        $totalDitanam = Penanaman::sum('jumlah_bibit');
        $totalStokBibit = max(0, $totalPengadaan - $totalDitanam);
        
        $this->line("Total Pengadaan: {$totalPengadaan}");
        $this->line("Total Ditanam: {$totalDitanam}");
        $this->line("Stok Bibit Tersedia: {$totalStokBibit}");

        $this->info('Mengupdate stok pemanenan...');
        
        // Update stok pemanenan
        $pemanenans = Pemanenan::all();
        $totalStokPanen = 0;
        
        foreach ($pemanenans as $pemanenan) {
            $totalTerjual = Penjualan::where('jenis_tanaman', $pemanenan->jenis_tanaman)->sum('jumlah_pembelian');
            $stokTersedia = max(0, $pemanenan->jumlah_panen - $totalTerjual);
            $pemanenan->stok_tersedia = $stokTersedia;
            $pemanenan->save();
            $totalStokPanen += $stokTersedia;
            $this->line("Updated pemanenan {$pemanenan->jenis_tanaman}: {$stokTersedia}");
        }

        $this->info("Total stok panen: {$totalStokPanen}");
        $this->info('Stok berhasil dihitung!');
        return 0;
    }
}
