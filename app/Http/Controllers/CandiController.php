<?php

namespace App\Http\Controllers;

use App\Candi;
use Illuminate\Http\Request;
use DataTables;
use DB;

class CandiController extends Controller
{
    public function index()
    {
        $model = Candi::pluck('id','nama')->toArray();
        return response()->json($model);
    }

    public function create()
    {
        $kawasan = new Candi();
        return view("dssmenu.partials.kawasan_form", compact('kawasan'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);
        
        $path_file = null;
        if($request->hasFile('file')){
            $path_file = "/upload/kawasan/".str_slug($request->nama,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/kawasan'), $path_file);
        }

        $model = Candi::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'file' => $path_file
        ]);

        return $model;
    }

    public function show(candi $candi)
    {
        //
    }

    public function edit($id)
    {
        $kawasan = Candi::findOrFail($id);
        return view("dssmenu.partials.kawasan_form", compact('kawasan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);

        $candi = Candi::findOrFail($id);
        $input = $request->all();
        $input['file'] = $candi->file;

        if($request->hasFile('file')){
            if($candi->file != NULL){
                unlink(public_path($candi->file));
            }
            $input['file'] = "/upload/kawasan/".str_slug($request->nama,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/kawasan'), $input['file']);
        }

        $candi->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'file' => $input['file']
        ]);

        return $candi;
    }

    public function destroy($id)
    {
        $candi = Candi::findOrFail($id);
        if(!empty($candi->file))
            unlink(public_path($candi->file));
        $candi->delete();
    }

    public function dataTableKawasan(){
        $model = Candi::select('id','nama', 'alamat', 'keterangan', 'file')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('kawasan.show', $model->id),
                    'url_edit' => route('kawasan.edit', $model->id),
                    'url_destroy' => route('kawasan.destroy', $model->id)
                ]);
            })
            ->addColumn('file', function($model){
                $photo = null;
                if(!empty($model->file))
                    return '<a href="'.$model->file.'" ><i class="fa fa-fw fa-image"></i>Preview</a>';
                else
                    return '<span class="badge badge-danger">Tidak Ada</span>';
            })
            ->addIndexColumn()
            ->rawColumns(['action','file'])
            ->toJson();
    }
}
