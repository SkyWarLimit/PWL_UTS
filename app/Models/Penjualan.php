<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model\HasMany;

class Penjualan extends Model
{
    protected $table = 't_penjualan';
    protected $primaryKey = 'penjualan_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'pembeli',
        'penjualan_kode',
        'penjualan_tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function detail()
    {
        return $this->hasMany(PenjualanDetail::class, 'penjualan_id', 'penjualan_id');
    }

    public function penjualanDetail()
    {
        return $this->hasMany(PenjualanDetail::class, 'penjualan_id', 'penjualan_id');
    }

    protected static function booted()
    {
        static::deleting(function ($penjualan) {
            $penjualan->penjualanDetail()->delete();
        });
    }
}