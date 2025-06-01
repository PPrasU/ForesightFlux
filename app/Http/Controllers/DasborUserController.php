<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DasborUserController extends Controller
{
    public function index(){
        $lastForecasts = session('last_forecasts', collect());
        $historicalData = session('historical_backup', collect());
        $historicalType = session('historical_type');

        // Ambil dua data terakhir (pastikan urutan naik: terlama ke terbaru)
        $latest = $historicalData->last();
        $previous = $historicalData->count() > 1 ? $historicalData->get($historicalData->count() - 2) : null;

        $prices = [];

        if ($latest && $previous) {
            $fieldMap = $historicalType === 'Import'
                ? ['close' => 'price', 'open' => 'open', 'high' => 'high', 'low' => 'low']
                : ['close' => 'close', 'open' => 'open', 'high' => 'high', 'low' => 'low'];

            foreach ($fieldMap as $key => $field) {
                // Konversi string ke float
                $current = floatval(str_replace(',', '', $latest->{$field}));
                $past = floatval(str_replace(',', '', $previous->{$field}));

                $change = ($past != 0) ? (($current - $past) / $past) * 100 : 0;

                $prices[$key] = [
                    'value' => $current,
                    'change' => round($change, 2),
                    'status' => $change > 0 ? 'success' : ($change < 0 ? 'danger' : 'info')
                ];
            }
        }


        return view('dashboard', compact('lastForecasts', 'historicalData', 'historicalType', 'prices'));
    }

}
