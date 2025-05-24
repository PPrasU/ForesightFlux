<?php

namespace App\Http\Controllers;

use App\Models\HasilAkurasi;
use App\Models\HasilTesting;
use App\Models\HasilTraining;
use App\Models\DataSource;
use Illuminate\Http\Request;
use App\Models\DataPraProses;
use App\Models\SettingParam;
use Illuminate\Support\Collection;

class DataHasilController extends Controller
{
    public function index(){
        $training = HasilTraining::all();
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

            if (!HasilTraining::exists()) {
                return back()->withErrors([
                    'file' => '🚨Data Proses Sudah Dihapus.⚠️',
                ]);
            }

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

            // Hapus semua data hasil
            HasilAkurasi::truncate();
            HasilTesting::truncate();
            HasilTraining::truncate();
            // Jika ingin hapus pra-proses juga, bisa diaktifkan:
            // DataPraProses::truncate();

            // Notifikasi ke session
            session()->push('notifications', [
                'icon' => 'mdi-delete-forever',
                'bgColor' => 'danger',
                'title' => 'Data Peramalan Dihapus',
                'text' => 'Semua hasil peramalan dan akurasi berhasil dihapus.',
            ]);

            if ($sumber === 'Import') {
                return redirect()->route('data.importData')->with('Success', 'Data dari Import berhasil dihapus.');
            } else {
                return redirect()->route('peramalan.index')->with('Success', 'Data dari API berhasil dihapus.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Huhuhuhu gagal hapus data nih: ' . $e->getMessage());
        }
    }
}
