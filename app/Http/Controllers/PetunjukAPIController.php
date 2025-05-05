<?php

namespace App\Http\Controllers;

use App\Models\PetunjukAPI;
use Illuminate\Http\Request;

class PetunjukAPIController extends Controller{
    public function index(){
        $data = PetunjukAPI::all();
        return view('admin.petunjukApi', compact('data'));
    }

    public function input(){
        return view('admin.input.petunjukApi');
    }

    public function post(Request $request){
        $data = PetunjukAPI::create($request->all());
    
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
            $namaGambar = "{$nomorUrut}-PetunjukAPI.{$ext}";
    
            // Pindahkan file
            $gambar->move($folderPath, $namaGambar);
    
            // Simpan nama file ke database
            $data->gambar = $namaGambar;
            $data->save();
        }
    
        return redirect()->route('admin.petunjukAPI')->with('Success', 'Weeee Petunjuk Import Udah Ditambah');
    }

    public function edit($id){
        $data = PetunjukAPI::find($id);
        return view('admin.edit.petunjukApi', compact('data'));
    }

    public function update(Request $request, $id){
        $data = PetunjukAPI::find($id);
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
        return redirect()->route('admin.petunjukAPI')->with('Success', 'Anjay Data Udah Di Update. Emangnya Edit Apalagi Dah');
    }

    public function hapus($id){
        $data = PetunjukAPI::find($id);

        if ($data) {
            $gambarPath = public_path('foto-petunjuk-penggunaan/' . $data->gambar);

            if (file_exists($gambarPath)) {
                unlink($gambarPath); 
            }

            $data->delete();

            return redirect()->route('admin.petunjukAPI')->with('Success', 'Udah Di Hapus Boskuh Datanya');
        } else {
            return redirect()->route('admin.petunjukAPI')->with('Error', 'Data Tidak Ditemukan!');
        }
    }

}
