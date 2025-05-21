<?php

namespace App\Http\Controllers;

use App\Models\DataHasil;
use App\Models\DataSource;
use App\Models\HasilAkurasi;
use App\Models\HasilTesting;
use App\Models\SettingParam;
use Illuminate\Http\Request;
use App\Models\DataPraProses;
use Illuminate\Support\Facades\DB;

class DataPraProsesController extends Controller
{
    public function index(){
        $data = DataPraProses::all();
        $param = SettingParam::first();
        $dataHasil = DataHasil::exists();
        return view('praProses', [
            'data' => $data,
            'sudahHasil' => $dataHasil,
            'param' => $param
        ]);
    }

    // proses peramalan 
    // public function post(Request $request){
    //     try {
    //         // ngambil data source
    //         $dataPraProses = DataPraProses::orderBy('date')->get();
    //         if ($dataPraProses->isEmpty()) {
    //             return redirect()->back()->with('error', 'Data API kosong. Tidak bisa melakukan pra-proses.');
    //         }
    //         $sourceId = $dataPraProses->first()->source_id;

    //         // memulai transaksi DB, semua operasi insert/update/delete ditahan sementara, belum disimpan secara permanen ke database disimpan pas commit.
    //         DB::beginTransaction();

    //         // Ambil parameter TES dari tabel setting_param (karena satu baris)
    //         $param = SettingParam::first();
    //         $alpha = $param->alpha;
    //         $beta = $param->beta;
    //         $gamma = $param->gamma;
    //         $seasonLength = (int)$param->season_length;

    //         // Ambil data training dari data_pra-proses kategori Training
    //         // $data = DataPraProses::where('category', 'Training')
    //         //     ->orderBy('date')
    //         //     ->get();

    //         //semua data
    //         $data = DataPraProses::orderBy('date')->get();

    //         // cek data harus 2x lebih dari season length, kalo kurang bakal error
    //         $n = count($data);
    //         if ($n < 2 * $seasonLength) {
    //             throw new \Exception("Jumlah data training minimal harus >= 2 × season length");
    //         }

    //         // Array, untuk menyimpan nilai perhitungan komponen TES selama proses peramalan
    //         $level = [];
    //         $trend = [];
    //         $seasonal = [];
    //         $forecast = [];
    //         $errors = [];
    //         $abs_errors = [];
    //         $squared_errors = [];

    //         // Inisialisasi Level (rata-rata awal season pertama)
    //         for ($i = 0; $i < $seasonLength; $i++) {
    //             $seasonal[] = $data[$i]->price / ($data->take($seasonLength)->avg('price'));
    //         }

    //         $level[$seasonLength - 1] = $data->take($seasonLength)->avg('price');

    //         // Inisialisasi trend awal (rata-rata perubahan per season)
    //         $sum = 0;
    //         for ($i = 0; $i < $seasonLength; $i++) {
    //             $sum += ($data[$i + $seasonLength]->price - $data[$i]->price) / $seasonal[$i];
    //         }
    //         $trend[$seasonLength - 1] = $sum / ($seasonLength * $seasonLength);

    //         // Perhitungan TES Multiplicative
    //         for ($i = $seasonLength; $i < $n; $i++) {
    //             $index = $i;
    //             $price = $data[$i]->price;

    //             $prevLevel = $level[$i - 1] ?? $level[$i - 1] ?? $price;
    //             $prevTrend = $trend[$i - 1] ?? 0;
    //             $prevSeasonal = $seasonal[$i - $seasonLength] ?? 1;

    //             $level[$i] = $alpha * ($price / $prevSeasonal) + (1 - $alpha) * ($prevLevel + $prevTrend);
    //             $trend[$i] = $beta * ($level[$i] - $prevLevel) + (1 - $beta) * $prevTrend;
    //             $seasonal[$i] = $gamma * ($price / $level[$i]) + (1 - $gamma) * $prevSeasonal;

    //             $forecast[$i] = ($level[$i - 1] + $trend[$i - 1]) * $prevSeasonal;
    //             $errors[$i] = $price - $forecast[$i];
    //             $abs_errors[$i] = abs($errors[$i] / $price);
    //             $squared_errors[$i] = pow($errors[$i], 2);

    //             // Simpan ke tabel data_hasil
    //             DataHasil::create([
    //                 'source_id' => $sourceId,
    //                 'date' => $data[$i]->date,
    //                 'price' => $price,
    //                 'level' => $level[$i],
    //                 'trend' => $trend[$i],
    //                 'seasonal' => $seasonal[$i],
    //                 'forecast' => $forecast[$i],
    //                 'error' => $errors[$i],
    //                 'abs_error' => $abs_errors[$i],
    //                 'error_square' => $squared_errors[$i],
    //             ]);
    //         }

    //         // Hitung akurasi
    //         $validErrors = array_filter($abs_errors);
    //         $mape = array_sum($validErrors) / count($validErrors) * 100;
    //         $rmse = sqrt(array_sum($squared_errors) / count($squared_errors));
    //         $avg_actual = $data->slice($seasonLength)->pluck('price')->avg();
    //         $rrmse = ($rmse / $avg_actual) * 100;

    //         // Simpan hasil akurasi
    //         HasilAkurasi::create([
    //             'mape' => $mape,
    //             'rmse' => $rmse,
    //             'avg_actual' => $avg_actual,
    //             'relative_rmse' => $rrmse,
    //         ]);

    //         DB::commit();
    //         return redirect()->route('peramalan.hasil')->with('Success', 'Proses Peramalan Berhasil!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->with('error', 'Gagal melakukan proses peramalan: ' . $e->getMessage());
    //     }
    // }

    //ini perhitungan akurasi dengan data testing dengan parameter dari tabel setting_param
    public function post(Request $request){
        try {
            // ngambil data source
            $dataPraProses = DataPraProses::orderBy('date')->get();
            if ($dataPraProses->isEmpty()) {
                return redirect()->back()->with('error', 'Data API kosong. Tidak bisa melakukan pra-proses.');
            }
            $sourceId = $dataPraProses->first()->source_id;

            // memulai transaksi DB, semua operasi insert/update/delete ditahan sementara, belum disimpan secara permanen ke database disimpan pas commit.
            DB::beginTransaction();

            // Ambil parameter TES dari tabel setting_param (karena satu baris)
            $param = SettingParam::first();
            $alpha = $param->alpha;
            $beta = $param->beta;
            $gamma = $param->gamma;
            $seasonLength = (int)$param->season_length;

            // Ambil data training dari data_pra-proses
            $data = DataPraProses::where('category', 'Training')
                ->orderBy('date')
                ->get();


            // cek data harus 2x lebih dari season length, kalo kurang bakal error
            $n = count($data);
            if ($n < 2 * $seasonLength) {
                throw new \Exception("Jumlah data training minimal harus >= 2 × season length");
            }

            // Array, untuk menyimpan nilai perhitungan komponen TES selama proses peramalan
            $level = [];
            $trend = [];
            $seasonal = [];
            $forecast = [];
            $errors = [];
            $abs_errors = [];
            $squared_errors = [];

            // Inisialisasi Level (rata-rata awal season pertama)
            for ($i = 0; $i < $seasonLength; $i++) {
                $seasonal[] = $data[$i]->price / ($data->take($seasonLength)->avg('price'));
            }

            $level[$seasonLength - 1] = $data->take($seasonLength)->avg('price');

            // Inisialisasi trend awal (rata-rata perubahan per season)
            $sum = 0;
            for ($i = 0; $i < $seasonLength; $i++) {
                $sum += ($data[$i + $seasonLength]->price - $data[$i]->price) / $seasonal[$i];
            }
            $trend[$seasonLength - 1] = $sum / ($seasonLength * $seasonLength);

            // Perhitungan TES Multiplicative
            for ($i = $seasonLength; $i < $n; $i++) {
                $index = $i;
                $price = $data[$i]->price;

                $prevLevel = $level[$i - 1] ?? $level[$i - 1] ?? $price;
                $prevTrend = $trend[$i - 1] ?? 0;
                $prevSeasonal = $seasonal[$i - $seasonLength] ?? 1;

                $level[$i] = $alpha * ($price / $prevSeasonal) + (1 - $alpha) * ($prevLevel + $prevTrend);
                $trend[$i] = $beta * ($level[$i] - $prevLevel) + (1 - $beta) * $prevTrend;
                $seasonal[$i] = $gamma * ($price / $level[$i]) + (1 - $gamma) * $prevSeasonal;

                $forecast[$i] = ($level[$i - 1] + $trend[$i - 1]) * $prevSeasonal;
                $errors[$i] = $price - $forecast[$i];
                $abs_errors[$i] = abs($errors[$i] / $price);
                $squared_errors[$i] = pow($errors[$i], 2);

                // Simpan ke tabel data_hasil
                DataHasil::create([
                    'source_id' => $sourceId,
                    'date' => $data[$i]->date,
                    'price' => $price,
                    'level' => $level[$i],
                    'trend' => $trend[$i],
                    'seasonal' => $seasonal[$i],
                    'forecast' => $forecast[$i],
                    'error' => $errors[$i],
                    'abs_error' => $abs_errors[$i],
                    'error_square' => $squared_errors[$i],
                ]);
            }

            // Ambil data testing
            $dataTesting = DataPraProses::where('category', 'Testing')
                ->orderBy('date')
                ->get();

            $forecastTesting = [];
            $errorsTesting = [];
            $absErrorsTesting = [];
            $squaredErrorsTesting = [];

            $lastIndexTrain = array_key_last($level);
            $lastLevel = $level[$lastIndexTrain];
            $lastTrend = $trend[$lastIndexTrain];

            // Forecast untuk data testing
            for ($i = 0; $i < count($dataTesting); $i++) {
                $date = $dataTesting[$i]->date;
                $actual = $dataTesting[$i]->price;
                $seasonIndex = ($lastIndexTrain + $i + 1 - $seasonLength) % $seasonLength + $seasonLength;
                $seasonFactor = $seasonal[$seasonIndex] ?? 1;

                // Forecast = (level + step × trend) × seasonal
                $forecast = ($lastLevel + ($i + 1) * $lastTrend) * $seasonFactor;
                $error = $actual - $forecast;
                $absError = $actual != 0 ? abs($error / $actual) : 0;
                $errorSquare = pow($error, 2);

                // Simpan ke hasil_testing
                HasilTesting::create([
                    'source_id' => $sourceId,
                    'date' => $date,
                    'actual' => $actual,
                    'forecast' => $forecast,
                    'error' => $error,
                    'abs_error' => $absError,
                    'error_square' => $errorSquare,
                ]);

                // Simpan untuk akurasi
                $forecastTesting[] = $forecast;
                $errorsTesting[] = $error;
                $absErrorsTesting[] = $absError;
                $squaredErrorsTesting[] = $errorSquare;
            }

            // Perhitungan Akurasi berdasarkan data Testing
            $mape = array_sum($absErrorsTesting) / count($absErrorsTesting) * 100;
            $rmse = sqrt(array_sum($squaredErrorsTesting) / count($squaredErrorsTesting));
            $avgActual = $dataTesting->pluck('price')->avg();
            $rrmse = ($rmse / $avgActual) * 100;

            // Simpan akurasi ke tabel hasil_akurasi
            HasilAkurasi::create([
                'mape' => $mape,
                'rmse' => $rmse,
                'avg_actual' => $avgActual,
                'relative_rmse' => $rrmse,
            ]);


            DB::commit();
            return redirect()->route('peramalan.hasil')->with('Success', 'Proses Peramalan Berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal melakukan proses peramalan: ' . $e->getMessage());
        }
    }

    public function hapus(Request $request){
        if ($request->method() !== 'DELETE') {
            return redirect()->route('peramalan.index')
                ->with('error', 'Akses langsung ke halaman ini tidak diperbolehkan.');
        }

        try {
            if (!DataPraProses::exists()) {
                return back()->withErrors([
                    'file' => '🚨Data Pra Proses Sudah Dihapus.⚠️',
                ]);
            }

            // Ambil satu data_pra_proses untuk cek source-nya
            $dataPraProses = DataPraProses::first();

            if ($dataPraProses) {
                $source = DataSource::find($dataPraProses->source_id);
                $sumber = $source?->sumber; // nilainya: 'Import' atau 'API'
            } else {
                $sumber = null;
            }

            // Hapus semua data pra proses
            DataPraProses::truncate();

            // Tambahkan notifikasi
            session()->push('notifications', [
                'icon' => 'mdi-delete-forever',
                'bgColor' => 'danger',
                'title' => 'Data Pra Proses Dihapus',
                'text' => 'Data berhasil dihapus.',
            ]);

            // Redirect sesuai sumber data
            if ($sumber === 'Import') {
                return redirect()->route('data.importData')->with('Success', 'Data dari Import berhasil dihapus.');
            } else {
                return redirect()->route('peramalan.index')->with('Success', 'Data dari API berhasil dihapus.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }


}
