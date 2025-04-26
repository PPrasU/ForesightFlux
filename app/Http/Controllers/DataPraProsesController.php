<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPraProses;

class DataPraProsesController extends Controller
{
    public function index(){
        $data = DataPraProses::all();
        return view('praProses', compact('data')); 
    }

    public function post(Request $request){
        //dd($request->all());
        DataPraProses::create($request->all());
        return redirect()->route('peramalan.hasilPeramalan')->with('Success', 'Pra Proses Data Berhasil Dilakukan');
    }

    public function hapus(){
        try{
            DataPraProses::truncate();
            return redirect()->route('peramalan.prosesPeramalan')->with('Success', 'Data Pra Proses Berhasil Dihapus');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Huhuhuhu gagal hapus data nih: ' . $e->getMessage());
        }
        
    }
}
