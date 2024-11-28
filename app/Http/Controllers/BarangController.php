<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BarangController extends Controller
{
    function index(Request $request) {
        $get = $request->query();

        $suppliers = collect();
        $barangs = collect();

        if (count($get) !== 0) {
            // dd($get);

            if ($get['barang_id']) {
                $supplier_barangs = Barang::where('id', $get['barang_id'])->get();
                $suppliers = Supplier::where('id', $supplier_barangs[0]->supplier_id)->get();
                $barangs->push($supplier_barangs);
            } else if ($get['barang_nama']) {
                $suppliers_temp = Barang::where('nama', 'like', "%$get[barang_nama]%")->select('supplier_id')->groupBy('supplier_id')->orderBy('supplier_nama')->get();
                // dd($suppliers_temp);
                foreach ($suppliers_temp as $supplier_id) {
                    $suppliers->push(Supplier::find($supplier_id['supplier_id']));
                }
                foreach ($suppliers as $supplier) {
                    $supplier_barangs = Barang::where('supplier_id', $supplier->id)->get();
                    $barangs->push($supplier_barangs);
                }
                // $suppliers = Supplier::where('id', $supplier_barangs[0]->supplier_id)->get();
                // dd($suppliers);
            } else if ($get['supplier_nama']) {
                $suppliers = Supplier::where('nama', 'like', "%$get[supplier_nama]%")->get();
                foreach ($suppliers as $supplier) {
                    $supplier_barangs = Barang::where('supplier_id', $supplier->id)->get();
                    $barangs->push($supplier_barangs);
                }
                // dd($suppliers);
            } else if ($get['supplier_id']) {
                $suppliers = Supplier::where('id', $get['supplier_id'])->get();
                foreach ($suppliers as $supplier) {
                    $supplier_barangs = Barang::where('supplier_id', $get['supplier_id'])->get();
                    $barangs->push($supplier_barangs);
                }
            } else {
                $suppliers = Supplier::orderBy('nama')->get();
                $barangs = collect();
                foreach ($suppliers as $supplier) {
                    $supplier_barangs = Barang::where('supplier_id', $supplier->id)->get();
                    $barangs->push($supplier_barangs);
                }
            }

        } else {
            $suppliers = Supplier::orderBy('nama')->get();
            $barangs = collect();
            foreach ($suppliers as $supplier) {
                $supplier_barangs = Barang::where('supplier_id', $supplier->id)->get();
                $barangs->push($supplier_barangs);
            }
        }


        $label_suppliers = Supplier::select('id', 'nama as name', 'nama as value')->orderBy('nama')->get();
        $label_barangs = Barang::select('id', 'nama as name', 'nama as value', 'satuan_sub', 'satuan_main', 'satuan_sub', 'harga_main', 'jumlah_main', 'jumlah_sub', 'harga_total_main')->orderBy('nama')->get();

        $data = [
            'suppliers' => $suppliers,
            'barangs' => $barangs,
            'label_suppliers' => $label_suppliers,
            'label_barangs' => $label_barangs,
        ];
        // dd($barangs[0][0]);
        return Inertia::render('Barangs/Index', $data);
    }
}
