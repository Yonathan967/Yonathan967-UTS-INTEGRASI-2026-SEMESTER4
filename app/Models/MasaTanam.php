<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Pengadaanbibit extends Model
{


    use HasFactory;
 
    protected $fillable = [
        'nama_petani',
        'jenis_bibit',
        'tanggal_penanaman',
        'jumlah_penanaman',
        'lokasi_tanaman',
    ];

     protected $guarded = [];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}