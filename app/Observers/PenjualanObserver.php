<?php

namespace App\Observers;

use App\Models\Penjualan;
use App\Models\Pemanenan;

class PenjualanObserver
{
    public function created(Penjualan $penjualan): void
    {
        $this->updateStokPemanenan($penjualan->jenis_tanaman);
    }

    public function updated(Penjualan $penjualan): void
    {
        if ($penjualan->wasChanged('jumlah_pembelian') || $penjualan->wasChanged('jenis_tanaman')) {
            $this->updateStokPemanenan($penjualan->jenis_tanaman);
        }
    }

    public function deleted(Penjualan $penjualan): void
    {
        $this->updateStokPemanenan($penjualan->jenis_tanaman);
    }

    private function updateStokPemanenan($jenisTanaman)
    {
        $pemanenans = Pemanenan::where('jenis_tanaman', $jenisTanaman)->get();
        
        foreach ($pemanenans as $pemanenan) {
            $totalTerjual = Penjualan::where('jenis_tanaman', $jenisTanaman)->sum('jumlah_pembelian');
            $pemanenan->stok_tersedia = max(0, $pemanenan->jumlah_panen - $totalTerjual);
            $pemanenan->saveQuietly();
        }
    }

    public function restored(Penjualan $penjualan): void
    {
        $this->updateStokPemanenan($penjualan->jenis_tanaman);
    }

    public function forceDeleted(Penjualan $penjualan): void
    {
        $this->updateStokPemanenan($penjualan->jenis_tanaman);
    }
}
