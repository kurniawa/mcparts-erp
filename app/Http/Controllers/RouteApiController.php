<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class RouteApiController extends Controller
{
    function api_search_products(Request $request) {
        $nama_produk = $request->get('key_name');
        $nama_produk = trim($nama_produk);
        $produks = Produk::select('id', 'tipe', 'nama as name')->where('nama', 'like', "%$nama_produk%")->limit(10)->orderBy('nama')->get();

        return response()->json($produks);
    }
}
