<div class="p-8 bg-white">
    <div class="overflow-hidden rounded-2xl border border-gray-200 shadow-xl">
        <table class="w-full border-collapse">
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-8 py-5 bg-gray-50 w-1/3 text-xs font-black uppercase tracking-widest text-gray-400">
                        Nomor Invoice:
                    </td>
                    <td class="px-8 py-5 text-xl font-black text-primary-600">
                        {{ $record->penjualan_kode }}
                    </td>
                </tr>

                <tr>
                    <td class="px-8 py-5 bg-gray-50 text-xs font-black uppercase tracking-widest text-gray-400">
                        Nama Pelanggan:
                    </td>
                    <td class="px-8 py-5 text-lg font-bold text-gray-800">
                        {{ $record->pembeli }}
                    </td>
                </tr>

                @php $total = 0; @endphp
                @foreach($record->details as $index => $item)
                    @php 
                        $subtotal = $item->harga * $item->jumlah; 
                        $total += $subtotal;
                    @endphp
                    
                    @if($index > 0)
                    <tr class="bg-gray-100"><td colspan="2" class="h-1"></td></tr>
                    @endif

                    <tr>
                        <td class="px-8 py-5 bg-gray-50 text-xs font-black uppercase tracking-widest text-gray-400">
                            Product / Barang:
                        </td>
                        <td class="px-8 py-5 text-lg font-black text-gray-900">
                            {{ $item->barang->barang_nama ?? 'N/A' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="px-8 py-5 bg-gray-50 text-xs font-black uppercase tracking-widest text-gray-400">
                            SKU:
                        </td>
                        <td class="px-8 py-5 text-sm font-bold text-gray-500 uppercase">
                            {{ $item->barang->barang_kode ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="px-8 py-5 bg-gray-50 text-xs font-black uppercase tracking-widest text-gray-400">
                            Rincian Harga:
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-sm text-gray-500 font-medium">
                                Rp {{ number_format($item->harga, 0, ',', '.') }} x {{ $item->jumlah }} =
                            </span>
                            <span class="ml-2 text-xl font-black text-gray-900">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>
                @endforeach

                <tr class="bg-primary-50/50">
                    <td class="px-8 py-8 bg-primary-100/30 text-xs font-black uppercase tracking-widest text-primary-600">
                        Total Pembayaran:
                    </td>
                    <td class="px-8 py-8 text-4xl font-black text-primary-700">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="pt-8 text-center">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] border-t-2 border-dashed border-gray-100 pt-6">
            * Terima kasih Telah Berbelanja di Toko Kami.
        </p>
    </div>
</div>