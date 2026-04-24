<?php

namespace App\Observers;

use App\Models\Bibit;
use App\Models\Penanaman;

class BibitObserver
{
    public function created(Bibit $bibit): void
    {
        $bibit->stok_tersedia = $bibit->jumlah;
        $bibit->saveQuietly();
    }

    public function updated(Bibit $bibit): void
    {
        if ($bibit->wasChanged('jumlah')) {
            $totalDitanam = Penanaman::where('jenis_bibit', $bibit->jenis_bibit)->sum('jumlah_bibit');
            $bibit->stok_tersedia = max(0, $bibit->jumlah - $totalDitanam);
            $bibit->saveQuietly();
        }
    }

    public function saved(Bibit $bibit): void
    {
        $totalDitanam = Penanaman::where('jenis_bibit', $bibit->jenis_bibit)->sum('jumlah_bibit');
        $bibit->stok_tersedia = max(0, $bibit->jumlah - $totalDitanam);
        $bibit->saveQuietly();
    }

    public function deleted(Bibit $bibit): void
    {
        //
    }

    public function restored(Bibit $bibit): void
    {
        //
    }

    public function forceDeleted(Bibit $bibit): void
    {
        //
    }
}
