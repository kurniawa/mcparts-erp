<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteApiController extends Controller
{
    function api_search_products(Request $request) {
        $nama_produk = $request->get('search_key');
        $nama_produk = trim($nama_produk);
        $produks = Produk::select('id', 'tipe', 'nama as name')->where('nama', 'like', "%$nama_produk%")->limit(10)->orderBy('nama')->get();

        return response()->json($produks);
    }

    function api_search_customers(Request $request) {
        $query = $request->input('search_key', '');
        // dd($query);
        
        // Pelanggan dan Reseller (semua pelanggan yang tidak memiliki reseller)
        $allCustomersWithoutResellers = DB::table('pelanggans')
            ->select('id', 'nama as name', DB::raw('NULL as reseller_id'))
            ->whereNull('reseller_id')
            ->where('nama', 'LIKE', "%{$query}%")
            ->limit(10);

        // Pelanggan yang memiliki reseller
        $customersHaveResellers = DB::table('pelanggans')
            ->select('id', 'nama as name', DB::raw('NULL as reseller_id'))
            ->whereNotNull('reseller_id')
            ->where('nama', 'LIKE', "%{$query}%")->limit(10);

        //Kombinasi pelanggan yang memiliki reseller dengan reseller nya
        $customersWithRelatedCustomers = DB::table('pelanggans')
            ->join('pelanggans as resellers', 'pelanggans.reseller_id', '=', 'resellers.id')
            ->select(
                'pelanggans.id',
                DB::raw("CONCAT(resellers.nama, ' - ', pelanggans.nama) as name"),
                'pelanggans.reseller_id'
            )
            ->where('pelanggans.nama', 'LIKE', "%{$query}%")
            ->orWhere('resellers.nama', 'LIKE', "%{$query}%")->limit(10);
        
        // $customersWithRelatedCustomers = DB::table('pelanggans')
        // ->join('pelanggans as resellers', 'pelanggans.reseller_id', '=', 'resellers.id')
        // ->select(
        //     DB::raw("JSON_ARRAYAGG(pelanggans.id) as id"),
        //     DB::raw("CONCAT(resellers.nama, ' - ', pelanggans.nama) as name"),
        //     DB::raw('NULL as reseller_id')  // Menambahkan kolom reseller_id yang NULL
        //     // 'pelanggans.reseller_id'
        // )
        // ->where('pelanggans.nama', 'LIKE', "%{$query}%")
        // ->orWhere('resellers.nama', 'LIKE', "%{$query}%")
        // ->groupBy('pelanggans.nama', 'resellers.nama');

        // Gabungkan semua query
        $results = $customersHaveResellers
            ->union($allCustomersWithoutResellers)
            ->union($customersWithRelatedCustomers)
            ->orderBy('name', 'asc')
            ->limit(10)
            ->get();
        
        // dd($results);
        return response()->json($results);
    }
}
