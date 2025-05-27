<?php

namespace App\Http\Controllers;

use App\Models\DataSource;
use App\Models\HasilAkurasi;
use App\Models\HasilTesting;
use App\Models\SettingParam;
use Illuminate\Http\Request;
use App\Models\DataPraProses;
use App\Models\HasilTraining;
use Illuminate\Support\Facades\Storage;

class SettingParamController extends Controller
{
    public function index(){
        $setting = SettingParam::first();
        $dataParam = SettingParam::all();
        $training = HasilTraining::all();
        $testing = HasilTesting::all();
        $akurasi = HasilAkurasi::all();
        $dataPraproses = DataPraProses::all();
        $praProses = DataPraProses::with('source')->first();
        $jenisData = $praProses?->source?->jenis_data ?? 'Tidak Diketahui';

        $jenisData = 'AAAAaaa';
        $seasonLength = 9999999;

        $totalCounts = [
            60 => ['training' => 0, 'testing' => 0],
            70 => ['training' => 0, 'testing' => 0],
            80 => ['training' => 0, 'testing' => 0],
            90 => ['training' => 0, 'testing' => 0],
        ];

        return view('admin.settingParams', compact(
            'dataParam',
            'setting',
            'training',
            'testing',
            'akurasi',
            'dataPraproses',
            'praProses',
            'jenisData',
            'seasonLength',
            'totalCounts',
        ));
    }

    public function update(Request $request, $id){
        try {
            $request->validate([
                'alpha' => 'required|numeric',
                'beta' => 'required|numeric',
                'gamma' => 'required|numeric',
                'training_percentage' => 'required|numeric|min:0|max:100',
                'testing_percentage' => 'required|numeric|min:0|max:100',
            ]);
        
            // Validasi total harus 100
            $total = $request->training_percentage + $request->testing_percentage;
            if ($total !== 100) {
                return redirect()->back()->withInput()->with('error', 'Jumlah training dan testing harus 100%.');
            }
        
            $setting = SettingParam::findOrFail($id);
            $setting->update($request->all());
        
            return redirect()->route('admin.settingParams')->with('Success', 'Berhasil memperbarui parameter.');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
    }

    public function optimize(Request $request){
        ini_set('max_execution_time', 300); // 5 menit
        // Ambil data pra proses urut berdasarkan tanggal
        $allData = DataPraProses::orderBy('date')->get();

        if ($allData->isEmpty()) {
            return redirect()->back()->with('error', 'Data API kosong. Tidak bisa melakukan pra-proses.');
        }

        // Ambil source_id dari data pertama
        $sourceId = $allData->first()->source_id;

        // Ambil data source terkait
        $dataSource = DataSource::find($sourceId);

        if (!$dataSource) {
            return redirect()->back()->with('error', 'Sumber data tidak ditemukan.');
        }

        $param = SettingParam::first();

        // Tentukan season length berdasarkan jenis data
        if ($dataSource->jenis_data === 'Harian') {
            $seasonLength = (int) $param->season_length_harian;//default 30
        } elseif ($dataSource->jenis_data === 'Mingguan') {
            $seasonLength = (int) $param->season_length_mingguan;//default 4
        } else {
            return redirect()->back()->with('error', 'Jenis data tidak dikenali.');
        }

        $praProses = DataPraProses::with('source')->first();
        $jenisData = $praProses?->source?->jenis_data ?? 'Tidak Diketahui';

        $trainingPercents = [60, 70, 80, 90];
        $results = [];
        $bestResults = [];

        // Inisialisasi bestResults per training percent
        foreach ($trainingPercents as $tp) {
            $bestResults[$tp] = null;
        }

        for ($alpha = 0.1; $alpha <= 1.0; $alpha += 0.1) {
            for ($beta = 0.1; $beta <= 1.0; $beta += 0.1) {
                for ($gamma = 0.1; $gamma <= 1.0; $gamma += 0.1) {
                    foreach ($trainingPercents as $trainingPercent) {
                        $totalData = count($allData);
                        $trainingCount = (int) round($totalData * ($trainingPercent / 100));
                        $testingCount = $totalData - $trainingCount;

                        // Simpan total count per persentase
                        $totalCounts[$trainingPercent] = [
                            'training' => $trainingCount,
                            'testing' => $testingCount
                        ];

                        $dataTraining = $allData->slice(0, $trainingCount)->values();
                        $dataTesting = $allData->slice($trainingCount)->values();

                        if ($dataTraining->count() < 2 * $seasonLength) {
                            continue;
                        }

                        $result = $this->runTES($dataTraining, $dataTesting, $alpha, $beta, $gamma, $seasonLength);

                        $currentResult = [
                            'alpha' => round($alpha, 2),
                            'beta' => round($beta, 2),
                            'gamma' => round($gamma, 2),
                            'training' => $trainingPercent,
                            'testing' => 100 - $trainingPercent,
                            'mape' => $result['mape'],
                            'rmse' => $result['rmse'],
                            'rrmse' => $result['rrmse'],
                        ];

                        $results[] = $currentResult;

                        if (!$bestResults[$trainingPercent] || $result['mape'] < $bestResults[$trainingPercent]['mape']) {
                            $bestResults[$trainingPercent] = $currentResult;
                        }
                    }
                }
            }
        }

        return view('admin.settingParams', [
            'setting' => SettingParam::first(),
            'dataParam' => SettingParam::all(),
            'training' => HasilTraining::all(),
            'testing' => HasilTesting::all(),
            'akurasi' => HasilAkurasi::all(),
            'dataPraproses' => DataPraProses::all(),
            'praProses' => $praProses,
            'jenisData' => $jenisData,
            'seasonLength' => $seasonLength,
            'grid_results' => $results,
            'best_results' => $bestResults,
            'seasonLength' => $seasonLength,
            'totalCounts' => $totalCounts,
        ]);
    }

    private function runTES($dataTrain, $dataTest, $alpha, $beta, $gamma, $seasonLength){
        $n = count($dataTrain);

        if ($n < 2 * $seasonLength) {
            throw new \Exception("Jumlah data training minimal harus >= 2 × season length");
        }

        $level = [];
        $trend = [];
        $seasonal = [];

        $forecast = [];
        $errors = [];
        $abs_errors = [];
        $squared_errors = [];

        // Inisialisasi
        $avgSeason = $dataTrain->take($seasonLength)->avg('price');

        for ($i = 0; $i < $seasonLength; $i++) {
            $seasonal[$i] = $dataTrain[$i]->price / $avgSeason;
        }

        $level[$seasonLength - 1] = $avgSeason;

        $sum = 0;
        for ($i = 0; $i < $seasonLength; $i++) {
            $sum += ($dataTrain[$i + $seasonLength]->price - $dataTrain[$i]->price) / $seasonal[$i];
        }
        $trend[$seasonLength - 1] = $sum / ($seasonLength * $seasonLength);

        for ($i = $seasonLength; $i < $n; $i++) {
            $price = $dataTrain[$i]->price;
            $prevLevel = $level[$i - 1] ?? $price;
            $prevTrend = $trend[$i - 1] ?? 0;
            $prevSeasonal = $seasonal[$i - $seasonLength] ?? 1;

            $level[$i] = $alpha * ($price / $prevSeasonal) + (1 - $alpha) * ($prevLevel + $prevTrend);
            $trend[$i] = $beta * ($level[$i] - $prevLevel) + (1 - $beta) * $prevTrend;
            $seasonal[$i] = $gamma * ($price / $level[$i]) + (1 - $gamma) * $prevSeasonal;
        }

        // Forecast Testing
        $forecastTesting = [];
        $errorsTesting = [];
        $absErrorsTesting = [];
        $squaredErrorsTesting = [];

        $lastIndexTrain = array_key_last($level);
        $lastLevel = $level[$lastIndexTrain];
        $lastTrend = $trend[$lastIndexTrain];

        $startIndex = $lastIndexTrain + 1;

        foreach ($dataTest as $i => $testData) {
            $t = $startIndex + $i;
            $actual = $testData->price;

            $prevLevel = $level[$t - 1] ?? $lastLevel;
            $prevTrend = $trend[$t - 1] ?? $lastTrend;
            $prevSeasonal = $seasonal[$t - $seasonLength] ?? 1;

            $forecastVal = ($prevLevel + $prevTrend) * $prevSeasonal;

            $level[$t] = $alpha * ($actual / $prevSeasonal) + (1 - $alpha) * ($prevLevel + $prevTrend);
            $trend[$t] = $beta * ($level[$t] - $prevLevel) + (1 - $beta) * $prevTrend;
            $seasonal[$t] = $gamma * ($actual / $level[$t]) + (1 - $gamma) * $prevSeasonal;

            $error = $actual - $forecastVal;
            $absError = abs($error / $actual);
            $errorSquare = pow($error, 2);

            $forecastTesting[] = $forecastVal;
            $errorsTesting[] = $error;
            $absErrorsTesting[] = $absError;
            $squaredErrorsTesting[] = $errorSquare;
        }

        $mape = count($absErrorsTesting) ? array_sum($absErrorsTesting) / count($absErrorsTesting) * 100 : null;
        $rmse = count($squaredErrorsTesting) ? sqrt(array_sum($squaredErrorsTesting) / count($squaredErrorsTesting)) : null;
        $avgActual = $dataTest->pluck('price')->avg();
        $rrmse = $avgActual ? ($rmse / $avgActual) * 100 : null;

        return [
            'mape' => $mape,
            'rmse' => $rmse,
            'rrmse' => $rrmse,
        ];
    }


}
