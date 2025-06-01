<?php

namespace App\Http\Controllers;

use App\Models\HasilAkurasi;
use App\Models\HasilTesting;
use App\Models\SettingParam;
use Illuminate\Http\Request;
use App\Models\HasilTraining;

class DasborAdminController extends Controller
{
    public function index(){
        $dataParam = SettingParam::first();
        $training = HasilTraining::all();
        $testing = HasilTesting::all();
        $akurasi = HasilAkurasi::all();

        return view('admin.dasbor', compact(
            'dataParam',
            'training',
            'testing',
            'akurasi',
        ));
    }
}
