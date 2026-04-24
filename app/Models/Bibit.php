<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bibit extends Model
{
    
    
   use HasFactory;


    protected $guarded = [];

    protected $casts = [
        'stok_tersedia' => 'integer',
    ];

    public function pengadaans()
    {
        return $this->hasMany(Pengadaanbibit::class);
    }

    public function penanamans()
    {
        return $this->hasMany(Penanaman::class, 'jenis_bibit', 'jenis_bibit');
    }

    public function getStokTersediaAttribute()
    {
        $totalDitanam = $this->penanamans()->sum('jumlah_bibit');
        return max(0, $this->jumlah - $totalDitanam);
    }
}

    