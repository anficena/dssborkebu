<?php

namespace App\Http\Controllers;

use App\LayananAduan;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

class LayananAduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        $model = new LayananAduan();
        return view('dssmenu.partials.layanan_aduan_form', compact('model'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'tanggal' => 'required',
            'tamu' => 'required',
            'telephone' => 'required',
            'alamat' => 'required',
            'keperluan' => 'required',
            // 'lokasi' => 'required',
            'tindakan' => 'required'
        ]);

        $model = LayananAduan::create([
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'tamu' => $request->tamu,
            'telephone' => $request->telephone,
            'alamat' => $request->alamat,
            'keperluan' => $request->keperluan,
            'tindakan' => $request->tindakan
        ]);

        return $model;
    }

    public function show(LayananAduan $layananAduan)
    {
        //
    }

    public function edit($id)
    {
        $model = LayananAduan::findOrFail($id);
        return view('dssmenu.partials.layanan_aduan_form', compact('model'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'tanggal' => 'required',
            'tamu' => 'required',
            'telephone' => 'required',
            'alamat' => 'required',
            'keperluan' => 'required',
            // 'lokasi' => 'required',
            'tindakan' => 'required'
        ]);

        $model = LayananAduan::findOrFail($id);
        $model->update([
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'tamu' => $request->tamu,
            'telephone' => $request->telephone,
            'alamat' => $request->alamat,
            'keperluan' => $request->keperluan,
            'tindakan' => $request->tindakan
        ]);

        return $model;

    }

    public function destroy($id)
    {
        $model = LayananAduan::findOrFail($id);
        $model->delete();
    }

    public function dataTableLayananAduan(){
        $model = LayananAduan::select('id', 
            DB::raw('DATE_FORMAT(tanggal, "%M-%Y") as month'), 
            DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'),
            'tamu', 'telephone', 'alamat', 'keperluan', 'tindakan')
        ->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('layanan_aduan.show', $model->id),
                    'url_edit' => route('layanan_aduan.edit', $model->id),
                    'url_destroy' => route('layanan_aduan.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
