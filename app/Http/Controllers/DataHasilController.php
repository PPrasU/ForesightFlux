<?php

namespace App\Http\Controllers;

use App\Models\DataHasil;
use Illuminate\Http\Request;

class DataHasilController extends Controller
{
    public function index(){
        // $data = DataHasil::all();
        // return view('hasil', compact('data')); 
        return view('hasil');
    }

    public function post(Request $request){
        //dd($request->all());
        DataHasil::create($request->all());
        return redirect()->route('index')->with('Success', 'Hasil Peramalan Data Berhasil Dilakukan');
    }

    public function hapus(){
        $data = DataHasil::all();
        $data->delete();
        return redirect()->route('index')->with('Success', 'Data Hasil Peramalan Berhasil Dihapus');
    }
}
