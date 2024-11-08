<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukHarga;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProdukController extends Controller
{
    function index(Request $request) {
        $get = $request->query();

        if (count($get) !== 0) {
            dd($get);
        }

        $types = Produk::get_types();
        $produks = collect();
        $hargas = collect();
        $jumlah_produk = 0;
        foreach ($types as $tipe) {
            $produk_tipe = Produk::where('tipe', $tipe['tipe'])->orderBy('nama')->get();
            $produks->push($produk_tipe);

            $produk_hargas = collect();
            foreach ($produk_tipe as $produk) {
                $produk_hargas->push(ProdukHarga::where('produk_id', $produk->id)->where('status', 'DEFAULT')->latest()->first());
            }
            $hargas->push($produk_hargas);

            $jumlah_produk += count($produk_tipe);
        }
        // dd($produks->groupBy('tipe'));
        $label_suppliers = Supplier::select('id', 'nama as name', 'nama as value')->orderBy('nama')->get();
        $label_products = Produk::select('id', 'nama as name', 'nama as value')->orderBy('nama')->get();

        $data = [
            'route_now' => 'produks.index',
            'parent_route' => 'home',
            'produks' => $produks,
            'label_suppliers' => $label_suppliers,
            'label_products' => $label_products,
            'types' => $types,
            'jumlah_produk' => $jumlah_produk,
            'tipe_packing' => Produk::get_tipe_packing(),
            'hargas' => $hargas,
        ];
        // dd($hargas);
        return Inertia::render('Produks/Index', $data);
    }
}
