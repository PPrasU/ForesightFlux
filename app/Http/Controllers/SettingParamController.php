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

        // Simpan hasil ke CSV
        $csvFileName = 'grid_search_results.csv';
        $csvData = "alpha,beta,gamma,training,testing,mape,rmse,rrmse\n";

        foreach ($results as $res) {
            $csvData .= implode(",", [
                number_format($res['alpha'], 2, '.', ''),
                number_format($res['beta'], 2, '.', ''),
                number_format($res['gamma'], 2, '.', ''),
                $res['training'],
                $res['testing'],
                number_format($res['mape'], 4, '.', ''),
                number_format($res['rmse'], 4, '.', ''),
                number_format($res['rrmse'], 4, '.', ''),
            ]) . "\n";
        }

        Storage::disk('local')->put($csvFileName, $csvData);

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

    private function runTES($data, $dataTesting, $alpha, $beta, $gamma, $seasonLength){
        $level = [];
        $trend = [];
        $seasonal = [];

        $seasonAvg = $data->take($seasonLength)->avg('price');
        for ($i = 0; $i < $seasonLength; $i++) {
            $seasonal[$i] = $data[$i]->price / $seasonAvg;
        }

        $level[$seasonLength - 1] = $data->take($seasonLength)->avg('price');

        $sum = 0;
        for ($i = 0; $i < $seasonLength; $i++) {
            $sum += ($data[$i + $seasonLength]->price - $data[$i]->price) / $seasonal[$i];
        }

        $trend[$seasonLength - 1] = $sum / ($seasonLength * $seasonLength);

        $n = count($data);
        for ($i = $seasonLength; $i < $n; $i++) {
            $prevLevel = $level[$i - 1];
            $prevTrend = $trend[$i - 1];
            $prevSeasonal = $seasonal[$i - $seasonLength];

            $level[$i] = $alpha * ($data[$i]->price / $prevSeasonal) + (1 - $alpha) * ($prevLevel + $prevTrend);
            $trend[$i] = $beta * ($level[$i] - $prevLevel) + (1 - $beta) * $prevTrend;
            $seasonal[$i] = $gamma * ($data[$i]->price / $level[$i]) + (1 - $gamma) * $prevSeasonal;
        }

        $errorsTesting = [];
        $absErrorsTesting = [];
        $squaredErrorsTesting = [];

        $lastIndex = array_key_last($level);
        $lastLevel = $level[$lastIndex];
        $lastTrend = $trend[$lastIndex];

        foreach ($dataTesting as $i => $row) {
            // Hitung seasonal index untuk testing
            $seasonIndex = ($lastIndex + $i + 1) % $seasonLength;
            $seasonFactor = $seasonal[$seasonIndex] ?? 1;

            // Forecast nilai testing
            $forecast = ($lastLevel + ($i + 1) * $lastTrend) * $seasonFactor;
            $actual = $row->price;
            $error = $actual - $forecast;
            $absError = $actual != 0 ? abs($error / $actual) : 0;
            $errorSquare = pow($error, 2);

            $errorsTesting[] = $error;
            $absErrorsTesting[] = $absError;
            $squaredErrorsTesting[] = $errorSquare;
        }

        $mape = count($absErrorsTesting) > 0 ? array_sum($absErrorsTesting) / count($absErrorsTesting) * 100 : 0;
        $rmse = count($squaredErrorsTesting) > 0 ? sqrt(array_sum($squaredErrorsTesting) / count($squaredErrorsTesting)) : 0;
        $avgActual = $dataTesting->pluck('price')->avg() ?: 1; // hindari pembagian 0
        $rrmse = ($rmse / $avgActual) * 100;

        return [
            'mape' => $mape,
            'rmse' => $rmse,
            'rrmse' => $rrmse,
        ];
    }

}
