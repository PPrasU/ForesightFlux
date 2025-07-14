<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataHasil;
use App\Models\DataImport;
use App\Models\DataSource;
use App\Models\SettingParam;
use Illuminate\Http\Request;
use App\Models\DataPraProses;
use Illuminate\Support\Facades\DB;

class DataImporTController extends Controller
{
    public function index(){
        $data = DataImport::all();
        $dataPraProses = DataPraProses::exists();
        return view('dataImport', [
            'data' => $data,
            'sudahPraProses' => $dataPraProses,
        ]);
    }

    public function input(){
        try{
            $dataSource = DataSource::all();
            $dataImport = DataImport::all();

            if (DataImport::exists()) {
                return back()->withErrors([
                    'file' => '🚨Data Import sudah ada. Silakan hapus terlebih dahulu sebelum menambahkan data baru.⚠️',
                ]);
            }

            return view('input/dataImport', compact('dataSource', 'dataImport'));
        }catch(\Throwable $e){
            return view('input/dataImport', compact('dataSource', 'dataImport'))
            ->with('error', 'Terjadi kesalahan saat mengambil data kripto: ' . $e->getMessage());
        }
    }

    //pra proses data
    public function praProses() {
        try {
            ini_set('max_execution_time', 300);//5 menit
            if (DataPraProses::exists()) {
                return redirect()->back()->with('error', 'Sudah Ada Data Yang Di Pra Proses. Pra Proses Hanya Bisa Dilakukan Satu Kali.');
            }         
             
            DB::beginTransaction();

            $dataImport = DataImport::orderBy('date')->get();
    
            if ($dataImport->isEmpty()) {
                return redirect()->back()->with('error', 'Data Import kosong. Tidak bisa melakukan pra-proses.');
            }
            // Validasi: cek apakah ada data dengan price = 0
            $hasZeroPrice = $dataImport->contains(function ($item) {
                return floatval($item->price) == 0;
            });

            if ($hasZeroPrice) {
                return redirect()->back()->with('error', 'Data tidak bisa dilakukan proses, coba cari data lain.');
            }
    
            $sourceId = $dataImport->first()->source_id;
            $formattedData = collect();
    
            foreach ($dataImport as $item) {
                // Perbaiki format tanggal
                $cleanDate = str_replace('.', '/', $item->date);
                $formattedDate = Carbon::createFromFormat('m/d/Y', $cleanDate)->format('Y-m-d');
    
                // Hapus koma, ubah harga
                $cleanPrice = floatval(str_replace(',', '', $item->price));
    
                $formattedData->push([
                    'source_id' => $sourceId,
                    'date' => $formattedDate,
                    'price' => $cleanPrice,
                ]);
            }
    
            // sorting berdasarkan date!
            $sortedData = $formattedData->sortBy('date')->values(); 
    
            //setting param training dan testing
            $setting = SettingParam::first(); // Ambil data pertama dari tabel setting_param
            if (!$setting) {
                return redirect()->back()->with('error', 'Parameter setting belum tersedia. Harap isi terlebih dahulu.');
            }

            // Ambil nilai training dan testing dari DB
            $trainingPercentage = floatval($setting->training_percentage);
            $testingPercentage = floatval($setting->testing_percentage);

            $total = $sortedData->count();
            $trainingCount = (int) floor($total * ($trainingPercentage / 100));

    
            foreach ($sortedData as $index => $data) {
                DataPraProses::create([
                    'source_id' => $data['source_id'],
                    'date' => $data['date'],
                    'price' => round($data['price'], 2),
                    'category' => $index < $trainingCount ? 'Training' : 'Testing',
                ]);
            }
            DB::commit();
            session()->push('notifications', [
                'icon' => 'mdi-flag-variant',
                'bgColor' => 'info',
                'title' => 'Pra-Proses Berhasil',
                'text' => 'Data sudah siap untuk dilakukan peramalan.',
                'time' => Carbon::now()->toDateTimeString(), 
            ]);  
            return redirect()->route('peramalan.index')->with('Success', 'Anjay Berhasil Pra Proses Nih');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal melakukan pra-proses: ' . $e->getMessage());
        }
    }

    // simpan data csv ke database
    public function post(Request $request){
        try {
            ini_set('max_execution_time', 300);//5 menit
            ini_set('memory_limit', '512M');

            $request->validate([
                'name' => 'required|string|max:50',
                'sumber' => 'required|in:Import',
                'file' => 'required|file|mimes:csv,txt',
            ], [
                'name.required' => '🚨Kolom Jenis Kripto wajib diisi.⚠️',
                'sumber.required' => '🔎 Sumber data wajib diisi.',
                'file.required' => '❗Jenis data harus dipilih.',
            ]);

            $file = $request->file('file');

            if (!$file->isValid()) {
                return back()->withInput()->withErrors(['file' => 'File CSV tidak valid.']);
            }

            $path = $file->getRealPath();
            $rows = array_map('str_getcsv', file($path));
            if (empty($rows)) {
                return back()->withErrors(['file' => 'File CSV kosong.']);
            }

            $rawHeader = $rows[0];
            $header = array_map(function($h) {
                return trim(str_replace('"', '', preg_replace('/\xEF\xBB\xBF/', '', $h)));
            }, $rawHeader);

            $expectedHeaders = ['Date', 'Price', 'Open', 'High', 'Low', 'Vol.', 'Change %'];
            if ($header !== $expectedHeaders) {
                return back()->withInput()->withErrors([
                    'file' => '🚨Format file CSV tidak sesuai. Tolong baca petunjuk penggunaan kembali atau gunakan file CSV dari investing.com⚠️',
                ]);
            }

            if (DataImport::exists()) {
                return back()->withErrors([
                    'file' => '🚨Data historis sudah ada. Silakan hapus terlebih dahulu sebelum menambahkan data baru.⚠️',
                ]);
            }

            DB::beginTransaction();

            // Hapus header
            array_shift($rows);

            // Simpan ke tabel data_source
            $source = DataSource::create([
                'name' => $request->name,
                'periode_awal' => $request->input('date-start'),
                'periode_akhir' => $request->input('date-end'),
                'sumber' => $request->sumber,
            ]);

            // Siapkan data untuk insert massal
            $dataToInsert = [];
            foreach ($rows as $row) {
                if (count($row) < 7 || empty($row[0])) continue;

                $row = array_map(fn($val) => trim(str_replace('"', '', $val)), $row);

                $dataToInsert[] = [
                    'source_id' => $source->id,
                    'date' => $row[0],
                    'price' => $row[1],
                    'open' => $row[2],
                    'high' => $row[3],
                    'low' => $row[4],
                    'vol' => $row[5],
                    'change' => (str_contains($row[6], '-') ? '' : '+') . $row[6],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Bulk insert dengan chunk (1000 baris per batch)
            foreach (array_chunk($dataToInsert, 1000) as $chunk) {
                DataImport::insert($chunk);
            }

            if (empty($dataToInsert)) {
                return back()->withErrors(['file' => '🚨Data tidak bisa diproses. File kosong atau format tidak dikenali.⚠️']);
            }

            DB::commit();
            session()->push('notifications', [
                'icon' => 'mdi-approval',
                'bgColor' => 'success',
                'title' => 'Import Data Berhasil yay',
                'text' => 'Silahkan menuju halaman data import untuk dilakukan pra proses.',
                'time' => Carbon::now()->toDateTimeString(), 
            ]);
            return redirect()->route('data.importData')->with('Success', 'Import Data Berhasil');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
    
    public function hapus() {
        try {
            if (DataHasil::exists()) {
                return redirect()->back()->with('error', 'Hapus data pada halaman hasil peramalan terlebih dahulu, sebelum menghapus data impor.');
            } 

            DB::beginTransaction();
            
            // Ambil semua data_source dengan jenis Import
            $sources = DataSource::where('sumber', 'Import')->get();
            

            // Hapus semuanya (otomatis akan menghapus data_import yang berkaitan karena onDelete('cascade'))
            foreach ($sources as $source) {
                $source->delete();
            }

            // DB::table('data_import')->delete();//khusus sqlite
            DB::commit();

            session()->push('notifications', [
                'icon' => 'mdi-delete-forever',
                'bgColor' => 'danger',
                'title' => 'Data Import Dihapus',
                'text' => 'Data berhasil dihapus.',
                'time' => Carbon::now()->toDateTimeString(), 
            ]);

            return redirect()->route('data.importData')->with('Success', 'Data berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal hapus data: ' . $e->getMessage());
        }
    }

}
