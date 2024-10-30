<?php

use App\Http\Controllers\InitialCommand;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
    // return Inertia::render('Welcome');
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(PembelianController::class)->group(function () {
    Route::get('/pembelians/index', 'index')->name('pembelians.index')->middleware(['auth', 'verified']);
    Route::get('/pembelians/{pembelian}/show', 'show')->name('pembelians.show')->middleware(['auth', 'verified']);
    Route::get('/pembelians/{pembelian}/edit', 'edit')->name('pembelians.edit')->middleware(['auth', 'verified']);
    Route::post('/pembelians/{pembelian}/delete', 'delete')->name('pembelians.delete')->middleware(['auth', 'verified']);
    Route::post('/pembelians/store', 'store')->name('pembelians.store')->middleware(['auth', 'verified']);
    Route::get('/barangs', 'index')->name('barangs.index')->middleware(['auth', 'verified']);

});

Route::controller(InitialCommand::class)->group(function () {
    Route::get('/initial-commands/index', 'index')->name('initial_commands.index')->middleware(['auth', 'verified', 'superadmin']);
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
