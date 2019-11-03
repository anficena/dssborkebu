<?php

namespace App\Http\Controllers;

use App\KemiringanDinding;
use App\Candi;
use App\Imports\KemiringanDindingImport;
use Excel;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class KemiringanDindingController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_stabilitas.kelola_kemiringan_dinding');
    }

    public function create()
    {
        $model = new KemiringanDinding();
        $cagar = Candi::pluck('nama','id')->toArray();
        return view('dssmenu.monev_stabilitas.kemiringan_dinding_form', compact('model', 'cagar'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
            'titik' => 'required',
            'sumbu_xa' => 'required',
            'sumbu_xb' => 'required',
            'sumbu_xh' => 'required',
            'sumbu_ya' => 'required',
            'sumbu_yb' => 'required',
            'sumbu_yh' => 'required',
            'kemiringan_x' => 'required',
            'kemiringan_y' => 'required',
            'pedoman_x' => 'required',
            'pedoman_y' => 'required',
            'selisih_x' => 'required',
            'selisih_y' => 'required',
            'keterangan' => 'required',
        ]);
        
        $model = KemiringanDinding::create([
            'candi_id' => $request->candi_id,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'titik' => $request->titik,
            'sumbu_xa' => $request->sumbu_xa,
            'sumbu_xb' => $request->sumbu_xb,
            'sumbu_xh' => $request->sumbu_xh,
            'sumbu_ya' => $request->sumbu_ya,
            'sumbu_yb' => $request->sumbu_yb,
            'sumbu_yh' => $request->sumbu_yh,
            'kemiringan_x' => $request->kemiringan_x,
            'kemiringan_y' => $request->kemiringan_y,
            'pedoman_x' => $request->pedoman_x,
            'pedoman_y' => $request->pedoman_y,
            'selisih_x' => $request->selisih_x,
            'selisih_y' => $request->selisih_y,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::user()->id,
        ]);

        return $model;
    }

    public function import(){
        return view("dssmenu.import.import_kemiringan_dinding");
    }

    public function importStore(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand().$file->getClientOriginalName();

        $file->move('import/kemiringan_dinding/',$nama_file);

        Excel::import(new KemiringanDindingImport, public_path('/import/kemiringan_dinding/'.$nama_file));
    }


    public function show($id)
    {
        $model = KemiringanDinding::findOrFail($id);
        return view('dssmenu.monev_lingkungan.tingkat_pengunjung_form', compact('model'));
    }
    
    public function edit($id)
    {
        $model = KemiringanDinding::findOrFail($id);
        $cagar = Candi::pluck('nama','id')->toArray();
        return view('dssmenu.monev_stabilitas.kemiringan_dinding_form', compact('model', 'cagar'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
            'titik' => 'required',
            'sumbu_xa' => 'required',
            'sumbu_xb' => 'required',
            'sumbu_xh' => 'required',
            'sumbu_ya' => 'required',
            'sumbu_yb' => 'required',
            'sumbu_yh' => 'required',
            'kemiringan_x' => 'required',
            'kemiringan_y' => 'required',
            'pedoman_x' => 'required',
            'pedoman_y' => 'required',
            'selisih_x' => 'required',
            'selisih_y' => 'required',
            'keterangan' => 'required',
        ]);
        
        $model = KemiringanDinding::findOrFail($id);
        $model->update([
            'candi_id' => $request->candi_id,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'titik' => $request->titik,
            'sumbu_xa' => $request->sumbu_xa,
            'sumbu_xb' => $request->sumbu_xb,
            'sumbu_xh' => $request->sumbu_xh,
            'sumbu_ya' => $request->sumbu_ya,
            'sumbu_yb' => $request->sumbu_yb,
            'sumbu_yh' => $request->sumbu_yh,
            'kemiringan_x' => $request->kemiringan_x,
            'kemiringan_y' => $request->kemiringan_y,
            'pedoman_x' => $request->pedoman_x,
            'pedoman_y' => $request->pedoman_y,
            'selisih_x' => $request->selisih_x,
            'selisih_y' => $request->selisih_y,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::user()->id,
        ]);

        return $model;
    }

    public function destroy($id)
    {
        $model = KemiringanDinding::findOrFail($id);
        $model->delete();
    }

    public function dataTableKemiringanDinding(){
        $model = KemiringanDinding::with(['candi' => function($q){
            $q->select('id', 'nama');
        }])->select('id','observasi_id', 
        DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'), 
        DB::raw('DATE_FORMAT(tanggal, "%M %Y") as bulan'),
        'lokasi', 'titik', 'kemiringan_x', 'kemiringan_y', 'selisih_x', 'selisih_y')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('kemiringan_dinding.show', $model->id),
                    'url_edit' => route('kemiringan_dinding.edit', $model->id),
                    'url_destroy' => route('kemiringan_dinding.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
