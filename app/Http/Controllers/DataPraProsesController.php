<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataHasil;
use App\Models\DataSource;
use App\Models\HasilAkurasi;
use App\Models\HasilTesting;
use App\Models\SettingParam;
use Illuminate\Http\Request;
use App\Models\DataPraProses;
use App\Models\HasilTraining;
use Illuminate\Support\Facades\DB;

class DataPraProsesController extends Controller
{
    public function index(){
        $data = DataPraProses::all();
        $param = SettingParam::first();
        $hasilTraining = HasilTraining::exists();
        $totalTraining = $data->where('category', 'Training')->count();
        $totalTesting = $data->where('category', 'Testing')->count();

        return view('praProses', [
            'data' => $data,
            'sudahHasil' => $hasilTraining,
            'param' => $param,
            'totalTraining' => $totalTraining,
            'totalTesting' => $totalTesting,
        ]);
    }

    //ini perhitungan akurasi dengan data testing dengan parameter dari tabel setting_param
    public function post(Request $request){
        try {
            ini_set('max_execution_time', 300);//5 menit
            // Ambil data pra proses urut berdasarkan tanggal
            $dataPraProses = DataPraProses::orderBy('date')->get();

            if ($dataPraProses->isEmpty()) {
                return redirect()->back()->with('error', 'Data API kosong. Tidak bisa melakukan pra-proses.');
            }

            // Ambil source_id dari data pertama
            $sourceId = $dataPraProses->first()->source_id;

            // Ambil data source terkait
            $dataSource = DataSource::find($sourceId);

            if (!$dataSource) {
                return redirect()->back()->with('error', 'Sumber data tidak ditemukan.');
            }

            DB::beginTransaction();

            // Ambil parameter TES dari tabel setting_param
            $param = SettingParam::first();
            $alpha = $param->alpha;
            $beta = $param->beta;
            $gamma = $param->gamma;
            if (!$param || is_null($alpha) || is_null($beta) || is_null($gamma)) {
                throw new \Exception("Parameter TES belum lengkap di tabel setting_param.");
            }

            // Tentukan season length berdasarkan jenis data
            if ($dataSource->jenis_data === 'Harian') {
                $seasonLength = (int) $param->season_length_harian;
            } elseif ($dataSource->jenis_data === 'Mingguan') {
                $seasonLength = (int) $param->season_length_mingguan;
            } else {
                return redirect()->back()->with('error', 'Jenis data tidak dikenali.');
            }

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
            $avgSeason = $data->take($seasonLength)->avg('price');
            for ($i = 0; $i < $seasonLength; $i++) {
                $seasonal[$i] = $data[$i]->price / $avgSeason;
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

                $prevLevel = $level[$i - 1] ?? $price;
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
                HasilTraining::create([
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
                $seasonIndex = ($lastIndexTrain + $i + 1) % $seasonLength;
                $seasonFactor = $seasonal[$seasonIndex];

                // Forecast = (level + step × trend) × seasonal
                $forecast = ($lastLevel + ($i + 1) * $lastTrend) * $seasonFactor;
                $error = $actual - $forecast;
                // $absError = $actual != 0 ? abs($error / $actual) : 0;//jaga-jaga kalo data ada yang 0
                $absError = abs($error / $actual);
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

            // Forecast 30 hari ke depan
            $jumlahHariKeDepan = 30;
            $startDate = Carbon::parse($dataTesting->last()->date ?? $data->last()->date);

            for ($h = 1; $h <= $jumlahHariKeDepan; $h++) {
                $futureDate = $startDate->copy()->addDays($h);
                
                // Ambil seasonal index (berulang tiap seasonLength)
                $seasonIndex = ($lastIndexTrain + $h) % $seasonLength;
                $seasonFactor = $seasonal[$seasonIndex];

                // Forecast = (level + h × trend) × seasonal
                $futureForecast = ($lastLevel + $h * $lastTrend) * $seasonFactor;

                DataHasil::create([
                    'source_id' => $sourceId,
                    'date_forecast' => $futureDate->format('Y-m-d'),
                    'forecast' => $futureForecast,
                    'level' => $lastLevel,
                    'trend' => $lastTrend,
                    'seasonal' => $seasonFactor,
                ]);
            }

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
