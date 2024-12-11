<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InitialCommand;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteApiController;
use App\Http\Controllers\SpkController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
//     // return Inertia::render('Welcome');
// })->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(HomeController::class)->group(function(){
    Route::get('/','home')->name('home')->middleware('auth');
    Route::get('/settings','settings')->name('settings')->middleware('auth');
});

Route::controller(SpkController::class)->group(function(){
    // Route::get('/spks','index')->name('spks.index')->middleware('auth');
    Route::get('/spks/{spk}/show','show')->name('spks.show')->middleware('auth');
    Route::get('/spks/{spk}/print_out','print_out')->name('spks.print_out')->middleware('auth');
    Route::get('/spks/create','create')->name('spks.create')->middleware('auth');
    Route::post('/spks/{spk}/edit_keterangan','edit_keterangan')->name('spks.edit_keterangan')->middleware('auth');
    Route::post('/spks/{spk}/edit_pelanggan','edit_pelanggan')->name('spks.edit_pelanggan')->middleware('auth');
    Route::post('/spks/{spk}/edit_tanggal','edit_tanggal')->name('spks.edit_tanggal')->middleware('auth');
    Route::post('/spks/store','store')->name('spks.store')->middleware('auth');
    Route::post('/spks/{spk_produk}/spk_item_tetapkan_selesai','spk_item_tetapkan_selesai')->name('spks.spk_item_tetapkan_selesai')->middleware('auth');
    Route::post('/spks/{spk}/delete','delete')->name('spks.delete')->middleware('auth');
    Route::post('/spks/{spk}/selesai_all','selesai_all')->name('spks.selesai_all')->middleware('auth');
    Route::post('/spks/{spk}/add_item','add_item')->name('spks.add_item')->middleware('auth');
    Route::post('/spks/{spk}/{spk_produk}/delete_item','delete_item')->name('spks.delete_item')->middleware('auth');
    Route::post('/spks/{spk}/{spk_produk}/edit_jumlah_deviasi','edit_jumlah_deviasi')->name('spks.edit_jumlah_deviasi')->middleware('auth');
    Route::post('/spks/{spk}/{spk_produk}/spk_produk_edit_keterangan','spk_produk_edit_keterangan')->name('spks.spk_produk_edit_keterangan')->middleware('auth');
    Route::post('/spks/{spk}/{spk_produk_nota}/spk_produk_nota_edit_keterangan','spk_produk_nota_edit_keterangan')->name('spks.spk_produk_nota_edit_keterangan')->middleware('auth');
    
});

Route::controller(RouteApiController::class)->group(function() {
    Route::get('/api/search_products','api_search_products')->name('spks.api_search_products')->middleware('auth');
});

Route::controller(PelangganController::class)->group(function(){
    Route::get('/pelanggans','index')->name('pelanggans.index');
    Route::get('/pelanggans/create','create')->name('pelanggans.create');
    Route::post('/pelanggans/store','store')->name('pelanggans.store');
    Route::post('/pelanggans/{pelanggan}/delete','delete')->name('pelanggans.delete');
    Route::get('/pelanggans/{pelanggan}/show','show')->name('pelanggans.show')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/kontak_add','kontak_add')->name('pelanggans.kontak_add')->middleware('auth');
    Route::post('/pelanggans/{pelanggan_kontak}/kontak_edit','kontak_edit')->name('pelanggans.kontak_edit')->middleware('auth');
    Route::post('/pelanggans/{pelanggan_kontak}/kontak_delete','kontak_delete')->name('pelanggans.kontak_delete')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/{pelanggan_kontak}/kontak_utama','kontak_utama')->name('pelanggans.kontak_utama')->middleware('auth');
    Route::get('/pelanggans/{pelanggan}/alamat_add','alamat_add')->name('pelanggans.alamat_add')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/alamat_add','alamat_add_post')->name('pelanggans.alamat_add_post')->middleware('auth');
    Route::post('/pelanggans/{alamat}/delete_alamat','delete_alamat')->name('pelanggans.delete_alamat')->middleware('auth');
    Route::get('/pelanggans/{pelanggan}/{alamat}/alamat_edit','alamat_edit')->name('pelanggans.alamat_edit')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/{alamat}/alamat_edit','alamat_edit_post')->name('pelanggans.alamat_edit_post')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/{alamat}/alamat_utama','alamat_utama')->name('pelanggans.alamat_utama')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/ekspedisi_add','ekspedisi_add')->name('pelanggans.ekspedisi_add')->middleware('auth');
    Route::post('/pelanggans/{pelanggan_ekspedisi}/ekspedisi_delete','ekspedisi_delete')->name('pelanggans.ekspedisi_delete')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/{pelanggan_ekspedisi}/ekspedisi_utama','ekspedisi_utama')->name('pelanggans.ekspedisi_utama')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/transit_add','transit_add')->name('pelanggans.transit_add')->middleware('auth');
    Route::post('/pelanggans/{pelanggan_ekspedisi}/transit_delete','transit_delete')->name('pelanggans.transit_delete')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/{pelanggan_ekspedisi}/transit_utama','transit_utama')->name('pelanggans.transit_utama')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/update_nama','update_nama')->name('pelanggans.update_nama')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/reseller_add','reseller_add')->name('pelanggans.reseller_add')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/reseller_update','reseller_update')->name('pelanggans.reseller_update')->middleware('auth');
    Route::post('/pelanggans/{pelanggan}/reseller_delete','reseller_delete')->name('pelanggans.reseller_delete')->middleware('auth');
});

Route::controller(EkspedisiController::class)->group(function(){
    Route::get('/ekspedisis','index')->name('ekspedisis.index');
    Route::get('/ekspedisis/{ekspedisi}/show','show')->name('ekspedisis.show');
    Route::post('/ekspedisis/store','store')->name('ekspedisis.store');
    Route::post('/ekspedisis/{ekspedisi}/delete','delete')->name('ekspedisis.delete');
    Route::post('/ekspedisis/{ekspedisi}/alamat_add','alamat_add')->name('ekspedisis.alamat_add');
    Route::post('/ekspedisis/{ekspedisi}/{alamat}/alamat_utama','alamat_utama')->name('ekspedisis.alamat_utama');
    Route::post('/ekspedisis/{ekspedisi}/{alamat}/alamat_edit','alamat_edit')->name('ekspedisis.alamat_edit')->middleware('auth');
    Route::post('/ekspedisis/{ekspedisi}/{alamat}/alamat_delete','alamat_delete')->name('ekspedisis.alamat_delete')->middleware('auth');
    Route::post('/ekspedisis/{ekspedisi}/kontak_add','kontak_add')->name('ekspedisis.kontak_add')->middleware('auth');
    Route::post('/ekspedisis/{ekspedisi_kontak}/kontak_edit','kontak_edit')->name('ekspedisis.kontak_edit')->middleware('auth');
    Route::post('/ekspedisis/{ekspedisi_kontak}/kontak_delete','kontak_delete')->name('ekspedisis.kontak_delete')->middleware('auth');
    Route::post('/ekspedisis/{ekspedisi}/{ekspedisi_kontak}/kontak_utama','kontak_utama')->name('ekspedisis.kontak_utama')->middleware('auth');
});

Route::controller(ProdukController::class)->group(function(){
    Route::get('/produks','index')->name('produks.index');
    Route::get('/produks/{produk}/show','show')->name('produks.show');
    Route::post('/produks/store','store')->name('produks.store');
    Route::post('/produks/{produk}/update','update')->name('produks.update');
    Route::post('/produks/{produk}/delete','delete')->name('produks.delete');
});

Route::controller(PembelianController::class)->group(function () {
    Route::get('/pembelians/index', 'index')->name('pembelians.index')->middleware(['auth', 'verified']);
    Route::get('/pembelians/{pembelian}/show', 'show')->name('pembelians.show')->middleware(['auth', 'verified']);
    Route::get('/pembelians/{pembelian}/edit', 'edit')->name('pembelians.edit')->middleware(['auth', 'verified']);
    Route::post('/pembelians/{pembelian}/delete', 'delete')->name('pembelians.delete')->middleware(['auth', 'verified']);
    Route::post('/pembelians/store', 'store')->name('pembelians.store')->middleware(['auth', 'verified']);
});

Route::controller(BarangController::class)->group(function () {
    Route::get('/barangs/index', 'index')->name('barangs.index')->middleware(['auth', 'verified']);
    Route::get('/barangs/{barang}/show', 'show')->name('barangs.show')->middleware(['auth', 'verified']);
    Route::get('/barangs/{barang}/edit', 'edit')->name('barangs.edit')->middleware(['auth', 'verified']);
    Route::post('/barangs/{barang}/delete', 'delete')->name('barangs.delete')->middleware(['auth', 'verified']);
    Route::post('/barangs/store', 'store')->name('barangs.store')->middleware(['auth', 'verified']);
});

Route::controller(InitialCommand::class)->group(function () {
    Route::get('/initial-commands/index', 'index')->name('initial_commands.index')->middleware(['auth', 'verified', 'superadmin']);
    Route::post('/initial-commands/update_clearance_level', 'update_clearance_level')->name('initial_commands.update_clearance_level')->middleware(['auth', 'verified', 'superadmin']);
    Route::post('/initial-commands/pembelians_numbers_data_times_100', 'pembelians_numbers_data_times_100')->name('initial_commands.pembelians_numbers_data_times_100')->middleware(['auth', 'verified', 'superadmin']); 
    Route::post('/initial-commands/cancel_pembelians_numbers_data_times_100', 'cancel_pembelians_numbers_data_times_100')->name('initial_commands.cancel_pembelians_numbers_data_times_100')->middleware(['auth', 'verified', 'superadmin']); 
    Route::post('/initial-commands/update_pembelian_status_bayar', 'update_pembelian_status_bayar')->name('initial_commands.update_pembelian_status_bayar')->middleware(['auth', 'verified', 'superadmin']);
    Route::post('/initial-commands/pembelian_barangs_numbers_data_times_100', 'pembelian_barangs_numbers_data_times_100')->name('initial_commands.pembelian_barangs_numbers_data_times_100')->middleware(['auth', 'verified', 'superadmin']); 
    Route::post('/initial-commands/cancel_pembelian_barangs_numbers_data_times_100', 'cancel_pembelian_barangs_numbers_data_times_100')->name('initial_commands.cancel_pembelian_barangs_numbers_data_times_100')->middleware(['auth', 'verified', 'superadmin']);
    Route::post('/initial-commands/update_pembelian_barangs_status_bayar', 'update_pembelian_barangs_status_bayar')->name('initial_commands.update_pembelian_barangs_status_bayar')->middleware(['auth', 'verified', 'superadmin']);
    Route::post('/initial-commands/barangs_numbers_data_times_100', 'barangs_numbers_data_times_100')->name('initial_commands.barangs_numbers_data_times_100')->middleware(['auth', 'verified', 'superadmin']); 
    Route::post('/initial-commands/cancel_barangs_numbers_data_times_100', 'cancel_barangs_numbers_data_times_100')->name('initial_commands.cancel_barangs_numbers_data_times_100')->middleware(['auth', 'verified', 'superadmin']);
});

require __DIR__.'/auth.php';
