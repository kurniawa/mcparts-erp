<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\NotaSrjalan;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Spk;
use App\Models\SpkNota;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
use App\Models\Srjalan;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomeController extends Controller
{
    function home(Request $request) {
        // $user_role = Auth::user()->role;
        $get = $request->query();
        // dump($get);

        $spks = collect();
        $nama_pelanggans = collect(); // Ini diperlukan untuk menampilkan nama reseller, apabila ada reseller.
        $col_spk_produks = collect();
        $col_notas = collect();
        $col_spk_produk_notas = collect();
        $col_srjalans = collect();
        $col_spk_produk_nota_srjalans = collect();

        
        $selectRawSPK = "id, no_spk, pelanggan_nama, pxr_name, created_at, finished_at, created_by, updated_by,
        DATE_FORMAT(created_at, '%d') as created_day, 
        DATE_FORMAT(created_at, '%m') as created_month, 
        DATE_FORMAT(created_at, '%y') as created_year,
        DATE_FORMAT(finished_at, '%d') as finished_day, 
        DATE_FORMAT(finished_at, '%m') as finished_month, 
        DATE_FORMAT(finished_at, '%y') as finished_year";

        $selectRawNota = "id, no_nota, pelanggan_nama, harga_total, status_bayar, created_at, finished_at, created_by, updated_by,
        DATE_FORMAT(created_at, '%d') as created_day, 
        DATE_FORMAT(created_at, '%m') as created_month, 
        DATE_FORMAT(created_at, '%y') as created_year,
        DATE_FORMAT(finished_at, '%d') as finished_day, 
        DATE_FORMAT(finished_at, '%m') as finished_month, 
        DATE_FORMAT(finished_at, '%y') as finished_year";

        $selectRawSJ = "id, no_srjalan, pelanggan_nama, ekspedisi_nama, transit_nama, created_at,
        DATE_FORMAT(created_at, '%d') as created_day, 
        DATE_FORMAT(created_at, '%m') as created_month, 
        DATE_FORMAT(created_at, '%y') as created_year";

        // Kode dibawah ini akan dijalankan apabila user melakukan filtrasi
        if (count($get)) {
            // dd($get);
            $filter_date = true;
            if ($get['from_day'] === null || $get['from_month'] === null || $get['from_year'] === null || $get['to_day'] === null || $get['to_month'] === null || $get['to_year'] === null) {
                $filter_date = false;
            }

            if ($get['customer']['nama'] !== null) {
                if (!$filter_date) {
                    // Filter Berdasarkan Nama Pelanggan - Tanpa Tanggal
                    $spks = Spk::selectRaw($selectRawSPK)->where('pelanggan_id', $get['customer']['id'])->latest()->get();
                    // End - Filter Berdasarkan Nama Pelanggan - Tanpa Tanggal
                } else {
                    // Filter Berdasarkan Nama Pelanggan + Tanggal
                    $start_date = "$get[from_year]-$get[from_month]-$get[from_day]";
                    $end_date = "$get[to_year]-$get[to_month]-$get[to_day] 23:59:59";
                    $spks = Spk::selectRaw($selectRawSPK)->where('pelanggan_id', $get['customer']['id'])->whereBetween('created_at', [$start_date, $end_date])->latest()->get();
                    // End - Filter Berdasarkan Nama Pelanggan + Tanggal
                }
            } else {
                // Filter hanya rentang waktu, tanpa nama_pelanggan
                if (!$filter_date) {
                    $request->validate(['error'=>'required'],['error.required'=>'customer,time_range']);
                } else {
                    // Filter Berdasarkan Tanggal
                    $start_date = "$get[from_year]-$get[from_month]-$get[from_day]";
                    $end_date = "$get[to_year]-$get[to_month]-$get[to_day] 23:59:59";
                    $spks = Spk::selectRaw($selectRawSPK)->whereBetween('created_at', [$start_date, $end_date])->latest()->get();
                    // End - Filter Berdasarkan Tanggal
                }
                // END - Filter hanya rentang waktu, tanpa nama_pelanggan
            }
        } else {
            $spks = Spk::selectRaw($selectRawSPK)->latest()->limit(200)->get();
        }
        // dd($spks);
        $profile_pictures_paths = array();
        foreach ($spks as $spk) {
            // dd($spk::user($spk->created_by));
            // SPK Items
            $spk_produks = SpkProduk::where('spk_id', $spk->id)->get();
            $col_spk_produks->push($spk_produks);
            // END - SPK Items

            // // NAMA PELANGGANS
            // $nama_pelanggan = $spk->pelanggan_nama;
            // if ($spk->reseller_nama !== null) {
            //     $nama_pelanggan = "$spk->reseller_nama - $spk->pelanggan_nama";
            // }
            // dump($spk->reseller_nama);
            // $nama_pelanggans->push($nama_pelanggan);
            // // END - NAMA PELANGGANS
            $spk_notas = SpkNota::where('spk_id', $spk->id)->get();
            $notas = collect();
            $arr_srjalans = collect();

            $spk_produk_notas = collect();
            $spk_produk_nota_srjalans = collect();
            foreach ($spk_notas as $spk_nota) {
                $nota = Nota::selectRaw($selectRawNota)->find($spk_nota->nota_id);
                $notas->push($nota);
                $nota_srjalans = NotaSrjalan::where('nota_id', $nota->id)->get();
                $spk_produk_notas->push(SpkProdukNota::where('nota_id', $nota->id)->get());
                $srjalans = collect();
                foreach ($nota_srjalans as $nota_srjalan) {
                    $srjalan = Srjalan::selectRaw($selectRawSJ)->find($nota_srjalan->srjalan_id);
                    $srjalans->push($srjalan);
                    $spkProdukNotaSrjalans = SpkProdukNotaSrjalan::select('id', 'spk_produk_nota_id', 'jumlah_packing', 'tipe_packing')->where('srjalan_id', $srjalan->id)->get();
                    // dump($spkProdukNotaSrjalans);
                    $spnsrs = collect();
                    foreach ($spkProdukNotaSrjalans as $spk_produk_nota_srjalan) {
                        try {
                            $spnsrs->push([
                                'nama_nota' => $spk_produk_nota_srjalan->spk_produk_nota->nama_nota,
                                'jumlah_packing' => $spk_produk_nota_srjalan->jumlah_packing,
                                'tipe_packing' => $spk_produk_nota_srjalan->tipe_packing,
                            ]);
                        } catch (\Throwable $th) {
                            // dump($spk_produk_nota_srjalan);
                            // dd($spk_produk_nota_srjalans);
                        }
                    }
                    $spk_produk_nota_srjalans->push($spnsrs);
                }
                $arr_srjalans->push($srjalans);
            }
            $col_notas->push($notas);
            $col_srjalans->push($arr_srjalans);
            $col_spk_produk_notas->push($spk_produk_notas);
            $col_spk_produk_nota_srjalans->push($spk_produk_nota_srjalans);
            if ($spk::user($spk->created_by)->profile_picture) {
                $profile_pictures_paths[] = asset("storage/" . $spk::user($spk->created_by)->profile_picture);
            } else {
                $profile_pictures_paths[] = null;
            }
        }

        // dump($col_notas);
        // dd($col_srjalans);
        // $label_pelanggans = Pelanggan::label_pelanggans();
        // $label_produks = Produk::select('id', 'nama as label', 'nama as value')->get();
        // dump($spks);
        // dd($profile_pictures_paths);
        // dd($nama_pelanggans);
        $data = [
            // 'goback' => 'home',
            // 'user_role' => $user_role,
            'spks' => $spks,
            'profile_pictures_paths' => $profile_pictures_paths,
            'nama_pelanggans' => $nama_pelanggans,
            'col_notas' => $col_notas,
            'col_srjalans' => $col_srjalans,
            'col_spk_produks' => $col_spk_produks,
            'col_spk_produk_notas' => $col_spk_produk_notas,
            'col_spk_produk_nota_srjalans' => $col_spk_produk_nota_srjalans,
            // 'label_pelanggans' => $label_pelanggans,
            // 'label_produks' => $label_produks,
            // 'user' => Auth::user(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ];
        // dump($user_role);
        // dd($spks[7]);
        // dd($col_srjalans[7]);
        // dd($data);
        // dd($col_spk_produk_notas[0]);
        // dd($label_pelanggans[0]);

        $dump = false;
        if ($dump) {
            foreach ($spks as $key => $spk) {
                foreach ($col_notas[$key] as $key2 => $nota) {
                    if (isset($col_spk_produk_nota_srjalans[$key])) {
                        if (isset($col_spk_produk_nota_srjalans[$key][$key2])) {
                        } else {
                            if (count($col_srjalans[$key][$key2]) !== 0) {
                                dump($col_srjalans[$key][$key2]);
                                dump($nota->id);
                            }
                        }
                    }
                }
            }
            dd('cek error');
        }
        return Inertia::render('Welcome', $data);
    }
}
