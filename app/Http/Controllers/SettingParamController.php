<?php

namespace App\Http\Controllers;

use App\Models\DataHasil;
use App\Models\HasilAkurasi;
use App\Models\HasilTesting;
use App\Models\SettingParam;
use Illuminate\Http\Request;
use App\Models\DataPraProses;

class SettingParamController extends Controller
{
    public function index(){
        $dataParam = SettingParam::all();
        $training = DataHasil::all();
        $testing = HasilTesting::all();
        $akurasi = HasilAkurasi::all();
        $praProses = DataPraProses::all();
        return view('admin.settingParams', compact('dataParam', 'training', 'testing', 'akurasi', 'praProses'));
    }

    public function update(Request $request, $id){
        try {
            $request->validate([
                'alpha' => 'required|numeric',
                'beta' => 'required|numeric',
                'gamma' => 'required|numeric',
                'season_length' => 'required|numeric',
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
        $allData = DataPraProses::orderBy('date')->get();
        $seasonLength = (int) SettingParam::first()->season_length;

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
            'dataParam' => SettingParam::all(),
            'training' => DataHasil::all(),
            'testing' => HasilTesting::all(),
            'akurasi' => HasilAkurasi::all(),
            'grid_results' => $results,
            'best_results' => $bestResults, // notice plural
        ]);
    }

    // berdasarkan kaategori di pra prosesnya
    // public function optimize(Request $request){
    //     $data = DataPraProses::where('category', 'Training')->orderBy('date')->get();
    //     $dataTesting = DataPraProses::where('category', 'Testing')->orderBy('date')->get();
    //     $seasonLength = (int) SettingParam::first()->season_length;

    //     if ($data->count() < 2 * $seasonLength) {
    //         return back()->with('error', 'Data training terlalu sedikit untuk season length tersebut.');
    //     }

    //     $bestResult = null;
    //     $results = [];

    //     for ($alpha = 0.1; $alpha <= 1.0; $alpha += 0.1) {
    //         for ($beta = 0.1; $beta <= 1.0; $beta += 0.1) {
    //             for ($gamma = 0.1; $gamma <= 1.0; $gamma += 0.1) {
    //                 $result = $this->runTES($data, $dataTesting, $alpha, $beta, $gamma, $seasonLength);

    //                 $results[] = [
    //                     'alpha' => round($alpha, 2),
    //                     'beta' => round($beta, 2),
    //                     'gamma' => round($gamma, 2),
    //                     'mape' => $result['mape'],
    //                     'rmse' => $result['rmse'],
    //                     'rrmse' => $result['rrmse'],
    //                 ];

    //                 if (!$bestResult || $result['mape'] < $bestResult['mape']) {
    //                     $bestResult = [
    //                         'alpha' => round($alpha, 2),
    //                         'beta' => round($beta, 2),
    //                         'gamma' => round($gamma, 2),
    //                         'mape' => $result['mape'],
    //                         'rmse' => $result['rmse'],
    //                         'rrmse' => $result['rrmse'],
    //                     ];
    //                 }
    //             }
    //         }
    //     }

    //     return view('hasil', [
    //         'training' => DataHasil::all(),
    //         'testing' => HasilTesting::all(),
    //         'akurasi' => HasilAkurasi::all(),
    //         'grid_results' => $results,
    //         'best_result' => $bestResult,
    //     ]);
    // }

    private function runTES($data, $dataTesting, $alpha, $beta, $gamma, $seasonLength){
        $level = [];
        $trend = [];
        $seasonal = [];

        for ($i = 0; $i < $seasonLength; $i++) {
            $seasonal[] = $data[$i]->price / $data->take($seasonLength)->avg('price');
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
            $seasonIndex = $lastIndex - $seasonLength + ($i % $seasonLength);
            $seasonFactor = $seasonal[$seasonIndex] ?? 1;
            $forecast = ($lastLevel + ($i + 1) * $lastTrend) * $seasonFactor;
            $actual = $row->price;

            $error = $actual - $forecast;
            $abs = abs($error / $actual);
            $sq = pow($error, 2);

            $errorsTesting[] = $error;
            $absErrorsTesting[] = $abs;
            $squaredErrorsTesting[] = $sq;
        }

        return [
            'mape' => array_sum($absErrorsTesting) / count($absErrorsTesting) * 100,
            'rmse' => sqrt(array_sum($squaredErrorsTesting) / count($squaredErrorsTesting)),
            'rrmse' => (sqrt(array_sum($squaredErrorsTesting) / count($squaredErrorsTesting)) / $dataTesting->pluck('price')->avg()) * 100,
        ];
    }
}
