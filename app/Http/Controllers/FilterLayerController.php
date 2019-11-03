<?php

namespace App\Http\Controllers;

use App\FilterLayer;
use App\MonevGeohidrologi;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class FilterLayerController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_filter_layer');
    }

    public function create()
    {
        $model = new FilterLayer();
        $observasi = MonevGeohidrologi::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.filter_layer_form', compact('model', 'observasi'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required'
        ]);
        
        $path_file = null;
        if($request->hasFile('photo')){
            $path_file = "/upload/filter_layer/".str_slug($request->waktu,'-').'-'.str_slug($request->lokasi,'-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/filter_layer'), $path_file);
        }

        $model = FilterLayer::create([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'photo' => $path_file
        ]);

        return $model;
    }

    public function show($id)
    {
        $model = FilterLayer::findOrFail($id);
        return view('dssmenu.monev_lingkungan.detail_filter_layer', compact('model'));
    }
    
    public function edit($id)
    {
        $model = FilterLayer::findOrFail($id);
        $observasi = MonevGeohidrologi::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.filter_layer_form', compact('model', 'observasi'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required'
        ]);

        $model = FilterLayer::findOrFail($id);
        $input = $request->all();
        $input['photo'] = $model->photo;

        if($request->hasFile('photo')){
            if($model->photo != NULL){
                unlink(public_path($model->photo));
            }
            $input['photo'] = "/upload/filter_layer/".str_slug($request->waktu,'-').'-'.str_slug($request->lokasi,'-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/filter_layer'), $input['photo']);
        }

        $model->update([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'photo' => $input['photo']
        ]);
        return $model;
    }

    public function destroy($id)
    {
        $model = FilterLayer::findOrFail($id);
        if(!empty($model->photo))
            unlink(public_path($model->photo));
        $model->delete();
    }

    public function dataTableFilterLayer(){
        $model = FilterLayer::with(['monev_geohidrologi' => function($q){
            $q->select('id', 'judul');
        }])->select('id','observasi_id', 
        DB::raw('DATE_FORMAT(waktu, "%d-%m-%Y") as tanggal'),
        DB::raw('DATE_FORMAT(waktu, "%M-%Y") as bulan'), 'lokasi', 'photo')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('filter_layer.show', $model->id),
                    'url_edit' => route('filter_layer.edit', $model->id),
                    'url_destroy' => route('filter_layer.destroy', $model->id)
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
