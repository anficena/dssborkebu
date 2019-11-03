<?php

namespace App\Http\Controllers;

use App\LayananKpk;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

class LayananKpkController extends Controller
{
    public function index()
    {
        //
    }

    public function create($layanan)
    {
        $model = new LayananKpk();
        return view('dssmenu.partials.layanan_kpk_form', compact('model', 'layanan'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'tanggal' => 'required',
            'tamu' => 'required',
            'instansi' => 'required',
            'alamat' => 'required',
            'keperluan' => 'required',
            // 'lokasi' => 'required',
            'jenis_layanan' => 'required',
            'jumlah' => 'required'
        ]);

        $model = LayananKpk::create([
            'user_id' => Auth::user()->id,
            'sub_layanan' => $request->sub_layanan,
            'tanggal' => $request->tanggal,
            'tamu' => $request->tamu,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'keperluan' => $request->keperluan,
            'lokasi' => $request->lokasi,
            'jenis_layanan' => $request->jenis_layanan,
            'jumlah' => $request->jumlah,
        ]);

        return $model;
    }

    public function show(LayananKpk $layananKpk)
    {
        //
    }

    public function edit($id)
    {
        $model = LayananKpk::findOrFail($id);
        return view('dssmenu.partials.layanan_kpk_form', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'tanggal' => 'required',
            'tamu' => 'required',
            'instansi' => 'required',
            'alamat' => 'required',
            'keperluan' => 'required',
            // 'lokasi' => 'required',
            'jenis_layanan' => 'required',
            'jumlah' => 'required'
        ]);

        $model = LayananKpk::findOrFail($id);
        
        $model->update([
            'user_id' => Auth::user()->id,
            'sub_layanan' => $request->sub_layanan,
            'tanggal' => $request->tanggal,
            'tamu' => $request->tamu,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'keperluan' => $request->keperluan,
            'lokasi' => $request->lokasi,
            'jenis_layanan' => $request->jenis_layanan,
            'jumlah' => $request->jumlah,
        ]);

        return $model;
    }

    public function destroy($id)
    {
       $model = LayananKpk::findOrFail($id);
       $model->delete();
    }

    public function dataTableLayananKpk($param){
        $model = LayananKpk::select('id', 
            DB::raw('DATE_FORMAT(tanggal, "%M-%Y") as month'), 
            DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'),
            'tamu', 'instansi', 'alamat', 'keperluan', 'lokasi', 
            'jenis_layanan', 'jumlah')
        ->where('sub_layanan',$param)
        ->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('layanankpk.show', $model->id),
                    'url_edit' => route('layanankpk.edit', $model->id),
                    'url_destroy' => route('layanankpk.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
