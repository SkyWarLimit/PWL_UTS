<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';
    public $timestamps = false;

    protected $fillable = [
        'kategori_id',
        'barang_kode',
        'barang_nama',
        'harga_beli',
        'harga_jual',
        'image',
    ];

    public function kategori()
    {
    return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function stok()
    {
        return $this->hasMany(Stok::class, 'barang_id', 'barang_id');
    }

    public function detail()
    {
        return $this->hasMany(PenjualanDetail::class, 'barang_id', 'barang_id');
    }

    
}