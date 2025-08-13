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

        $jenisData = '-';
        $seasonLength = 0;
        $windowSize = 0;
        $forecastHorizon = 0;
        $slidingStep = 0;

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
            'windowSize',
            'forecastHorizon',
            'slidingStep',
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
        
            return redirect()->route('settingParams')->with('Success', 'Berhasil memperbarui parameter.');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
    }

}
