<?php

namespace App\Http\Controllers;

use App\TitikKontrol;
use App\Candi;
use App\Imports\TitikKontrolImport;
use Excel;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class TitikKontrolController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_stabilitas.kelola_titik_kontrol');
    }

    public function create()
    {
        $model = new TitikKontrol();
        $cagar = Candi::pluck('nama','id')->toArray();
        return view('dssmenu.monev_stabilitas.titik_kontrol_form', compact('model', 'cagar'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'tanggal' => 'required',
            'nama_koordinat' => 'required',
            'titik' => 'required',
            'sumbu_x' => 'required',
            'sumbu_y' => 'required',
            'sumbu_z' => 'required',
        ]);
        
        $model = TitikKontrol::create([
            'candi_id' => $request->candi_id,
            'tanggal' => $request->tanggal,
            'nama_koordinat' => $request->nama_koordinat,
            'titik' => $request->titik,
            'sumbu_x' => $request->sumbu_x,
            'sumbu_y' => $request->sumbu_y,
            'sumbu_z' => $request->sumbu_z,
            'user_id' => Auth::user()->id,
        ]);

        return $model;
    }

    public function import(){
        return view("dssmenu.import.import_titik_kontrol");
    }

    public function importStore(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand().$file->getClientOriginalName();

        $file->move('import/titik_kontrol/',$nama_file);

        Excel::import(new TitikKontrolImport, public_path('/import/titik_kontrol/'.$nama_file));
    }

    public function show($id)
    {
        $model = TingkatPengunjung::findOrFail($id);
        return view('dssmenu.monev_lingkungan.tingkat_pengunjung_form', compact('model'));
    }
    
    public function edit($id)
    {
        $model = TitikKontrol::findOrFail($id);
        $cagar = Candi::pluck('nama','id')->toArray();
        return view('dssmenu.monev_stabilitas.titik_kontrol_form', compact('model', 'cagar'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'tanggal' => 'required',
            'nama_koordinat' => 'required',
            'titik' => 'required',
            'sumbu_x' => 'required',
            'sumbu_y' => 'required',
            'sumbu_z' => 'required',
        ]);
        
        $model = TitikKontrol::findOrFail($id);
        $model->update([
            'candi_id' => $request->candi_id,
            'tanggal' => $request->tanggal,
            'nama_koordinat' => $request->nama_koordinat,
            'titik' => $request->titik,
            'sumbu_x' => $request->sumbu_x,
            'sumbu_y' => $request->sumbu_y,
            'sumbu_z' => $request->sumbu_z,
            'user_id' => Auth::user()->id,
        ]);

        return $model;
    }

    public function destroy($id)
    {
        $model = TitikKontrol::findOrFail($id);
        $model->delete();
    }

    public function dataTableTitikKontrol(){
        $model = TitikKontrol::with(['candi' => function($q){
            $q->select('id', 'nama');
        }])->select('id','observasi_id', 
            DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'), 
            DB::raw('DATE_FORMAT(tanggal, "%Y") as tahun'),
            'nama_koordinat', 'titik', 'sumbu_x', 'sumbu_y', 'sumbu_z')
            ->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('titik_kontrol.show', $model->id),
                    'url_edit' => route('titik_kontrol.edit', $model->id),
                    'url_destroy' => route('titik_kontrol.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
