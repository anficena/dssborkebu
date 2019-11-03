<?php

namespace App\Http\Controllers;

use App\MonevStabilitas;
use App\Candi;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

class MonevStabilitasController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_stabilitas.kelola_monev_stabilitas');
    }

    public function create()
    {
        $model = new MonevStabilitas();
        $cagar = Candi::pluck('nama','id')->toArray();
        return view('dssmenu.monev_stabilitas.monev_stabilitas_form', compact('model','cagar'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'judul' => 'required',
            'tanggal' => 'required'
        ]);
        
        $path_file = array();
        $path_file[0] = "";
        $path_file[1] = "";
        $path_file[2] = "";
        $path_file[3] = "";
        $path_file[4] = "";
        $path_file[5] = "";

        if($request->hasFile('file')){
            for($i = 0; $i <= count($request->file) - 1; $i++){
                if($i == 0)
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-pengertian-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
                elseif($i == 1)
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-spesifikasi-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
                elseif($i == 2)
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-pedoman-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
                elseif($i == 3)
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-photo-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
                elseif($i == 4)
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-gambar_kerja-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
                elseif($i == 5)
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-referesni-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension(); 
                $request->file[$i]->move(public_path('upload/monev_stabilitas'), $path_file[$i]);
            }
        }

        $model = MonevStabilitas::create([
            'candi_id' => $request->candi_id,
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'pengertian' => $path_file[0],
            'spesifikasi' => $path_file[1],
            'pedoman' => $path_file[2],
            'photo' => $path_file[3],
            'gambar_kerja' => $path_file[4],
            'referensi' => $path_file[5]
        ]);
        
        return $model;
    }

    public function show(MonevStabilitas $monevStabilitas)
    {
        //
    }

    public function edit($id)
    {
        $model = MonevStabilitas::findOrFail($id);
        $cagar = Candi::pluck('nama','id')->toArray();
        $file_text = array();
        $file_text[0] = $model->pengertian;
        $file_text[1] = $model->spesifikasi;
        $file_text[2] = $model->pedoman;
        $file_text[3] = $model->photo;
        $file_text[4] = $model->gambar_kerja;
        $file_text[5] = $model->referensi;
        // return response()->json($file_text);
        return view('dssmenu.monev_stabilitas.monev_stabilitas_form', compact('file_text', 'model', 'cagar'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'judul' => 'required',
            'tanggal' => 'required'
        ]);

        $model = MonevStabilitas::findOrFail($id);

        $path_file = array();
        $path_file[0] = $model->pengertian;
        $path_file[1] = $model->spesifikasi;
        $path_file[2] = $model->pedoman;
        $path_file[3] = $model->photo;
        $path_file[4] = $model->gambar_kerja;
        $path_file[5] = $model->referensi;

        
        // $path_file[0] = $model->pengertian;
        // $input['file'][1] = $model->spesifikasi;
        // $input['file'][2] = $model->pedoman;
        // $input['file'][3] = $model->photo;
        // $input['file'][4] = $model->gambar_kerja;
        // $input['file'][5] = $model->referensi;
        
        for($i = 0; $i <= 5; $i++){
            if(!empty($request->file[$i])){
                if($i == 0){
                    if($model->pengertian != NULL)
                        unlink(public_path($model->pengertian));
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-pengertian-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
                }
                if($i == 1){
                    if($model->spesifikasi != NULL)
                        unlink(public_path($model->spesifikasi));
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-spesifikasi-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
                }
                if($i == 2){
                    if($model->pedoman != NULL)
                        unlink(public_path($model->pedoman));
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-pedoman-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
                }
                if($i == 3){
                    if($model->photo != NULL)
                        unlink(public_path($model->photo));
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-photo-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
                }
                if($i == 4){
                    if($model->gambar_kerja != NULL)
                        unlink(public_path($model->gambar_kerja));
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-gambar_kerja-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
                }
                if($i == 5){
                    if($model->referesni != NULL){
                        unlink(public_path($model->referesni));
                    }
                    $path_file[$i] = "/upload/monev_stabilitas/".str_slug($request->judul,'-')."-referensi-".date("d-m-Y").'.'.$request->file[$i]->getClientOriginalExtension();
                }
                $request->file[$i]->move(public_path('upload/monev_stabilitas'), $path_file[$i]);
            }
        }

        $model->update([
            'candi_id' => $request->candi_id,
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'pengertian' => $path_file[0],
            'spesifikasi' => $path_file[1],
            'pedoman' => $path_file[2],
            'photo' => $path_file[3],
            'gambar_kerja' => $path_file[4],
            'referensi' => $path_file[5]
        ]);

        return $model;
    }

    public function destroy($id)
    {
        $model = MonevStabilitas::findOrFail($id);
        if(!empty($model->pengertian))
            unlink(public_path($model->pengertian));
        if(!empty($model->spesifikasi))
            unlink(public_path($model->spesifikasi));
        if(!empty($model->pedoman))
            unlink(public_path($model->pedoman));
        if(!empty($model->photo))
            unlink(public_path($model->photo));
        if(!empty($model->gambar_kerja))
            unlink(public_path($model->gambar_kerja));
        if(!empty($model->referensi))
            unlink(public_path($model->referensi));
        $model->delete();
    }

    public function dataTableMonevStabilitas(){
        $model = MonevStabilitas::with(['candi' => function($q){
            $q->select('id', 'nama');
        }])->select('id', 'candi_id', 'judul', 
            DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'),
            DB::raw('YEAR(tanggal) as tahun'),
            'pengertian', 'spesifikasi', 'pedoman', 'photo', 'gambar_kerja', 'referensi')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('monev_stabilitas.show', $model->id),
                    'url_edit' => route('monev_stabilitas.edit', $model->id),
                    'url_destroy' => route('monev_stabilitas.destroy', $model->id)
                ]);
            })
            ->addColumn('lampiran', function($model){
                $lampiran = '
                    <ol>
                        <li><a href="'.$model->pengertian.'" ><i class="fa fa-fw fa-file-o"></i>Pengertian</a></li>
                        <li><a href="'.$model->spesifikasi.'" ><i class="fa fa-fw fa-file-o"></i>Spesifikasi dan Alat Kerja</a></li>
                        <li><a href="'.$model->pedoman.'" ><i class="fa fa-fw fa-file-o"></i>Pedoman Pengukuran</a></li>
                        <li><a href="'.$model->photo.'" ><i class="fa fa-fw fa-file-o"></i>Foto Kegiatan</a></li>
                        <li><a href="'.$model->gambar_kerja.'" ><i class="fa fa-fw fa-file-o"></i>Gambar Kerja</a></li>
                        <li><a href="'.$model->referensi.'" ><i class="fa fa-fw fa-file-o"></i>Referesni dan Acuan</a></li>
                    </ol>
                ';
                return $lampiran;
            })
            ->addIndexColumn()
            ->rawColumns(['lampiran', 'action'])
            ->toJson();
    }
}
