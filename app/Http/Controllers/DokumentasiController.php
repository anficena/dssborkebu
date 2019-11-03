<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dokumentasi;
use App\Mow;
use DataTables;
use DB;
use Auth;

class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokumentasi = Dokumentasi::select('id','judul','thumbnail','kategori',DB::raw('count(id) as total'))
            ->groupBy('kategori')
            ->orderBy('created_at','desc')
            ->get();
        return view('dssmenu.dokumentasi',compact('dokumentasi'));
    }

    public function kategori($params){
        $dokumentasi = Dokumentasi::select('id','judul','thumbnail','kategori',DB::raw('count(id) as total'))
            ->where('kategori',$params)
            ->orderBy('created_at','desc')
            ->get();
        return view('dssmenu.partials.dokumentasi_content',compact('dokumentasi'));
        // return response()->json($dokumentasi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dokumentasi = new Dokumentasi();
        $data = Dokumentasi::pluck('kategori','kategori')->toArray();
        return view("dssmenu.partials.dokumentasi_form", compact('dokumentasi','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'kategori' => 'required',
            'thumbnail' => 'mimes:jpeg,jpg,png|max:10000',
            'keterangan' => 'required'
        ]);

        $path_file = array();
        $path_file[0] = "";
        $path_file[1] = "";

        // if($request->hasFile('file')){
        //     $thumbnail = "";
        //     for($i = 0; $i <= count($request->file) - 1; $i++){
        //         if($i == 0)
        //             $path_file[$i] = "/upload/dokumentasi/".str_slug($request->judul,'-')."-thumbnail-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
        //         else
        //             $path_file[$i] = "/upload/dokumentasi/".str_slug($request->judul,'-')."-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
        //         $request->file[$i]->move(public_path('upload/dokumentasi'), $path_file[$i]);
        //     }
        // }

        $path_thumbnail = null;
        if($request->hasFile('thumbnail')){
            $path_thumbnail = "/upload/dokumentasi/".'thumbnail-'.str_slug($request->judul,'-')."-".date("d-m-Y").'.'.$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path('upload/dokumentasi'), $path_thumbnail);
        }
        $path_file = null;
        if($request->hasFile('file')){
            $path_file = "/upload/dokumentasi/".str_slug($request->judul,'-')."-".date("d-m-Y").'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/dokumentasi'), $path_file);
        }

        $model = Dokumentasi::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'thumbnail' => $path_thumbnail,
            'link' => $request->link,
            'file' => $path_file,
            'keterangan' => $request->keterangan,
            'uploader' =>Auth::user()->name
        ]);

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokumentasi = Dokumentasi::findOrFail($id);
        return view("dssmenu.detail_dokumentasi", compact('dokumentasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumentasi = Dokumentasi::findOrFail($id);
        $data = Dokumentasi::pluck('kategori','kategori')->toArray();
        return view("dssmenu.partials.dokumentasi_form", compact('dokumentasi','data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'judul' => 'required',
            'kategori' => 'required',
            'thumbnail' => 'mimes:jpeg,jpg,png|max:10000',
            'keterangan' => 'required'
        ]);

        $dokumentasi = Dokumentasi::findOrFail($id);
        // $input = $request->all();
        // $input['file'] = $dokumentasi->file;
        $path_file = array();
        $path_file[0] = $dokumentasi->thumbnail;
        $path_file[1] = $dokumentasi->file;

        // if($request->hasFile('file')){
        //     if($dokumentasi->thumbnail != NULL)
        //         unlink(public_path($dokumentasi->thumbnail));
        //     if($dokumentasi->file != NULL)
        //         unlink(public_path($dokumentasi->file));
        //     for($i = 0; $i <= count($request->file) - 1; $i++){
        //         if($i == 0)
        //             $path_file[$i] = "/upload/dokumentasi/".str_slug($request->judul,'-')."-thumbnail-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
        //         else
        //             $path_file[$i] = "/upload/dokumentasi/".str_slug($request->judul,'-')."-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
        //         // $input[$i]['file'] = "/upload/dokumentasi/".str_slug($request->judul[$i],'-').'.'.$request->file[$i]->getClientOriginalExtension();
        //         $request->file[$i]->move(public_path('upload/dokumentasi'), $path_file[$i]);
        //     }
        // }
        $model = Dokumentasi::findOrFail($id);
        $input = $request->all();
        $input['file'] = $model->file;
        $input['thumbnail'] = $model->thumbnail;

        if($request->hasFile('file')){
            if($model->file != NULL){
                unlink(public_path($model->file));
            }
            $input['file'] = "/upload/dokumentasi/".str_slug($request->judul,'-')."-".date("d-m-Y").'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/dokumentasi'), $input['file']);
        }

        if($request->hasFile('thumbnail')){
            if($model->thumbnail != NULL){
                unlink(public_path($model->thumbnail));
            }
            $input['thumbnail'] = "/upload/dokumentasi/"."thumbnail-".str_slug($request->judul,'-')."-".date("d-m-Y").'.'.$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path('upload/dokumentasi'), $input['thumbnail']);
        }

        $dokumentasi->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'thumbnail' => $input['thumbnail'],
            'link' => $request->link,
            'file' => $input['file'],
            'keterangan' => $request->keterangan,
            'uploader' =>Auth::user()->name
        ]);

        return $dokumentasi;
    }

    public function destroy($id)
    {
        $dokumentasi = Dokumentasi::findOrFail($id);
        if(!empty($dokumentasi->file))
            unlink(public_path($dokumentasi->file));
        if(!empty($dokumentasi->thumbnail))
            unlink(public_path($dokumentasi->thumbnail));
        $dokumentasi->mow()->delete();
        $dokumentasi->delete();
    }

    public function dataTableDokumentasi(){
        $model = Dokumentasi::select('id',
        DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as tanggal'), 
        DB::raw('DATE_FORMAT(created_at, "%Y") as tahun'), 
        'judul', 'kategori')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('dokumentasi.show', $model->id),
                    'url_edit' => route('dokumentasi.edit', $model->id),
                    'url_destroy' => route('dokumentasi.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
