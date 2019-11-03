<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelayanan;
use DataTables;
use DB;
use Auth;

class PelayananController extends Controller
{
    public function index()
    {
        //
    }


    public function create()
    {
        $pelayanan = new Pelayanan();
        return view("dssmenu.partials.pelayanan_form", compact('pelayanan'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'perihal' => 'required',
            'pengirim' => 'required',
            'penerima' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        $path_file = null;
        if($request->hasFile('file')){
            $path_file = "/upload/pelayanan/".str_slug($request->perihal,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/pelayanan'), $path_file);
        }

        $pelayanan = Pelayanan::create([
            'perihal' => $request->perihal,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'file' => $path_file
        ]);

        
        return $pelayanan;
    }

    public function show($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        return view('dssmenu.detail_pelayanan', compact('pelayanan'));
    }

    public function edit($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        return view("dssmenu.partials.pelayanan_form", compact('pelayanan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'perihal' => 'required',
            'pengirim' => 'required',
            'penerima' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        $pelayanan = Pelayanan::findOrFail($id);
        $input = $request->all();
        $input['file'] = $pelayanan->file;

        if($request->hasFile('file')){
            if($pelayanan->file != NULL){
                unlink(public_path($pelayanan->file));
            }
            $input['file'] = "/upload/pelayanan/".str_slug($request->perihal,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/pelayanan'), $input['file']);
        }

        $pelayanan->update([
            'perihal' => $request->perihal,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'file' => $input['file']
        ]);
    }

    public function destroy($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        if(!empty($pelayanan->file))
            unlink(public_path($pelayanan->file));
        $pelayanan->delete();
    }

    public function dataTablePelayanan(){
        $model = Pelayanan::select('id',DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'), 
        DB::raw('DATE_FORMAT(tanggal, "%M %Y") as bulan'), 'perihal', 'pengirim', 'penerima', 'status')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('pelayanan.show', $model->id),
                    'url_edit' => route('pelayanan.edit', $model->id),
                    'url_destroy' => route('pelayanan.destroy', $model->id)
                ]);
            })
            ->addColumn('status_pelayanan', function($model){
                $status="";
                if($model->status=="selesai")
                   $status = '<span class="badge badge-success">SELESAI</span>';
                else
                   $status = '<span class="badge badge-danger">GAGAL</span>';
                return $status;
            })
            ->addIndexColumn()
            ->rawColumns(['action','status_pelayanan'])
            ->toJson();
    }
}
