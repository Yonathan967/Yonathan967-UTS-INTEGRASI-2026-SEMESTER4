<?php

namespace App\Observers;

use App\Models\Pemanenan;
use App\Models\Penjualan;

class PemanenanObserver
{
    public function created(Pemanenan $pemanenan): void
    {
        $pemanenan->stok_tersedia = $pemanenan->jumlah_panen;
        $pemanenan->saveQuietly();
    }

    public function updated(Pemanenan $pemanenan): void
    {
        if ($pemanenan->wasChanged('jumlah_panen')) {
            $totalTerjual = Penjualan::where('jenis_tanaman', $pemanenan->jenis_tanaman)->sum('jumlah_pembelian');
            $pemanenan->stok_tersedia = max(0, $pemanenan->jumlah_panen - $totalTerjual);
            $pemanenan->saveQuietly();
        }
    }

    public function saved(Pemanenan $pemanenan): void
    {
        $totalTerjual = Penjualan::where('jenis_tanaman', $pemanenan->jenis_tanaman)->sum('jumlah_pembelian');
        $pemanenan->stok_tersedia = max(0, $pemanenan->jumlah_panen - $totalTerjual);
        $pemanenan->saveQuietly();
    }

    public function deleted(Pemanenan $pemanenan): void
    {
        //
    }

    public function restored(Pemanenan $pemanenan): void
    {
        //
    }

    public function forceDeleted(Pemanenan $pemanenan): void
    {
        //
    }
}
