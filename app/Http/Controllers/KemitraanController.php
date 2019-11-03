<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kemitraan;
use DataTables;
use DB;
use Auth;

class KemitraanController extends Controller
{
    
    public function index()
    {
        //
    }

    public function getKemitraan($layanan){
        if($layanan == "temuan")
            return view("dssmenu.layanan_temuan");
        if($layanan == "aduan")
            return view("dssmenu.layanan_aduan");
        return view("dssmenu.layanan_kpk", compact('layanan'));

    }

    
    public function create()
    {
        $kemitraan = new Kemitraan();
        $kategori = Kemitraan::pluck('kategori', 'kategori')->toArray();
        return view('dssmenu.partials.kemitraan_form', compact('kemitraan', 'kategori'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request,[
            'mitra' => 'required',
            'koordinator' => 'required',
            'perihal' => 'required',
            'kategori' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'keterangan' => 'required',
        ]);

        $path_file = null;
        if($request->hasFile('file')){
            $path_file = "/upload/kemitraan/".str_slug($request->mitra,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/kemitraan'), $path_file);
        }

        $kemitraan = Kemitraan::create([
            'mitra' => $request->mitra,
            'koordinator' => $request->koordinator,
            'perihal' => $request->perihal,
            'kategori' => $request->kategori,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'keterangan' => $request->keterangan,
            'file' => $path_file
        ]);

        
        return $kemitraan;
    }

    
    public function show($id)
    {
        $kemitraan = Kemitraan::findOrFail($id);
        return view('dssmenu.detail_kemitraan', compact('kemitraan'));
    }

    
    public function edit($id)
    {
        $kemitraan = Kemitraan::findOrFail($id);
        $kategori = Kemitraan::pluck('kategori', 'kategori')->toArray();
        return view('dssmenu.partials.kemitraan_form', compact('kemitraan', 'kategori'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'mitra' => 'required',
            'koordinator' => 'required',
            'perihal' => 'required',
            'kategori' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'keterangan' => 'required',
        ]);

        $kemitraan = Kemitraan::findOrFail($id);
        $input = $request->all();
        $input['file'] = $kemitraan->file;

        if($request->hasFile('file')){
            if($kemitraan->file != NULL){
                unlink(public_path($kemitraan->file));
            }
            $input['file'] = "/upload/kemitraan/".str_slug($request->mitra,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/kemitraan'), $input['file']);
        }

        $kemitraan->update([
            'mitra' => $request->mitra,
            'koordinator' => $request->koordinator,
            'perihal' => $request->perihal,
            'kategori' => $request->kategori,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'keterangan' => $request->keterangan,
            'file' => $input['file']
        ]);
    }

   
    public function destroy($id)
    {
        $kemitraan = Kemitraan::findOrFail($id);
        if(!empty($kemitraan->file))
            unlink(public_path($kemitraan->file));
        $kemitraan->delete();
    }

    public function dataTableKemitraan(){
        $model = Kemitraan::select('id','mitra', 'perihal', 'kategori', 
            DB::raw('DATE_FORMAT(mulai, "%d-%m-%Y") as mulai'), 
            DB::raw('DATE_FORMAT(selesai, "%d-%m-%Y") as selesai'),
            DB::raw('DATE_FORMAT(mulai, "%Y") as tahun'))->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('kemitraan.show', $model->id),
                    'url_edit' => route('kemitraan.edit', $model->id),
                    'url_destroy' => route('kemitraan.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}