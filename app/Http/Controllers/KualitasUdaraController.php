<?php

namespace App\Http\Controllers;

use App\KualitasUdara;
use App\MonevLingkungan;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class KualitasUdaraController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_udara');
    }

    public function create()
    {
        $model = new KualitasUdara();
        $parameter = KualitasUdara::pluck('parameter','parameter')->toArray();
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.udara_form', compact('model','parameter', 'observasi'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'parameter' => 'required',
            'hasil' => 'required',
            'satuan' => 'required'
        ]);

        $model = KualitasUdara::create([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'parameter' => $request->parameter,
            'hasil' => $request->hasil,
            'satuan' => $request->satuan
        ]);

        return $model;
    }

    
    public function edit($id)
    {
        $model = KualitasUdara::findOrFail($id);
        $parameter = KualitasUdara::pluck('parameter','parameter')->toArray();
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.udara_form', compact('model','parameter', 'observasi'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'parameter' => 'required',
            'hasil' => 'required',
            'satuan' => 'required'
        ]);

        $model = KualitasUdara::findOrFail($id);
        $model->Update([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'parameter' => $request->parameter,
            'hasil' => $request->hasil,
            'satuan' => $request->satuan
        ]);

        return $model;
    }

    public function destroy($id)
    {
        $model = KualitasUdara::findOrFail($id);
        $model->delete();
    }

    public function dataTableUdara(){
        $model = KualitasUdara::with(['monev_lingkungan' => function($q){
            $q->select('id', 'judul');
        }])->select('id','observasi_id', 
        DB::raw('DATE_FORMAT(waktu, "%d-%m-%Y") as tanggal'),
        DB::raw('DATE_FORMAT(waktu, "%M") as bulan'), 
        DB::raw('DATE_FORMAT(waktu, "%Y") as tahun'),
        'lokasi', 'parameter', 'hasil', 'satuan')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('udara.show', $model->id),
                    'url_edit' => route('udara.edit', $model->id),
                    'url_destroy' => route('udara.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
