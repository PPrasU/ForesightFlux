<?php

namespace App\Http\Controllers;

use App\Models\SettingParam;
use Illuminate\Http\Request;

class SettingParamController extends Controller
{
    public function index(){
        $data = SettingParam::all();
        return view('admin.settingParams', compact('data'));
    }

    public function input(){
        return view('admin.input.settingParams');
    }

    public function post(Request $request){
        $data = SettingParam::create($request->all());

        return redirect()->route('admin.settingParams')->with('Success', 'Weeee Petunjuk Param Baru Udah Ditambah');
    }

    public function edit($id){
        $data = SettingParam::find($id);
        return view('admin.edit.settingParams', compact('data'));
    }

    public function update(Request $request, $id){
        $data = SettingParam::find($id);

        $data->update($request->all());
        return redirect()->route('admin.settingParams')->with('Success', 'Anjay Data Udah Di Edit. Emangnya Edit Apalagi Dah');
    }

    public function hapus($id){
        $data = SettingParam::find($id);
        $data->delete();
        return redirect()->route('admin.settingParams')->with('Success', 'Udah Di Hapus Boskuh Datanya');
    }
}
