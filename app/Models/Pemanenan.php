<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemanenan extends Model
{
    
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'stok_tersedia' => 'integer',
    ];

    public function penanaman()
    {
        return $this->belongsTo(Penanaman::class);
    }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'jenis_tanaman', 'jenis_tanaman');
    }

    public function getStokTersediaHitungAttribute()
    {
        $totalTerjual = $this->penjualans()->sum('jumlah_pembelian');
        return max(0, $this->jumlah_panen - $totalTerjual);
    }
}
