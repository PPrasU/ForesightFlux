<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\DataAPIController;
use App\Http\Controllers\DataHasilController;
use App\Http\Controllers\DataImportController;
use App\Http\Controllers\PetunjukAPIController;
use App\Http\Controllers\SettingParamController;
use App\Http\Controllers\DataPraProsesController;
use App\Http\Controllers\PetunjukImportController;

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
    Route::delete('/API/hapus', [DataAPIController::class, 'hapus'])->name('hapusDataAPI');
    
    Route::get('/import', [DataImportController::class, 'index'])->name('importData');
    Route::get('/import/input', [DataImportController::class, 'input'])->name('inputImportData');
    Route::post('/import/post', [DataImportController::class, 'post'])->name('postImportData');
    Route::post('/import/pra-proses', [DataImportController::class, 'praProses'])->name('praProsesImportData');
    Route::delete('/import/hapus', [DataImportController::class, 'hapus'])->name('hapusImportData');
});

Route::prefix('peramalan')->name('peramalan.')->group(function () {
    Route::get('/proses', [DataPraProsesController::class, 'index'])->name('prosesPeramalan');
    Route::delete('/proses/hapus', [DataPraProsesController::class, 'hapus'])->name('hapusPraProsesPeramalan');

    Route::get('/hasil', [DataHasilController::class, 'index'])->name('hasil');
    Route::get('/hasil/hapus', [DataHasilController::class, 'hapus'])->name('hapusHasil');
    Route::post('/hasil/export', [DataHasilController::class, 'export'])->name('exportHasil');
});

// Route::resource(name: 'batagocilok', controller: BatagorCilok::class);

// ------------------------------------ ADMIN -----------------------------------

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dasbor', function () {
        return view('admin.dasbor');
    })->name('dasbor');

    Route::get('/petunjuk-import', [PetunjukImportController::class, 'index'])->name('petunjukImport');
    Route::get('/petunjuk-import/input', [PetunjukImportController::class, 'input'])->name('inputpetunjukImport');
    Route::post('/petunjuk-import/post', [PetunjukImportController::class, 'post'])->name('postpetunjukImport');
    Route::get('/petunjuk-import/edit/{id}', [PetunjukImportController::class, 'edit'])->name('editpetunjukImport');
    Route::post('/petunjuk-import/update/{id}', [PetunjukImportController::class, 'update'])->name('updatepetunjukImport');
    Route::get('/petunjuk-import/hapus/{id}', [PetunjukImportController::class, 'hapus'])->name('hapuspetunjukImport');

    Route::get('/petunjuk-API', [PetunjukAPIController::class, 'index'])->name('petunjukAPI');
    Route::get('/petunjuk-API/input', [PetunjukAPIController::class, 'input'])->name('inputpetunjukAPI');
    Route::post('/petunjuk-API/post', [PetunjukAPIController::class, 'post'])->name('postpetunjukAPI');
    Route::get('/petunjuk-API/edit/{id}', [PetunjukAPIController::class, 'edit'])->name('editpetunjukAPI');
    Route::post('/petunjuk-API/update/{id}', [PetunjukAPIController::class, 'update'])->name('updatepetunjukAPI');
    Route::get('/petunjuk-API/hapus/{id}', [PetunjukAPIController::class, 'hapus'])->name('hapuspetunjukAPI');

    Route::get('/setting-params', [SettingParamController::class, 'index'])->name('settingParams');
    Route::post('/setting-params/update/{id}', [SettingParamController::class, 'update'])->name('updateSettingParams');
    

    Route::get('/user-management', function () {
        return view('admin.um');
    })->name('userManagement');

});

Route::get('/clear-notifications', function() {
    session()->forget('notifications');
    return redirect()->back();
})->name('notifikasi.clear');
