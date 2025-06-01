<?php

use App\Http\Controllers\KrakenController;

Route::post('/kraken/fetch', [KrakenController::class, 'fetchOHLC']);
