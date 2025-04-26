<?php

namespace App\Http\Controllers;

use App\Models\DataImport;
use App\Models\DataSource;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DataImporTController extends Controller
{
    public function index(){
        $data = DataImport::all();
        return view('dataImport', compact('data')); 
    }

    public function input(){
        $dataSource = DataSource::all();
        $dataImport = DataImport::all();
        return view('input/dataImport', compact('dataSource', 'dataImport'));
    }

    public function post(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:50',
                'sumber' => 'required|in:import',
                'file' => 'required|file|mimes:csv,txt',
            ]);
    
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

            return redirect()->route('data.importData')->with('Success', 'Import Data Berhasil');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }

    public function praProses(){
        
    }
    
    public function hapus(){
        DataImport::truncate();
        DataSource::truncate();

        return redirect()->route('data.importData')->with('Success', 'Data Import Berhasil Dihapus');
    }

    // DataImport::create([
    //     'source_id' => $source->id,
    //     'date' => $date,
    //     'price' => floatval(str_replace(',', '', $row[1])),
    //     'open' => floatval(str_replace(',', '', $row[2])),
    //     'high' => floatval(str_replace(',', '', $row[3])),
    //     'low' => floatval(str_replace(',', '', $row[4])),
    //     'vol' => $row[5], // Biarkan dalam bentuk string
    //     'change' => (str_contains($row[6], '-') ? '' : '+') . $row[6],
    // ]);
}
