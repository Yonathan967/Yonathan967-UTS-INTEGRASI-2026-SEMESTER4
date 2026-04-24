<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaanbibit extends Model
{


    use HasFactory;


    protected $guarded = [];
    public function bibit()
    {
        return $this->belongsTo(Bibit::class);
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
