<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPraProses;

class DataPraProsesController extends Controller
{
    public function index(){
        // $data = DataPraProses::all();
        // return view('praProses', compact('data')); 
        return view('praProses');
    }

    public function post(Request $request){
        //dd($request->all());
        DataPraProses::create($request->all());
        return redirect()->route('index')->with('Success', 'Pra Proses Data Berhasil Dilakukan');
    }

    public function hapus(){
        $data = DataPraProses::all();
        $data->delete();
        return redirect()->route('index')->with('Success', 'Data Pra Proses Berhasil Dihapus');
    }
}
