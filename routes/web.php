<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TagihanPemasanganController;
use App\Http\Controllers\PembayaranPemasanganController;
use App\Http\Controllers\CekTagihanController;
use App\Http\Controllers\TemplatePesanController;
use App\Http\Controllers\PembayaranTelatController;
use App\Http\Controllers\HistoryPesanController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$ctrl = "\App\Http\Controllers";
Route::get('/', [HomeController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [HomeController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function()use($ctrl){
    Route::resource('user', UserController::class);
    Route::post('user/logout', [UserController::class,'logout'])->name('user.logout');
    Route::resource('pelanggan', PelangganController::class);
    Route::post('pelanggan/get_data', [PelangganController::class,'data'])->name('pelanggan.data');
    Route::get('pelanggan/{id}/history_tagihan', [PelangganController::class,'history_tagihan'])->name('pelanggan.history_tagihan');
    Route::post('tagihan/get_data', [TagihanController::class,'data'])->name('tagihan.data');
    Route::get('tagihan/{id}/download_file', [TagihanController::class,'show_file'])->name('tagihan.download_file');
    Route::get('tagihan/{id}/nota', [TagihanController::class,'nota'])->name('tagihan.nota');
    Route::get('tagihan_telat',[TagihanController::class,'tagihan_telat'])->name('tagihan_telat');
    Route::get('pembayaran/{id}/nota', [PembayaranController::class,'nota'])->name('pembayaran.nota');
    Route::post('tagihan_pemasangan/get_data', [TagihanPemasanganController::class,'data'])->name('tagihan_pemasangan.data');
    Route::get('pembayaran_pemasangan/{id}/nota', [PembayaranPemasanganController::class,'nota'])->name('pembayaran_pemasangan.nota');
    Route::resource('tagihan', TagihanController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('tagihan_pemasangan', TagihanPemasanganController::class);
    Route::resource('pembayaran_pemasangan', PembayaranPemasanganController::class);
    Route::resource('template_pesan', TemplatePesanController::class);
    Route::resource('pembayaran_telat', PembayaranTelatController::class);
    Route::resource('history_pesan', HistoryPesanController::class);

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');

    Route::get('kirim_pesan/{id}', [HistoryPesanController::class,'kirim_pesan'])->name('kirim_pesan');
    Route::get('kirim_pesan_terlambat', [HistoryPesanController::class, 'kirim_pesan_terlambat'])->name('kirim_pesan_terlambat');
    Route::group(['prefix'=>'datatable','as'=>'datatable.'],function()use($ctrl){
        Route::get('user',[UserController::class,'datatable'])->name('user');
        Route::get('pelanggan',[PelangganController::class,'datatable'])->name('pelanggan');
        Route::get('tagihan',[TagihanController::class,'datatable'])->name('tagihan');
        Route::get('pembayaran',[PembayaranController::class,'datatable'])->name('pembayaran');
        Route::get('tagihan_pemasangan',[TagihanPemasanganController::class,'datatable'])->name('tagihan_pemasangan');
        Route::get('pembayaran_pemasangan',[PembayaranPemasanganController::class,'datatable'])->name('pembayaran_pemasangan');
        Route::get('cek_tagihan/tagihan',[CekTagihanController::class,'datatable_tagihan'])->name('cek_tagihan.tagihan');
        Route::get('cek_tagihan/tagihan_pemasangan',[CekTagihanController::class,'datatable_tagihan_pemasangan'])->name('cek_tagihan.tagihan_pemasangan');
        Route::get('template_pesan',[TemplatePesanController::class,'datatable'])->name('template_pesan');
        Route::get('pembayaran_telat',[PembayaranTelatController::class,'datatable'])->name('pembayaran_telat');
        Route::get('history_pesan',[HistoryPesanController::class,'datatable'])->name('history_pesan');
        Route::get('history_tagihan',[PelangganController::class,'datatable_history_tagihan'])->name('history_tagihan');
    });

    Route::group(['prefix'=>'cek_tagihan','as'=>'cek_tagihan.'],function()use($ctrl){
        Route::get('tagihan',[CekTagihanController::class,'tagihan'])->name('tagihan');
        Route::get('tagihan_pemasangan',[CekTagihanController::class,'tagihan_pemasangan'])->name('tagihan_pemasangan');
    });
    
});

require __DIR__.'/auth.php';
