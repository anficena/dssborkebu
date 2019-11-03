<?php

namespace App\Http\Controllers;

use App\DataFauna;
use App\MonevLingkungan;
use Illuminate\Http\Request;
use DataTables;
Use DB;
use Auth;

class DataFaunaController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_fauna');
    }

    public function create()
    {
        $model = new DataFauna();
        $jenis = DataFauna::pluck('jenis','jenis')->toArray();
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.fauna_form', compact('model','observasi','jenis'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
            'keterangan' => 'required'
        ]);

        $model = DataFauna::create([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'keterangan' => $request->keterangan
        ]);

        return $model;
    }

    public function show($id)
    {
        $model = DataFauna::findOrFail($id);
        return view('dssmenu.monev_lingkungan.detail_flora', compact('model'));
    }

    public function edit($id)
    {
        $model = DataFauna::findOrFail($id);
        $jenis = DataFauna::pluck('jenis','jenis')->toArray();
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.fauna_form', compact('model','observasi','jenis'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
            'keterangan' => 'required'
        ]);
        
        $model = DataFauna::findOrFail($id);
        $model->update([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'keterangan' => $request->keterangan
        ]);

        return $model;
    }

    public function destroy($id){
        $model = DataFauna::findOrFail($id);
        $model->delete();
    }

    public function dataTableFauna(){
        $model = DataFauna::with(['monev_lingkungan' => function($q){
            $q->select('id', 'judul');
        }])->select('id', 'observasi_id',
        DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'), 
        DB::raw('DATE_FORMAT(tanggal, "%Y") as tahun'), 
        'lokasi', 'nama', 'jumlah')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('fauna.show', $model->id),
                    'url_edit' => route('fauna.edit', $model->id),
                    'url_destroy' => route('fauna.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
