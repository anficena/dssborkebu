<?php

namespace App\Http\Controllers;

use App\BakKontrol;
use App\MonevLingkungan;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class BakKontrolController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_bak_kontrol');
    }

    public function create()
    {
        $model = new BakKontrol();
        $parameter = BakKontrol::pluck('parameter','parameter')->toArray();
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.bak_form', compact('model','parameter', 'observasi'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'kategori' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'parameter' => 'required',
            'hasil' => 'required',
            'standar' => 'required',
            'satuan' => 'required'
        ]);

        $model = BakKontrol::create([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'kategori' => $request->kategori,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'parameter' => $request->parameter,
            'hasil' => $request->hasil,
            'standar' => $request->standar,
            'satuan' => $request->satuan
        ]);

        return $model;
    }

    
    public function edit($id)
    {
        $model = BakKontrol::findOrFail($id);
        $parameter = BakKontrol::pluck('parameter','parameter')->toArray();
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.bak_form', compact('model','parameter', 'observasi'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'kategori' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'parameter' => 'required',
            'hasil' => 'required',
            'standar' => 'required',
            'satuan' => 'required'
        ]);

        $model = BakKontrol::findOrFail($id);
        $model->Update([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'kategori' => $request->kategori,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'parameter' => $request->parameter,
            'hasil' => $request->hasil,
            'standar' => $request->standar,
            'satuan' => $request->satuan
        ]);

        return $model;
    }

    
    public function destroy($id)
    {
        $model = BakKontrol::findOrFail($id);
        $model->delete();
    }

    public function dataTableBakKontrol(){
        $model = BakKontrol::with(['monev_lingkungan' => function($q){
            $q->select('id', 'judul');
        }])->select('id','observasi_id', 
        DB::raw('DATE_FORMAT(waktu, "%d-%m-%Y") as tanggal'), 
        DB::raw('DATE_FORMAT(waktu, "%Y") as tahun'), 'kategori', 
        'parameter', 'satuan', 'lokasi', 'hasil', 'standar')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('bak.show', $model->id),
                    'url_edit' => route('bak.edit', $model->id),
                    'url_destroy' => route('bak.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
