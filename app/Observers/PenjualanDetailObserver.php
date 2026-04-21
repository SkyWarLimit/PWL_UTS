<?php

namespace App\Observers;

use App\Models\Stok;
use App\Models\PenjualanDetail;

class PenjualanDetailObserver
{
    /**
     * Handle the PenjualanDetail "created" event.
     * Fungsi ini akan berjalan otomatis sesaat setelah data item penjualan tersimpan.
     */
    public function created(PenjualanDetail $penjualanDetail): void
    {
        // 1. Cari data stok yang memiliki barang_id yang sama dengan item yang dijual
        $stok = Stok::where('barang_id', $penjualanDetail->barang_id)->first();

        // 2. Jika data stok ditemukan, kurangi jumlahnya sesuai quantity (jumlah) yang dibeli
        if ($stok) {
            $stok->decrement('stok_jumlah', $penjualanDetail->jumlah);
        }
    }

    /**
     * Handle the PenjualanDetail "deleted" event.
     * Opsional: Gunakan ini jika ingin mengembalikan stok saat transaksi dibatalkan/dihapus.
     */
    public function deleted(PenjualanDetail $penjualanDetail): void
    {
        $stok = Stok::where('barang_id', $penjualanDetail->barang_id)->first();

        if ($stok) {
            $stok->increment('stok_jumlah', $penjualanDetail->jumlah);
        }
    }
}