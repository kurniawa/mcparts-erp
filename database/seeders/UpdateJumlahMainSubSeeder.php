<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\PembelianBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateJumlahMainSubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Barang::all() as $barang) {
            $barang->jumlah_main = $barang->jumlah_main / 100;
            if ($barang->jumlah_sub) {
                $barang->jumlah_sub = $barang->jumlah_sub / 100;
            }
            $barang->save();
        }

        foreach (PembelianBarang::all() as $pembelian_barang) {
            $pembelian_barang->jumlah_main = $pembelian_barang->jumlah_main / 100;
            if ($pembelian_barang->jumlah_sub) {
                $pembelian_barang->jumlah_sub = $pembelian_barang->jumlah_sub / 100;
            }
            $pembelian_barang->save();
        }
    }
}
