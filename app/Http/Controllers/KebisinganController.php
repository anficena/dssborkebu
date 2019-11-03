<?php

namespace App\Http\Controllers;

use App\Kebisingan;
use App\MonevLingkungan;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class KebisinganController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_kebisingan');
    }

    public function create()
    {
        $model = new Kebisingan();
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.kebisingan_form', compact('model', 'observasi'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'hasil' => 'required',
            'satuan' => 'required'
        ]);

        $model = Kebisingan::create([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'hasil' => $request->hasil,
            'satuan' => $request->satuan
        ]);

        return $model;
    }

    
    public function edit($id)
    {
        $model = Kebisingan::findOrFail($id);
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.kebisingan_form', compact('model', 'observasi'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'hasil' => 'required',
            'satuan' => 'required'
        ]);

        $model = Kebisingan::findOrFail($id);
        $model->Update([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'hasil' => $request->hasil,
            'satuan' => $request->satuan
        ]);

        return $model;
    }

    public function destroy($id)
    {
        $model = Kebisingan::findOrFail($id);
        $model->delete();
    }

    public function dataTableKebisingan(){
        $model = Kebisingan::with(['monev_lingkungan' => function($q){
            $q->select('id', 'judul');
        }])->select('id','observasi_id', 
        DB::raw('DATE_FORMAT(waktu, "%d-%m-%Y") as tanggal'),
        DB::raw('DATE_FORMAT(waktu, "%M") as bulan'), 
        DB::raw('DATE_FORMAT(waktu, "%Y") as tahun'),
        'lokasi', 'hasil', 'satuan')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('kebisingan.show', $model->id),
                    'url_edit' => route('kebisingan.edit', $model->id),
                    'url_destroy' => route('kebisingan.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
