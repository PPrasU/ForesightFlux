<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetunjukImport;

class PetunjukImportController extends Controller
{
    public function index(){
        $data = PetunjukImport::all();
        return view('admin.petunjukImport', compact('data'));
    }

    public function input(){
        return view('admin.input.petunjukImport');
    }

    public function post(Request $request){
        $data = PetunjukImport::create($request->all());
    
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $folderPath = public_path('foto-petunjuk-penggunaan');
    
            // Buat folder kalau belum ada
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
    
            // Hitung jumlah file yang ada
            $fileCount = count(glob($folderPath . '/*'));
            $nomorUrut = str_pad($fileCount + 1, 2, '0', STR_PAD_LEFT); // contoh: 01, 02, 03
    
            // Dapatkan ekstensi file (jpg, png, dll)
            $ext = $gambar->getClientOriginalExtension();
    
            // Nama file baru
            $namaGambar = "{$nomorUrut}-PetunjukImport.{$ext}";
    
            // Pindahkan file
            $gambar->move($folderPath, $namaGambar);
    
            // Simpan nama file ke database
            $data->gambar = $namaGambar;
            $data->save();
        }
    
        return redirect()->route('admin.petunjukImport')->with('Success', 'Weeee Petunjuk Import Udah Ditambah');
    }

    public function edit($id){
        $data = PetunjukImport::findOrFail($id);
        return view('admin.edit.petunjukImport', compact('data'));
    }

    public function update(Request $request, $id){
        $data = PetunjukImport::find($id);
        if($request->hasFile('gambar')){
            if ($data->gambar) {
                $oldImagePath = public_path('foto-petunjuk-penggunaan/' . $data->gambar);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Hapus file lama
                }
            }
            $newImageName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('foto-petunjuk-penggunaan/', $newImageName);
            
            $data->gambar = $newImageName;
        }
        $data->update($request->except('gambar'));
        return redirect()->route('admin.petunjukImport')->with('Success', 'Anjay Data Udah Di Edit. Emangnya Edit Apalagi Dah');
    }

    public function hapus($id){
        $data = PetunjukImport::find($id);

        if ($data) {
            $gambarPath = public_path('foto-petunjuk-penggunaan/' . $data->gambar);

            if (file_exists($gambarPath)) {
                unlink($gambarPath); // Hapus file gambar
            }

            $data->delete();

            return redirect()->route('admin.petunjukImport')->with('Success', 'Udah Di Hapus Boskuh Datanya');
        } else {
            return redirect()->route('admin.petunjukImport')->with('Error', 'Data Tidak Ditemukan!');
        }
    }
}
