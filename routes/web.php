<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TagihanController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
$ctrl = "\App\Http\Controllers";
Route::get('/', [HomeController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [HomeController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function()use($ctrl){
    Route::resource('user', UserController::class);
    Route::post('user/logout', [UserController::class,'logout'])->name('user.logout');
    Route::resource('pelanggan', PelangganController::class);
    Route::post('pelanggan/get_data', [PelangganController::class,'data'])->name('pelanggan.data');
    Route::resource('tagihan', TagihanController::class);
    Route::group(['prefix'=>'datatable','as'=>'datatable.'],function()use($ctrl){
        Route::get('user',[UserController::class,'datatable'])->name('user');
        Route::get('pelanggan',[PelangganController::class,'datatable'])->name('pelanggan');
        Route::get('tagihan',[TagihanController::class,'datatable'])->name('tagihan');

    });
    
});

require __DIR__.'/auth.php';
