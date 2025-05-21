<?php

namespace App\Http\Controllers;

use App\Models\HasilAkurasi;
use App\Models\HasilTesting;
use App\Models\DataHasil;
use App\Models\DataSource;
use Illuminate\Http\Request;
use App\Models\DataPraProses;
use App\Models\SettingParam;
use Illuminate\Support\Collection;

class DataHasilController extends Controller
{
    public function index(){
        $training = DataHasil::all();
        $testing = HasilTesting::all();
        $akurasi = HasilAkurasi::all();
        return view('hasil', compact('training', 'testing', 'akurasi'));
    }

    public function hapus(Request $request){
        try {
            if (!$request->isMethod('delete')) {
                return redirect()->route('peramalan.index')
                    ->with('error', 'Akses langsung ke halaman ini tidak diperbolehkan.');
            }

            if (!DataHasil::exists()) {
                return back()->withErrors([
                    'file' => '🚨Data Proses Sudah Dihapus.⚠️',
                ]);
            }

            // Hapus semua data hasil
            HasilAkurasi::truncate();
            HasilTesting::truncate();
            DataHasil::truncate();
            // Jika ingin hapus pra-proses juga, bisa diaktifkan:
            // DataPraProses::truncate();

            // Notifikasi ke session
            session()->push('notifications', [
                'icon' => 'mdi-delete-forever',
                'bgColor' => 'danger',
                'title' => 'Data Peramalan Dihapus',
                'text' => 'Semua hasil peramalan dan akurasi berhasil dihapus.',
            ]);

            return redirect()->route('peramalan.index')->with('Success', 'Semua data hasil peramalan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Huhuhuhu gagal hapus data nih: ' . $e->getMessage());
        }
    }
}
