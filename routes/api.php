<?php

use App\Http\Controllers\KrakenController;
use Illuminate\Support\Facades\Artisan;

Route::get('/migrate-now', function () {
    try {
        Artisan::call('session:table');
        Artisan::call('migrate', ['--force' => true]);
        return 'Migration berhasil dijalankan.';
    } catch (\Exception $e) {
        return 'Migration gagal: ' . $e->getMessage();
    }
});


Route::post('/kraken/fetch', [KrakenController::class, 'fetchOHLC']);
