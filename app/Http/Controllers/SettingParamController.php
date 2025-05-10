<?php

namespace App\Http\Controllers;

use App\Models\SettingParam;
use Illuminate\Http\Request;

class SettingParamController extends Controller
{
    public function index(){
        $data = SettingParam::all();
        return view('admin.settingParams', compact('data'));
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
}
