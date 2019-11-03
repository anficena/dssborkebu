<?php

namespace App\Http\Controllers;
use App\LayananTemuan;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

class LayananTemuanController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $model = new LayananTemuan();
        return view('dssmenu.partials.layanan_temuan_form', compact('model'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'tanggal' => 'required',
            'jenis_temuan' => 'required',
            'penemu' => 'required',
            'alamat' => 'required',
            'bentuk' => 'required',
            // 'lokasi' => 'required',
            'kompensasi' => 'required'
        ]);

        $model = LayananTemuan::create([
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'jenis_temuan' => $request->jenis_temuan,
            'penemu' => $request->penemu,
            'alamat' => $request->alamat,
            'bentuk' => $request->bentuk,
            'kompensasi' => $request->kompensasi
        ]);

        return $model;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $model = LayananTemuan::findOrFail($id);
        return view('dssmenu.partials.layanan_temuan_form', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'tanggal' => 'required',
            'jenis_temuan' => 'required',
            'penemu' => 'required',
            'alamat' => 'required',
            'bentuk' => 'required',
            // 'lokasi' => 'required',
            'kompensasi' => 'required'
        ]);

        $model = LayananTemuan::findOrFail($id);
        
        $model->update([
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'jenis_temuan' => $request->jenis_temuan,
            'penemu' => $request->penemu,
            'alamat' => $request->alamat,
            'bentuk' => $request->bentuk,
            'kompensasi' => $request->kompensasi
        ]);

        return $model;
    }
    public function destroy($id)
    {
        $model = LayananTemuan::findOrFail($id);
        $model->delete();
    }

    public function dataTableLayananTemuan(){
        $model = LayananTemuan::select('id', 
            DB::raw('DATE_FORMAT(tanggal, "%M-%Y") as month'), 
            DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'),
            'jenis_temuan', 'penemu', 'alamat', 'bentuk', 'kompensasi')
        ->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('layanan_temuan.show', $model->id),
                    'url_edit' => route('layanan_temuan.edit', $model->id),
                    'url_destroy' => route('layanan_temuan.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
