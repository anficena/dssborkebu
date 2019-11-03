<?php

namespace App\Http\Controllers;

use App\SumurResapan;
use App\MonevGeohidrologi;
use App\Imports\SumurResapanImport;
use Excel;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class SumurResapanController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_kedalaman_resapan');
    }

    public function getKategori(){
        $tahun = SumurResapan::select(DB::raw('Year(waktu) tahun'))
                ->groupBy('tahun')
                ->get();
        return response()->json(['tahun' => $tahun]);
    }

    public function chart($start, $end){
        $lokasi = SumurResapan::select('lokasi')->groupBy('lokasi')->get();
        $tahun = SumurResapan::select(DB::raw('YEAR(waktu) tahun'),
                DB::raw('MONTH(waktu) month_number'),
                DB::raw('DATE_FORMAT(waktu, "%M-%Y") month'),
                'lokasi', 'kedalaman')
                ->whereBetween(DB::raw('YEAR(waktu)'), [$start, $end])
                ->groupBY('tahun','month_number','lokasi')
                ->orderBy('tahun','asc')
                ->orderBy('month_number','desc')
                ->get();

        for($i = 0; $i <= count($lokasi) - 1; $i++){
            $data = array();
            
            for($j = 0; $j <= count($tahun) - 1; $j++){
                if($lokasi[$i]->lokasi == $tahun[$j]->lokasi)
                     $data[$j] = [$tahun[$j]->month, $tahun[$j]->kedalaman];
            }
            $lokasi[$i]->kedalaman = array_values($data);
        }
        // foreach($lokasi as $l){
        //     foreach($tahun as $t){
        //         $l->kedalaman = $t->kedalaman;
        //     }
        // }
        // $lokasi = array_merge($lokasi, ['kedalaman' => $tahun]);
        // for($i = 0; count($lokasi[0]->kedalaman); $i++)
        //     dd($lokasi[0]->kedalaman[1]);
        // $object = json_decode(json_encode($data->));
        return response()->json($lokasi);
    }

    public function create()
    {
        $model = new SumurResapan();
        $observasi = MonevGeohidrologi::pluck('judul','id')->toArray();
        $tempat = SumurResapan::pluck('lokasi','lokasi')->toArray();
        return view('dssmenu.monev_lingkungan.kedalaman_resapan_form', compact('model', 'observasi', 'tempat'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'kedalaman' => 'required',
            'kondisi' => 'required'
        ]);
        
        $path_file = null;
        if($request->hasFile('photo')){
            $path_file = "/upload/kedalaman_resapan/".str_slug($request->waktu,'-').'-'.str_slug($request->lokasi,'-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/kedalaman_resapan'), $path_file);
        }

        $model = SumurResapan::create([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'kedalaman' => $request->kedalaman,
            'kondisi' => $request->kondisi,
            'photo' => $path_file
        ]);

        return $model;
    }

    public function import(){
        return view("dssmenu.import.import_kedalaman_resapan");
    }

    public function importStore(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand().$file->getClientOriginalName();

        $file->move('import/kedalaman_resapan/',$nama_file);

        Excel::import(new SumurResapanImport, public_path('/import/kedalaman_resapan/'.$nama_file));
    }

    public function show($id)
    {
        $model = SumurResapan::findOrFail($id);
        return view('dssmenu.monev_lingkungan.detail_kedalaman_resapan', compact('model'));
    }
    
    public function edit($id)
    {
        $model = SumurResapan::findOrFail($id);
        $observasi = MonevGeohidrologi::pluck('judul','id')->toArray();
        $tempat = SumurResapan::pluck('lokasi','lokasi')->toArray();
        return view('dssmenu.monev_lingkungan.kedalaman_resapan_form', compact('model', 'observasi', 'tempat'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'kedalaman' => 'required',
            'kondisi' => 'required'
        ]);

        $model = SumurResapan::findOrFail($id);
        $input = $request->all();
        $input['photo'] = $model->photo;

        if($request->hasFile('photo')){
            if($model->photo != NULL){
                unlink(public_path($model->photo));
            }
            $input['photo'] = "/upload/kedalaman_resapan/".str_slug($request->waktu,'-').'-'.str_slug($request->lokasi,'-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/kedalaman_resapan'), $input['photo']);
        }

        $model->update([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'kedalaman' => $request->kedalaman,
            'kondisi' => $request->kondisi,
            'photo' => $input['photo']
        ]);

        return $model;
    }

    public function destroy($id)
    {
        $model = SumurResapan::findOrFail($id);
        if(!empty($model->photo))
            unlink(public_path($model->photo));
        $model->delete();
    }

    public function dataTableKedalamanSumurResapan(){
        $model = SumurResapan::with(['monev_geohidrologi' => function($q){
            $q->select('id', 'judul');
        }])->select('id','observasi_id',
        DB::raw('DATE_FORMAT(waktu, "%d-%m-%Y") as tanggal'),
        DB::raw('DATE_FORMAT(waktu, "%M-%Y") as bulan'), 'lokasi', 'kedalaman')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('kedalaman_resapan.show', $model->id),
                    'url_edit' => route('kedalaman_resapan.edit', $model->id),
                    'url_destroy' => route('kedalaman_resapan.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
