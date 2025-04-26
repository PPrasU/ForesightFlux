<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\DataAPI;
use App\Models\DataSource;
use Carbon\Carbon;

class DataAPIController extends Controller
{
    public function index(){
        $data = DataAPI::all();
        return view('dataAPI', compact('data')); 
    }

    // public function index(){
    //     $data = DataAPI::all();
    //     $dataPraProses = DataPraProses::exists(); // true jika sudah ada data pra-proses
    
    //     return view('dataAPI', [
    //         'data' => $data,
    //         'sudahPraProses' => $dataPraProses,
    //     ]);
    // }    

    public function input(){
        $dataSource = DataSource::all();
        $dataAPI = DataAPI::all();    
        return view('input/dataAPI', compact('dataSource', 'dataAPI'));
    }
    
    public function post(Request $request){
        try{
            $request->validate([
                'crypto_pair' => 'required|string',
                'days' => 'required|string|in:1,7,14,30,90,180,365,max',
                'sumber' => 'required|in:API',
            ]);
    
            $cryptoId = $request->crypto_pair;
            $days = $request->days;
            $sumber = $request->sumber;
    
            $response = Http::get("https://api.coingecko.com/api/v3/coins/{$cryptoId}/ohlc", [
                'vs_currency' => 'usd',
                'days' => $days,
            ]);
    
            if (!$response->ok()) {
                return back()->with('error', 'Gagal mengambil data dari CoinGecko.');
            }
    
            $ohlcData = $response->json();
    
            if (empty($ohlcData)) {
                return back()->with('error', 'Data dari CoinGecko kosong.');
            }
    
            $dataSource = DataSource::create([
                'name' => $cryptoId,
                'jangka_waktu' => $days,
                'sumber' => $sumber,
            ]);

            if (DataAPI::exists()) {
                return back()->withErrors([
                    'file' => '🚨Data historis sudah ada. Silakan hapus terlebih dahulu sebelum menambahkan data baru.⚠️',
                ]);
            }
    
            foreach ($ohlcData as $item) {
                $timestamp = Carbon::createFromTimestampMs($item[0])->format('d-M-Y H:i:s'); // disimpan sebagai string
    
                DataAPI::create([
                    'source_id' => $dataSource->id,
                    'date' => $timestamp,
                    'open' => $item[1],
                    'high' => $item[2],
                    'low' => $item[3],
                    'close' => $item[4],
                ]);
            }
            return redirect()->route('data.dataAPI')->with('Success', 'Data berhasil diambil dan disimpan.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memilih data: ' . $e->getMessage());
        }
    }

    public function praProses(){
        
    }

    public function hapus(){
        DataAPI::truncate();
        DataSource::truncate();

        return redirect()->route('data.dataAPI')->with('Success', 'Data API berhasil dihapus.');
    }

    //untuk api kraken
    // public function post(Request $request)
    // {
    //     // Validasi form input
    //     $request->validate([
    //         'crypto_pair' => 'required',
    //         'date-start' => 'required|date',
    //         'date-end' => 'required|date|after_or_equal:date-start',
    //         'sumber' => 'required',
    //     ]);
        
    //     $displayName = $displayNames[$request->crypto_pair] ?? $request->crypto_pair;
    
    //     // 1. Simpan data ke tabel data_source
    //     $dataSource = DataSource::create([
    //         'name' => $request->crypto_pair,
    //         'display_name' => $displayName,
    //         'periode_awal' => $request['date-start'],
    //         'periode_akhir' => $request['date-end'],
    //         'sumber' => $request->sumber,
    //     ]);
    
    //     // 2. Siapkan parameter untuk Kraken API
    //     $startTime = Carbon::parse($request['date-start'])->timestamp;
    //     $endTime = Carbon::parse($request['date-end'])->timestamp;
    //     $pair = $request->crypto_pair;
    //     $interval = 1440; // daily
    
    //     // 3. Panggil Kraken API
    //     $response = Http::get("https://api.kraken.com/0/public/OHLC", [
    //         'pair' => $pair,
    //         'interval' => $interval,
    //         'since' => $startTime,
    //     ]);
    
    //     $data = $response->json();
    
    //     // Jika gagal mengambil data
    //     if (!isset($data['result'])) {
    //         return back()->with('error', 'Gagal mengambil data dari Kraken.');
    //     }
    
    //     // 4. Ambil nama pair dari hasil response
    //     $pairKey = array_key_first($data['result']);
    
    //     // 5. Iterasi data dan simpan ke tabel data_api
    //     foreach ($data['result'][$pairKey] as $item) {
    //         $timestamp = $item[0];
    //         $date = Carbon::createFromTimestamp($timestamp)->format('Y-m-d');
    
    //         // Pastikan tanggal dalam range yang diminta user
    //         if (Carbon::parse($date)->between($request['date-start'], $request['date-end'])) {
    //             // Menyimpan data ke tabel data_api
    //             DataAPI::create([
    //                 'source_id' => $dataSource->id,
    //                 'date' => $date,
    //                 'open' => $item[1],
    //                 'high' => $item[2],
    //                 'low' => $item[3],
    //                 'close' => $item[4],
    //             ]);
    //         }
    //     }
    
    //     return redirect()->route('data.dataAPI')->with('success', 'Data berhasil diambil dan disimpan.');
    // }
}
