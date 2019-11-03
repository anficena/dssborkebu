<?php

namespace App\Http\Controllers;

use App\WaterMater;
use App\MonevGeohidrologi;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class WaterMaterController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_water_mater');
    }

    public function create()
    {
        $model = new WaterMater();
        $observasi = MonevGeohidrologi::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.water_mater_form', compact('model', 'observasi'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'wmk' => 'required',
            'wmb' => 'required',
            'keterangan' => 'required'
        ]);
        
        $path_file = null;
        if($request->hasFile('photo')){
            $path_file = "/upload/water_mater/".str_slug($request->waktu,'-').'-'.str_slug($request->lokasi,'-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/water_mater'), $path_file);
        }

        $model = WaterMater::create([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'wmk' => $request->wmk,
            'wmb' => $request->wmb,
            'keterangan' => $request->keterangan,
            'photo' => $path_file
        ]);

        return $model;
    }

    public function show($id)
    {
        $model = WaterMater::findOrFail($id);
        return view('dssmenu.monev_lingkungan.detail_water_mater', compact('model'));
    }
    
    public function edit($id)
    {
        $model = WaterMater::findOrFail($id);
        $observasi = MonevGeohidrologi::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.water_mater_form', compact('model', 'observasi'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'wmk' => 'required',
            'wmb' => 'required',
            'keterangan' => 'required'
        ]);

        $model = WaterMater::findOrFail($id);
        $input = $request->all();
        $input['photo'] = $model->photo;

        if($request->hasFile('photo')){
            if($model->photo != NULL){
                unlink(public_path($model->photo));
            }
            $input['photo'] = "/upload/water_mater/".str_slug($request->waktu,'-').'-'.str_slug($request->lokasi,'-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/water_mater'), $input['photo']);
        }

        $model->update([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'wmk' => $request->wmk,
            'wmb' => $request->wmb,
            'keterangan' => $request->keterangan,
            'photo' => $input['photo']
        ]);
        return $model;
    }

    public function destroy($id)
    {
        $model = WaterMater::findOrFail($id);
        if(!empty($model->photo))
            unlink(public_path($model->photo));
        $model->delete();
    }

    public function dataTableWaterMater(){
        $model = WaterMater::with(['monev_geohidrologi' => function($q){
            $q->select('id', 'judul');
        }])->select('id','observasi_id', 
        DB::raw('DATE_FORMAT(waktu, "%d-%m-%Y") as tanggal'),
        DB::raw('DATE_FORMAT(waktu, "%M-%Y") as bulan'), 'lokasi', 'wmk', 'wmb', 'photo')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('water_mater.show', $model->id),
                    'url_edit' => route('water_mater.edit', $model->id),
                    'url_destroy' => route('water_mater.destroy', $model->id)
                ]);
            })
            ->addColumn('photo', function($model){
                $photo = null;
                if(!empty($model->photo))
                    return '<a href="'.$model->photo.'" ><i class="fa fa-fw fa-image"></i>Preview</a>';
                else
                    return '<span class="badge badge-danger">Tidak Ada</span>';
            })
            ->addIndexColumn()
            ->rawColumns(['photo','action'])
            ->toJson();
    }
}
