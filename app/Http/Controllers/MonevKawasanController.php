<?php

namespace App\Http\Controllers;

use App\MonevKawasan;
use App\Candi;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class MonevKawasanController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_monev_kawasan');
    }

    public function create()
    {
        $model = new MonevKawasan();
        $cagar = Candi::pluck('nama','id')->toArray();
        return view('dssmenu.monev_lingkungan.monev_kawasan_form', compact('model', 'cagar'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'judul' => 'required',
            'tanggal' => 'required',
            'instansi' => 'required',
            'keterangan' => 'required'
        ]);
        
        $path_file = null;
        if($request->hasFile('file')){
            $path_file = "/upload/monev_kawasan/".str_slug($request->tanggal,'-').'-'.str_slug($request->instansi,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/monev_kawasan'), $path_file);
        }

        $model = MonevKawasan::create([
            'candi_id' => $request->candi_id,
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'instansi' => $request->instansi,
            'keterangan' => $request->keterangan,
            'file' => $path_file
        ]);

        return $model;
    }

    public function show($id)
    {
        $model = MonevKawasan::findOrFail($id);
        return view('dssmenu.monev_lingkungan.detail_monev_kawasan', compact('model'));
    }
    
    public function edit($id)
    {
        $model = MonevKawasan::findOrFail($id);
        $cagar = Candi::pluck('nama','id')->toArray();
        return view('dssmenu.monev_lingkungan.monev_kawasan_form', compact('model', 'cagar'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'judul' => 'required',
            'tanggal' => 'required',
            'instansi' => 'required',
            'keterangan' => 'required'
        ]);

        $model = MonevKawasan::findOrFail($id);
        $input = $request->all();
        $input['file'] = $model->file;

        if($request->hasFile('file')){
            if($model->file != NULL){
                unlink(public_path($model->file));
            }
            $input['file'] = "/upload/monev_kawasan/".str_slug($request->tanggal,'-').'-'.str_slug($request->instansi,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/monev_kawasan'), $input['file']);
        }

        $model->update([
            'candi_id' => $request->candi_id,
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'instansi' => $request->instansi,
            'keterangan' => $request->keterangan,
            'file' => $input['file']
        ]);

        return $model;
    }

    public function destroy($id)
    {
        $model = MonevKawasan::findOrFail($id);
        if(!empty($model->file))
            unlink(public_path($model->file));
        $model->delete();
    }

    public function dataTableMonevKawasan(){
        $model = MonevKawasan::with(['candi' => function($q){
            $q->select('id', 'nama');
        }])->select('id','candi_id', 'judul', 
        DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'),
        DB::raw('DATE_FORMAT(tanggal, "%Y") as tahun'), 'instansi')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('monev_kawasan.show', $model->id),
                    'url_edit' => route('monev_kawasan.edit', $model->id),
                    'url_destroy' => route('monev_kawasan.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
