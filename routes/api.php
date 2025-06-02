<?php

use App\Http\Controllers\KrakenController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/migrate-now', function () {
    try {
        Artisan::call('session:table');
        Artisan::call('migrate', ['--force' => true]);
        return response()->json(['status' => 'success', 'message' => 'Migration berhasil dijalankan.']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
});


Route::post('/kraken/fetch', [KrakenController::class, 'fetchOHLC']);
