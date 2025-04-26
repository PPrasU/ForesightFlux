<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\DataAPIController;
use App\Http\Controllers\DataHasilController;
use App\Http\Controllers\DataImportController;
use App\Http\Controllers\DataPraProsesController;

Route::get('/', function () {
    return view('welcome');
})->name('awal');

Route::get('/dasbor', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/petunjuk-penggunaan', function () {
    return view('petunjukPenggunaan');
})->name('petunjukPenggunaan');

Route::get('/pergerakan-kripto', function () {
    return view('pergerakan');
})->name('pergerakan-kripto');

Route::prefix('data')->name('data.')->group(function () {
    Route::get('/API', [DataAPIController::class, 'index'])->name('dataAPI');
    Route::get('/API/input', [DataAPIController::class, 'input'])->name('inputDataAPI');
    Route::post('/API/post', [DataAPIController::class, 'post'])->name('postDataAPI');
    Route::post('/API/pra-proses', [DataAPIController::class, 'praProses'])->name('praProsesAPI');
    Route::get('/API/hapus', [DataAPIController::class, 'hapus'])->name('hapusDataAPI');
    
    Route::get('/import', [DataImportController::class, 'index'])->name('importData');
    Route::get('/import/input', [DataImportController::class, 'input'])->name('inputImportData');
    Route::post('/import/post', [DataImportController::class, 'post'])->name('postImportData');
    Route::post('/import/pra-proses', [DataImportController::class, 'praProses'])->name('praProsesImportData');
    Route::get('/import/hapus', [DataImportController::class, 'hapus'])->name('hapusImportData');
});

Route::prefix('peramalan')->name('peramalan.')->group(function () {
    Route::get('/proses', [DataPraProsesController::class, 'index'])->name('prosesPeramalan');
    // Route::post('/proses/pra-proses', [DataPraProsesController::class, 'proses'])->name('prosesData');
    Route::get('/proses/hapus', [DataPraProsesController::class, 'hapus'])->name('hapusProsesPeramalan');
    Route::post('/proses/export', [DataPraProsesController::class, 'export'])->name('exportProsesPeramalan');

    Route::get('/hasil', [DataHasilController::class, 'index'])->name('hasil');
    Route::get('/hasil/hapus', [DataHasilController::class, 'hapus'])->name('hapusHasil');
    Route::post('/hasil/export', [DataHasilController::class, 'export'])->name('exportHasil');
});

