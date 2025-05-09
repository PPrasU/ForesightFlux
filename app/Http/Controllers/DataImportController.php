<?php

namespace App\Http\Controllers;

use App\Models\DataImport;
use App\Models\DataSource;
use App\Models\DataPraProses;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function post(Request $request){
        try {
            $request->validate([
                'name' => 'required|string|max:50',
                'sumber' => 'required|in:Import',
                'file' => 'required|file|mimes:csv,txt',
            ]);

            // session()->push('notifications', [
            //     'icon' => 'mdi-flag-variant',
            //     'bgColor' => 'info',
            //     'title' => 'Import Data Berhasil',
            //     'text' => 'Data sudah siap untuk dilakukan pra-proses.'
            // ]); 
    
            $file = $request->file('file');
    
            if (!$file->isValid()) {
                return back()->withErrors(['file' => 'File CSV tidak valid.']);
            }
    
            // Baca CSV
            $path = $file->getRealPath();
            $rows = array_map('str_getcsv', file($path));
            if (empty($rows)) {
                return back()->withErrors(['file' => 'File CSV kosong.']);
            }
    
            // Ambil baris pertama sebagai header
            $rawHeader = $rows[0];
    
            // Menghapus BOM jika ada dan memastikan header sesuai dengan format asli
            $header = array_map(function($h) {
                // Hapus BOM jika ada
                $h = preg_replace('/\xEF\xBB\xBF/', '', $h);
                // Hapus tanda kutip dan trim spasi
                return trim(str_replace('"', '', $h));
            }, $rawHeader);
    
            // Header yang diharapkan sesuai dengan CSV asli
            $expectedHeaders = ['Date', 'Price', 'Open', 'High', 'Low', 'Vol.', 'Change %'];
    
            // Periksa apakah header sesuai dengan yang diharapkan
            if ($header !== $expectedHeaders) {
                return back()->withErrors([
                    'file' => '🚨Format file CSV tidak sesuai. Tolong baca petunjuk penggunaan kembali atau gunakan file CSV dari investing.com⚠️',
                ]);
            }

            if (DataImport::exists()) {
                return back()->withErrors([
                    'file' => '🚨Data historis sudah ada. Silakan hapus terlebih dahulu sebelum menambahkan data baru.⚠️',
                ]);
            }
    
            // Buang header dari data (baris pertama sudah diproses)
            array_shift($rows);
    
            // Buat entri data sumber
            $source = DataSource::create([
                'name' => $request->name,
                'periode_awal' => $request->input('date-start'),
                'periode_akhir' => $request->input('date-end'),
                'sumber' => $request->sumber,
            ]);
    
            // Proses data CSV dan simpan ke database
            foreach ($rows as $row) {
                if (count($row) < 7 || empty($row[0])) continue;
    
                // Hapus tanda kutip dan trim nilai
                $row = array_map(fn($val) => trim(str_replace('"', '', $val)), $row);
    
                DataImport::create([
                    'source_id' => $source->id,
                    'date' => $row[0],
                    'price' => $row[1],
                    'open' => $row[2],
                    'high' => $row[3],
                    'low' => $row[4],
                    'vol' => $row[5],
                    'change' => (str_contains($row[6], '-') ? '' : '+') . $row[6],
                ]);
            }

            session()->push('notifications', [
                'icon' => 'mdi-approval',
                'bgColor' => 'success',
                'title' => 'Import Data Berhasil',
                'text' => 'Silahkan menuju halaman data import untuk dilakukan pra proses.'
            ]);            

            return redirect()->route('data.importData')->with('Success', 'Import Data Berhasil');
            
            
    
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }

    public function praProses() {
        try {
            if (DataPraProses::exists()) {
                return redirect()->back()->with('error', 'Sudah Ada Data Yang Di Pra Proses. Pra Proses Hanya Bisa Dilakukan Satu Kali.');
            }
            
            session()->push('notifications', [
                'icon' => 'mdi-flag-variant',
                'bgColor' => 'info',
                'title' => 'Pra-Proses Berhasil',
                'text' => 'Data sudah siap untuk dilakukan peramalan.'
            ]);            

            $dataImport = DataImport::orderBy('date')->get();
    
            if ($dataImport->isEmpty()) {
                return redirect()->back()->with('error', 'Data Import kosong. Tidak bisa melakukan pra-proses.');
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
    
            // 🔥 Tambahkan sorting berdasarkan date!
            $sortedData = $formattedData->sortBy('date')->values(); // <- ini kunci utamanya!
    
            // Bagi 80:20 Training:Testing
            $total = $sortedData->count();
            $trainingCount = floor($total * 0.8);
    
            foreach ($sortedData as $index => $data) {
                DataPraProses::create([
                    'source_id' => $data['source_id'],
                    'date' => $data['date'],
                    'price' => $data['price'],
                    'category' => $index < $trainingCount ? 'Training' : 'Testing',
                ]);
            }
    
            return redirect()->route('peramalan.prosesPeramalan')->with('Success', 'Anjay Berhasil Pra Proses Nih');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan pra-proses: ' . $e->getMessage());
        }
    }    
    
    public function hapus(){
        try{
            session()->push('notifications', [
                'icon' => 'mdi-delete-forever',
                'bgColor' => 'danger',
                'title' => 'Data Import Dihapus',
                'text' => 'Data berhasil dihapus.'
            ]);            
            DataImport::truncate();
            return redirect()->route('data.importData')->with('Success', 'Data Pra Proses Berhasil Dihapus');
        }catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Huhuhuhu gagal hapus data nih: ' . $e->getMessage());
        }
    }
}
