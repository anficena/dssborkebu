<?php

namespace App\Http\Controllers;

use App\MonevPemanfaatan;
use App\Candi;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class MonevPemanfaatanController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_monev_pemanfaatan');
    }

    public function create()
    {
        $model = new MonevPemanfaatan();
        $cagar = Candi::pluck('nama','id')->toArray();
        return view('dssmenu.monev_lingkungan.monev_pemanfaatan_form', compact('model', 'cagar'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'judul' => 'required',
            'tujuan' => 'required',
            'sasaran' => 'required',
            'target' => 'required',
            'metode' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'hasil' => 'required'
        ]);
        
        $path_file = null;
        if($request->hasFile('file')){
            $path_file = "/upload/monev_pemanfaatan/".str_slug($request->judul,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/monev_pemanfaatan'), $path_file);
        }

        $model = MonevPemanfaatan::create([
            'candi_id' => $request->candi_id,
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'tujuan' => $request->tujuan,
            'sasaran' => $request->sasaran,
            'target' => $request->target,
            'metode' => $request->metode,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'hasil' => $request->hasil,
            'file' => $path_file
        ]);

        return $model;
    }

    public function show($id)
    {
        $model = MonevPemanfaatan::where('id', $id)->with(['candi' => function($q){
            $q->select('id','nama');
        }])->get();
        return view('dssmenu.monev_lingkungan.detail_monev_lingkungan', compact('model'));
    }
    
    public function edit($id)
    {
        $model = MonevPemanfaatan::findOrFail($id);
        $cagar = Candi::pluck('nama','id')->toArray();
        return view('dssmenu.monev_lingkungan.monev_pemanfaatan_form', compact('model', 'cagar'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'judul' => 'required',
            'tujuan' => 'required',
            'sasaran' => 'required',
            'target' => 'required',
            'metode' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'hasil' => 'required'
        ]);

        $model = MonevPemanfaatan::findOrFail($id);
        $input = $request->all();
        $input['file'] = $model->file;

        if($request->hasFile('file')){
            if($model->file != NULL){
                unlink(public_path($model->file));
            }
            $input['file'] = "/upload/monev_pemanfaatan/".str_slug($request->judul,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/monev_pemanfaatan'), $input['file']);
        }

        $model->update([
            'candi_id' => $request->candi_id,
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'tujuan' => $request->tujuan,
            'sasaran' => $request->sasaran,
            'target' => $request->target,
            'metode' => $request->metode,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'hasil' => $request->hasil,
            'file' => $input['file']
        ]);

        return $model;
    }

    public function destroy($id)
    {
        $model = MonevPemanfaatan::findOrFail($id);
        if(!empty($model->file))
            unlink(public_path($model->file));
        $model->delete();
    }

    public function dataTableMonevPemanfaatan(){
        $model = MonevPemanfaatan::with(['candi' => function($q){
            $q->select('id', 'nama');
        }])->select('id','candi_id', 'judul',  DB::raw('DATE_FORMAT(mulai, "%d-%m-%Y") as mulai'),
        DB::raw('DATE_FORMAT(selesai, "%d-%m-%Y") as selesai'), 
        DB::raw('DATE_FORMAT(mulai, "%Y") as tahun'))->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('monev_pemanfaatan.show', $model->id),
                    'url_edit' => route('monev_pemanfaatan.edit', $model->id),
                    'url_destroy' => route('monev_pemanfaatan.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}

