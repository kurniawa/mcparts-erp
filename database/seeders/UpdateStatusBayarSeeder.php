<?php

namespace Database\Seeders;

use App\Models\Pembelian;
use App\Models\PembelianBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateStatusBayarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pembelians = Pembelian::all();
        foreach ($pembelians as $pembelian) {
            if ($pembelian->status_bayar == 'BELUM') {
                $pembelian->status_bayar = 'BELUM-LUNAS';
                $pembelian->save();
            }
        }

        foreach (PembelianBarang::all() as $pembelian_barang) {
            if ($pembelian_barang->status_bayar == 'BELUM') {
                $pembelian_barang->status_bayar = 'BELUM-LUNAS';
                $pembelian_barang->save();
            }
        }
    }
}
