<?php

namespace App\Observers;

use App\Models\Penanaman;
use App\Models\Bibit;

class PenanamanObserver
{
    public function created(Penanaman $penanaman): void
    {
        $this->updateStokBibit($penanaman->jenis_bibit);
    }

    public function updated(Penanaman $penanaman): void
    {
        if ($penanaman->wasChanged('jumlah_bibit') || $penanaman->wasChanged('jenis_bibit')) {
            $this->updateStokBibit($penanaman->jenis_bibit);
        }
    }

    public function deleted(Penanaman $penanaman): void
    {
        $this->updateStokBibit($penanaman->jenis_bibit);
    }

    private function updateStokBibit($jenisBibit)
    {
        $bibits = Bibit::where('jenis_bibit', $jenisBibit)->get();
        
        foreach ($bibits as $bibit) {
            $totalDitanam = Penanaman::where('jenis_bibit', $jenisBibit)->sum('jumlah_bibit');
            $bibit->stok_tersedia = max(0, $bibit->jumlah - $totalDitanam);
            $bibit->saveQuietly();
        }
    }

    public function restored(Penanaman $penanaman): void
    {
        $this->updateStokBibit($penanaman->jenis_bibit);
    }

    public function forceDeleted(Penanaman $penanaman): void
    {
        $this->updateStokBibit($penanaman->jenis_bibit);
    }
}
