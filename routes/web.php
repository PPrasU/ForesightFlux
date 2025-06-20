<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\KrakenController;
use App\Http\Controllers\DataAPIController;
use App\Http\Controllers\DataHasilController;
use App\Http\Controllers\DasborUserController;
use App\Http\Controllers\DataImportController;
use App\Http\Controllers\DasborAdminController;
use App\Http\Controllers\PetunjukAPIController;
use App\Http\Controllers\SettingParamController;

use App\Http\Controllers\DataPraProsesController;
use App\Http\Controllers\PetunjukImportController;

Route::get('/migrate-now', function () {
    try {
        Artisan::call('session:table');
        Artisan::call('migrate', ['--force' => true]);
        return 'Migration berhasil dijalankan.';
    } catch (\Exception $e) {
        return 'Migration gagal: ' . $e->getMessage();
    }
});
Route::get('/migrate-noww', function () {
    try {
        // Artisan::call('session:table');
        Artisan::call('migrate', ['--force' => true]);
        return 'Migration berhasil dijalankan.';
    } catch (\Exception $e) {
        return 'Migration gagal: ' . $e->getMessage();
    }
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Config cache sudah di-refresh';
});
Route::get('/check-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Database terkoneksi dengan baik.';
    } catch (\Exception $e) {
        return 'Koneksi database gagal: ' . $e->getMessage();
    }
});
Route::get('/clear-routes', function () {
    Artisan::call('route:clear');
    return 'Route cache cleared!';
});
Route::get('/link-storage', function () {
    Artisan::call('storage:link');
    return 'Storage linked!';
});
Route::get('/migrate-fresh', function () {
    try {
        Artisan::call('migrate:fresh', ['--force' => true]);
        return 'Migrate fresh berhasil dijalankan.';
    } catch (\Exception $e) {
        return 'Gagal: ' . $e->getMessage();
    }
});
Route::get('/drop-all-tables', function () {
    $tables = DB::select("SELECT tablename FROM pg_tables WHERE schemaname = 'public'");
    foreach ($tables as $table) {
        DB::statement("DROP TABLE IF EXISTS {$table->tablename} CASCADE");
    }
    return 'Semua tabel berhasil dihapus';
});
Route::get('/drop-all-tabless', function () {
    DB::beginTransaction();

    try {
        DB::statement('DROP SCHEMA public CASCADE');
        DB::statement('CREATE SCHEMA public');
        DB::commit();
        return 'Schema public berhasil di-reset total';
    } catch (\Exception $e) {
        DB::rollBack();
        return 'Gagal reset schema: ' . $e->getMessage();
    }
});

Route::get('/reset-database', function () {
    try {
        // 1. Hapus semua tabel (kalau ada sisa)
        $tables = DB::select("SELECT tablename FROM pg_tables WHERE schemaname = 'public'");
        foreach ($tables as $table) {
            DB::statement("DROP TABLE IF EXISTS {$table->tablename} CASCADE");
        }

        // 2. Reset migration tracking
        DB::statement("DROP TABLE IF EXISTS migrations");

        return '✅ Semua tabel & riwayat migrasi dihapus';
    } catch (\Exception $e) {
        return '❌ Error: ' . $e->getMessage();
    }
});


Route::post('/kraken/fetch', [KrakenController::class, 'fetchOHLC']);

Route::get('/', function () {
    return view('welcome');
})->name('awal');

Route::get('/dasbor', [DasborUserController::class, 'index'])->name('dashboard');

Route::get('/petunjuk-penggunaan', [PetunjukImportController::class, 'petunjukPenggunaan'])->name('petunjukPenggunaan');

Route::get('/pergerakan-kripto', function () {
    return view('pergerakan');
})->name('pergerakan-kripto');

Route::get('/pertanyaan-umum', function () {
    return view('faq');
})->name('faq');

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
    Route::get('/proses', [DataPraProsesController::class, 'index'])->name('index');
    Route::post('/proses-peramalan', [DataPraProsesController::class, 'post'])->name('post');
    Route::delete('/proses/hapus', [DataPraProsesController::class, 'hapus'])->name('hapusPraProsesPeramalan');

    Route::get('/hasil', [DataHasilController::class, 'index'])->name('hasil');
    Route::delete('/hasil/hapus', [DataHasilController::class, 'hapus'])->name('hapusHasil');
});

// Route::resource(name: 'batagocilok', controller: BatagorCilok::class);

// ------------------------------------ ADMIN -----------------------------------

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dasbor', [DasborAdminController::class, 'index'])->name('dasbor');

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
    

    Route::get('/user-management', function () {
        return view('admin.um');
    })->name('userManagement');
});

Route::get('/setting-params', [SettingParamController::class, 'index'])->name('settingParams');
Route::post('/setting-params/update/{id}', [SettingParamController::class, 'update'])->name('updateSettingParams');
Route::post('/optimize', [SettingParamController::class, 'optimize'])->name('optimize');

Route::get('/clear-notifications', function() {
    session()->forget('notifications');
    return redirect()->back();
})->name('notifikasi.clear');
