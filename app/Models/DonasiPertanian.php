<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiPertanian extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'donasi_pertanian'; // Explicitly set table name

    protected $casts = [
        'jumlah' => 'decimal:2',
        'tanggal_donasi' => 'datetime',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';
    const STATUS_EXPIRED = 'expired';

    // Metode pembayaran constants
    const METODE_TRANSFER = 'transfer';
    const METODE_EWALLET = 'ewallet';
    const METODE_QRIS = 'qris';
    const METODE_CC = 'credit_card';

    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_PENDING => 'Menunggu Pembayaran',
            self::STATUS_SUCCESS => 'Berhasil',
            self::STATUS_FAILED => 'Gagal',
            self::STATUS_EXPIRED => 'Kadaluarsa',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            self::STATUS_PENDING => 'warning',
            self::STATUS_SUCCESS => 'success',
            self::STATUS_FAILED => 'danger',
            self::STATUS_EXPIRED => 'secondary',
        ];

        return $colors[$this->status] ?? 'secondary';
    }

    public function getMetodeLabelAttribute()
    {
        $labels = [
            self::METODE_TRANSFER => 'Transfer Bank',
            self::METODE_EWALLET => 'E-Wallet',
            self::METODE_QRIS => 'QRIS',
            self::METODE_CC => 'Kartu Kredit',
        ];

        return $labels[$this->metode_pembayaran] ?? $this->metode_pembayaran;
    }

    public function scopeSuccess($query)
    {
        return $query->where('status', self::STATUS_SUCCESS);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeByMonth($query, $month = null, $year = null)
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        return $query->whereMonth('tanggal_donasi', $month)
                    ->whereYear('tanggal_donasi', $year);
    }
}
