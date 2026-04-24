<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penanaman extends Model
{

     use HasFactory;

    
      protected $guarded = [];
      
    public function bibit()
    {
        return $this->belongsTo(Bibit::class);
    }

    public function pemanenans()
    {
        return $this->hasMany(Pemanenan::class);
    }

    public function perawatans()
    {
        return $this->hasMany(Perawatan::class);
    }
}
