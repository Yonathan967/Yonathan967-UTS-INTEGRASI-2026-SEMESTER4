<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penggajian extends Model
{
    protected $fillable = [
        'user_id',
        'gaji',
        'tanggal_gaji',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'gaji' => 'decimal:2',
        'tanggal_gaji' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
