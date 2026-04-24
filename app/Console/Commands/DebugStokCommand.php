<?php

namespace App\Console\Commands;

use App\Models\Pengadaanbibit;
use App\Models\Penanaman;
use Illuminate\Console\Command;

class DebugStokCommand extends Command
{
    protected $signature = 'debug:stok';
    protected $description = 'Debug data stok bibit';

    public function handle()
    {
        $this->info('=== DEBUG DATA BIBIT ===');
        
        $this->info("\nData Pengadaan Bibit:");
        $pengadaans = Pengadaanbibit::all();
        foreach ($pengadaans as $p) {
            $this->line("ID: {$p->id}, Jenis: {$p->jenis_bibit}, Jumlah: {$p->jumlah_pembelian}, Tanggal: {$p->tanggal_pembelian}");
        }

        $this->info("\nData Penanaman:");
        $penanamans = Penanaman::all();
        foreach ($penanamans as $p) {
            $this->line("ID: {$p->id}, Jenis Bibit: {$p->jenis_bibit}, Jumlah Bibit: {$p->jumlah_bibit}, Jumlah Tanaman: {$p->jumlah_tanaman}");
        }

        $this->info("\nPerhitungan per jenis bibit:");
        $jenisBibits = Pengadaanbibit::distinct()->pluck('jenis_bibit');
        
        foreach ($jenisBibits as $jenis) {
            $totalPengadaan = Pengadaanbibit::where('jenis_bibit', $jenis)->sum('jumlah_pembelian');
            $totalDitanam = Penanaman::where('jenis_bibit', $jenis)->sum('jumlah_bibit');
            $sisa = max(0, $totalPengadaan - $totalDitanam);
            $this->line("Jenis: {$jenis} | Pengadaan: {$totalPengadaan} | Ditanam: {$totalDitanam} | Sisa: {$sisa}");
        }

        $this->info("\nTotal Keseluruhan:");
        $totalPengadaan = Pengadaanbibit::sum('jumlah_pembelian');
        $totalDitanam = Penanaman::sum('jumlah_bibit');
        $totalSisa = max(0, $totalPengadaan - $totalDitanam);
        $this->line("Total Pengadaan: {$totalPengadaan}");
        $this->line("Total Ditanam: {$totalDitanam}");
        $this->line("Total Sisa: {$totalSisa}");
        
        return 0;
    }
}
