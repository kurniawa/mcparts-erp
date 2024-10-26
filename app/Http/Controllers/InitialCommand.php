<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\PembelianBarang;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InitialCommand extends Controller
{
    function index() {
        // sleep(2);
        return Inertia::render('Commands/Index');
    }
    function pembelian_numbers_data_times_100() {
        // dd('ok');
        $pembelians = Pembelian::all();

        foreach ($pembelians as $pembelian) {
            $pembelian->harga_total = (string)((int)$pembelian->harga_total * 100);
            $pembelian->save();
        }
        
        $feedback = [
            'success_' => '-perkalian 100 pada pembelian: numbers_data-'
        ];

        return back()->with($feedback);
    }
    function cancel_pembelian_numbers_data_times_100() {
        // dd('cancel_pembelian_numbers_data_times_100');
        $pembelians = Pembelian::all();
        foreach ($pembelians as $pembelian) {
            $pembelian->harga_total = (string)((int)$pembelian->harga_total / 100);
            $pembelian->save();
        }

        $feedback = [
            'warnings_' => '-perkalian 100 pada pembelian: numbers_data dibatalkan-'
        ];

        return back()->with($feedback);
    }

    function update_pembelian_status_bayar() {
        $pembelians = Pembelian::where('status_bayar', 'BELUM')->get();
        foreach ($pembelians as $pembelian) {
            $pembelian->status_bayar = 'BELUM-LUNAS';
            $pembelian->save();
        }
        
        $feedback = [
            'success_' => '-pembelian: status_bayar: BELUM menjadi BELUM-LUNAS-'
        ];

        return back()->with($feedback);
    }

    function pembelian_barangs_numbers_data_times_100() {
        // dd('ok');
        $pembelian_barangs = PembelianBarang::all();

        foreach ($pembelian_barangs as $pembelian_barang) {
            $harga_sub = null;
            $harga_t = null;
            if ($pembelian_barang->harga_sub) {
                $harga_sub = (string)((int)$pembelian_barang->harga_sub * 100);
            }
            if ($pembelian_barang->harga_t) {
                $harga_t = (string)((int)$pembelian_barang->harga_t * 100);
            }
            $pembelian_barang->harga_sub = $harga_sub;
            $pembelian_barang->harga_main = (string)((int)$pembelian_barang->harga_main * 100);
            $pembelian_barang->harga_t = $harga_t;
            $pembelian_barang->save();
        }
        
        $feedback = [
            'success_' => '-perkalian 100 pada pembelian-barang: numbers_data-'
        ];

        return back()->with($feedback);
    }

    function cancel_pembelian_barangs_numbers_data_times_100() {
        // dd('cancel_pembelian_numbers_data_times_100');
        $pembelian_barangs = PembelianBarang::all();
        foreach ($pembelian_barangs as $pembelian_barang) {
            $harga_sub = null;
            $harga_t = null;
            if ($pembelian_barang->harga_sub) {
                $harga_sub = (string)((int)$pembelian_barang->harga_sub / 100);
            }
            if ($pembelian_barang->harga_t) {
                $harga_t = (string)((int)$pembelian_barang->harga_t / 100);
            }

            $pembelian_barang->harga_sub = $harga_sub;
            $pembelian_barang->harga_t = $harga_t;
            $pembelian_barang->harga_main = (string)((int)$pembelian_barang->harga_main / 100);
            $pembelian_barang->save();
        }

        $feedback = [
            'warnings_' => '-perkalian 100 pada pembelian-barang: numbers_data dibatalkan-'
        ];

        return back()->with($feedback);
    }

    function update_pembelian_barangs_status_bayar() {
        $pembelian_barangs = PembelianBarang::where('status_bayar', 'BELUM')->get();
        foreach ($pembelian_barangs as $pembelian_barang) {
            $pembelian_barang->status_bayar = 'BELUM-LUNAS';
            $pembelian_barang->save();
        }
        
        $feedback = [
            'success_' => '-pembelian_barangs: status_bayar: BELUM menjadi BELUM-LUNAS-'
        ];

        return back()->with($feedback);
    }

    function barangs_numbers_data_times_100() {
        // dd('ok');
        $barangs = Barang::all();

        foreach ($barangs as $barang) {
            $harga_sub = null;
            $harga_total_sub = null;

            if ($barang->harga_sub) {
                $harga_sub = (string)((int)$barang->harga_sub * 100);
            }
            if ($barang->harga_total_sub) {
                $harga_total_sub = (string)((int)$barang->harga_total_sub * 100);
            }

            $harga_main = (string)((int)$barang->harga_main * 100);
            $harga_total_main = (string)((int)$barang->harga_total_main * 100);

            $barang->harga_main = $harga_main;
            $barang->harga_total_main = $harga_total_main;
            $barang->harga_sub = $harga_sub;
            $barang->harga_total_sub = $harga_total_sub;
            $barang->save();
        }
        
        $feedback = [
            'success_' => '-perkalian 100 pada barangs: numbers_data-'
        ];

        return back()->with($feedback);
    }

    function cancel_barangs_numbers_data_times_100() {
        // dd('cancel_pembelian_numbers_data_times_100');
        $barangs = Barang::all();
        foreach ($barangs as $barang) {
            $harga_sub = null;
            $harga_total_sub = null;

            if ($barang->harga_sub) {
                $harga_sub = (string)((int)$barang->harga_sub / 100);
            }
            if ($barang->harga_total_sub) {
                $harga_total_sub = (string)((int)$barang->harga_total_sub / 100);
            }

            $harga_main = (string)((int)$barang->harga_main / 100);
            $harga_total_main = (string)((int)$barang->harga_total_main / 100);

            $barang->harga_main = $harga_main;
            $barang->harga_total_main = $harga_total_main;
            $barang->harga_sub = $harga_sub;
            $barang->harga_total_sub = $harga_total_sub;
            $barang->save();
        }

        $feedback = [
            'warnings_' => '-perkalian 100 pada barangs: numbers_data dibatalkan-'
        ];

        return back()->with($feedback);
    }
}
