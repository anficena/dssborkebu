<?php

namespace App\Http\Controllers;

use App\SumurPenduduk;
use\App\MonevLingkungan;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class SumurPendudukController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_sumur');
    }

    public function create()
    {
        $model = new SumurPenduduk();
        $parameter = SumurPenduduk::pluck('parameter','parameter')->toArray();
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.sumur_form', compact('model','parameter', 'observasi'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'parameter' => 'required',
            'hasil' => 'required',
            'standar' => 'required',
            'satuan' => 'required'
        ]);

        $model = SumurPenduduk::create([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
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
        $model = SumurPenduduk::findOrFail($id);
        $parameter = SumurPenduduk::pluck('parameter','parameter')->toArray();
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.sumur_form', compact('model','parameter', 'observasi'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'parameter' => 'required',
            'hasil' => 'required',
            'standar' => 'required',
            'satuan' => 'required'
        ]);

        $model = SumurPenduduk::findOrFail($id);
        $model->Update([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
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
        $model = SumurPenduduk::findOrFail($id);
        $model->delete();
    }

    public function dataTableSumur(){
        $model = SumurPenduduk::with(['monev_lingkungan' => function($q){
            $q->select('id', 'judul');
        }])->select('id','observasi_id', 
        DB::raw('DATE_FORMAT(waktu, "%d-%m-%Y") as tanggal'), 
        DB::raw('DATE_FORMAT(waktu, "%Y") as tahun'), 'parameter', 
        'satuan', 'lokasi', 'hasil', 'standar')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('sumur.show', $model->id),
                    'url_edit' => route('sumur.edit', $model->id),
                    'url_destroy' => route('sumur.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
