<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataAPI;
use App\Models\DataSource;
use Illuminate\Http\Request;
use App\Models\DataPraProses;
use Illuminate\Support\Facades\Http;

class DataAPIController extends Controller
{

    public function index(){
        $data = DataAPI::all();
        $dataPraProses = DataPraProses::exists(); // true jika sudah ada data pra-proses
    
        return view('dataAPI', [
            'data' => $data,
            'sudahPraProses' => $dataPraProses,
        ]);
    }    

    public function input(){
        $dataSource = DataSource::all();
        $dataAPI = DataAPI::all();

        $cryptoNames = [
            
            'GBPUSD' => 'Binance GBP Stable (GBP) to USD',
            'ZKUSD' => 'ZKsync (ZK) to USD',
            'ZROUSD' => 'LayerZero (ZRO) to USD',
            'ZRXUSD' => '0x Protocol (ZRX) to USD',
        ];

        try {
            $response = Http::get('https://api.kraken.com/0/public/AssetPairs');
            $result = $response->json();

            
            // Filter pair yang cocok untuk pengguna, misal: pair dengan USD atau USDT
            $cryptoPairs = collect($result['result'])->filter(function ($pair, $key) {
                return str_ends_with($key, 'USD') || str_ends_with($key, 'IDR');
            });
            
            if (!isset($result['result'])) {
                return view('input.dataAPI', compact('dataSource', 'dataAPI', 'cryptoPairs', 'cryptoNames'))
                    ->with('error', 'Gagal mengambil data kripto dari Kraken');
            }

            return view('input.dataAPI', compact('dataSource', 'dataAPI', 'cryptoPairs', 'cryptoNames'));
        } catch (\Throwable $e) {
            return view('input.dataAPI', compact('dataSource', 'dataAPI'))
                ->with('error', 'Terjadi kesalahan saat mengambil data kripto: ' . $e->getMessage());
        }
    }

    
    //untuk api kraken
    public function post(Request $request){
        try {
            
            // Validasi form input
            $request->validate([
                'crypto_pair' => 'required',
                'date-start' => 'required|date',
                'date-end' => 'required|date|after_or_equal:date-start',
                'sumber' => 'required',
            ]);
            
            $cryptoNames = [
            
                'GBPUSD' => 'Binance GBP Stable (GBP) to USD',
                'ZKUSD' => 'ZKsync (ZK) to USD',
                'ZROUSD' => 'LayerZero (ZRO) to USD',
                'ZRXUSD' => '0x Protocol (ZRX) to USD',
            ];
            
            $displayName = $displayNames[$request->crypto_pair] ?? $request->crypto_pair;
            $fullName = $displayNames[$request->crypto_pair] ?? $request->crypto_pair;
            $displayName = explode('(', $fullName)[0];
            $displayName = trim($displayName);

            // Simpan ke data_source
            $dataSource = DataSource::create([
                'name' => $request->crypto_pair,
                'display_name' => $displayName,
                'periode_awal' => $request['date-start'],
                'periode_akhir' => $request['date-end'],
                'sumber' => $request->sumber,
            ]);

            // Parameter Kraken API
            $startTime = Carbon::parse($request['date-start'])->timestamp;
            $endTime = Carbon::parse($request['date-end'])->timestamp;
            $pair = $request->crypto_pair;
            $interval = 1440; // daily

            $response = Http::get("https://api.kraken.com/0/public/OHLC", [
                'pair' => $pair,
                'interval' => $interval,
                'since' => $startTime,
            ]);

            $data = $response->json();

            if (!isset($data['result'])) {
                return redirect()->back()->with('error', 'Gagal mengambil data dari Kraken.');
            }

            $pairKey = array_key_first($data['result']);

            foreach ($data['result'][$pairKey] as $item) {
                $timestamp = $item[0];
                $date = Carbon::createFromTimestamp($timestamp)->format('Y-m-d'); // simpan dalam format standar

                if (Carbon::parse($date)->between($request['date-start'], $request['date-end'])) {
                    DataAPI::create([
                        'source_id' => $dataSource->id,
                        'date' => $date,
                        'open' => $item[1],
                        'high' => $item[2],
                        'low' => $item[3],
                        'close' => $item[4],
                    ]);
                }
            }

            return redirect()->route('data.dataAPI')->with('Success', 'Data berhasil diambil dan disimpan.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function praProses(){
        
    }

    public function hapus(){
        DataAPI::truncate();

        return redirect()->route('data.dataAPI')->with('Success', 'Data API berhasil dihapus.');
    }

    // API CoinGecko
    // Pake source_id, date, open, high, low, close, timestamp
    // public function post(Request $request){
    //     try{
    //         $request->validate([
    //             'crypto_pair' => 'required|string',
    //             'days' => 'required|string|in:1,7,14,30,90,180,365,max',
    //             'sumber' => 'required|in:API',
    //         ]);
    
    //         $cryptoId = $request->crypto_pair;
    //         $days = $request->days;
    //         $sumber = $request->sumber;
    
    //         $response = Http::get("https://api.coingecko.com/api/v3/coins/{$cryptoId}/ohlc", [
    //             'vs_currency' => 'usd',
    //             'days' => $days,
    //         ]);
    
    //         if (!$response->ok()) {
    //             return back()->with('error', 'Gagal mengambil data dari CoinGecko.');
    //         }
    
    //         $ohlcData = $response->json();
    
    //         if (empty($ohlcData)) {
    //             return back()->with('error', 'Data dari CoinGecko kosong.');
    //         }
    
    //         $dataSource = DataSource::create([
    //             'name' => $cryptoId,
    //             'jangka_waktu' => $days,
    //             'sumber' => $sumber,
    //         ]);

    //         if (DataAPI::exists()) {
    //             return back()->withErrors([
    //                 'file' => '🚨Data historis sudah ada. Silakan hapus terlebih dahulu sebelum menambahkan data baru.⚠️',
    //             ]);
    //         }
    
    //         foreach ($ohlcData as $item) {
    //             $timestamp = Carbon::createFromTimestampMs($item[0])->format('d-M-Y H:i:s'); // disimpan sebagai string
    
    //             DataAPI::create([
    //                 'source_id' => $dataSource->id,
    //                 'date' => $timestamp,
    //                 'open' => $item[1],
    //                 'high' => $item[2],
    //                 'low' => $item[3],
    //                 'close' => $item[4],
    //             ]);
    //         }
    //         return redirect()->route('data.dataAPI')->with('Success', 'Data berhasil diambil dan disimpan.');

    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Gagal memilih data: ' . $e->getMessage());
    //     }
    // }
}
