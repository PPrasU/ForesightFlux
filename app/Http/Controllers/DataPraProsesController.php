<?php

namespace App\Http\Controllers;

use App\Models\SettingParam;
use Illuminate\Http\Request;
use App\Models\DataPraProses;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class DataPraProsesController extends Controller
{
    public function index(){
        $data = DataPraProses::all();
        $param = SettingParam::first();
        return view('praProses', compact('data', 'param'));
    }

    public function post(Request $request){
        try{
            DataPraProses::create($request->all());


            return redirect()->route('peramalan.hasilPeramalan')->with('Success', 'Pra Proses Data Berhasil Dilakukan');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan pra-proses: ' . $e->getMessage());
        }
    }

    public function hapus(Request $request){
        if ($request->method() !== 'DELETE') {
            return redirect()->route('peramalan.prosesPeramalan')
                ->with('error', 'Akses langsung ke halaman ini tidak diperbolehkan.');
        }
        try {
            if (!$request->isMethod('delete')) {
                return redirect()->route('peramalan.prosesPeramalan')
                    ->with('error', 'Akses langsung ke halaman ini tidak diperbolehkan.');
            }

            if (!DataPraProses::exists()) {
                return back()->withErrors([
                    'file' => '🚨Data Pra Proses Sudah Dihapus.⚠️',
                ]);
            }

            session()->push('notifications', [
                'icon' => 'mdi-delete-forever',
                'bgColor' => 'danger',
                'title' => 'Data Pra Proses Dihapus',
                'text' => 'Data berhasil dihapus.',
            ]);
            DataPraProses::truncate();
            return redirect()->route('peramalan.prosesPeramalan')->with('Success', 'Data Pra Proses Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Huhuhuhu gagal hapus data nih: ' . $e->getMessage());
        }
    }

}
