<?php

namespace App\Http\Controllers;

use App\Models\DataHasil;
use App\Models\DataSource;
use App\Models\HasilAkurasi;
use App\Models\HasilTesting;
use App\Models\SettingParam;
use Illuminate\Http\Request;
use App\Models\DataPraProses;
use App\Models\HasilTraining;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DataHasilController extends Controller
{
    public function index(Request $request){
        $training = HasilTraining::all();
        $testing = HasilTesting::orderBy('date', 'desc')->first();
        $akurasi = HasilAkurasi::all();

        $range = $request->input('range', 30);

        $hasil = DataHasil::orderBy('date_forecast', 'asc')
            ->take($range)
            ->get();

        // Tambahan untuk grafik testing (actual vs forecast)
        $range2 = $request->input('range2', 30); // default 30
        $testingChart = HasilTesting::orderBy('date', 'desc')
            ->take($range2)
            ->get()
            ->sortBy('date')
            ->values();

        return view('hasil', compact(
            'training',
            'testing',
            'akurasi',
            'hasil',
            'range',
            'range2',
            'testingChart', // variabel baru untuk grafik
        ));
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
            DB::beginTransaction();
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
            DataHasil::truncate();
            // Jika ingin hapus pra-proses juga, bisa diaktifkan:
            // DataPraProses::truncate();
            DB::commit();

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
                return redirect()->route('data.dataAPI')->with('Success', 'Data dari API berhasil dihapus.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Huhuhuhu gagal hapus data nih: ' . $e->getMessage());
        }
    }
}
