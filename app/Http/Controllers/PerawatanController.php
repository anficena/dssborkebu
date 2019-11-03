<?php

namespace App\Http\Controllers;

use App\Perawatan;
use App\Candi;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

class PerawatanController extends Controller
{
    public function index()
    {
        return view('dssmenu.perawatan');
    }

    public function create()
    {
        $model = new Perawatan();
        $candi = Candi::pluck('nama','id')->toArray();
        $kategori = Perawatan::pluck('kategori','kategori')->toArray();
        return view('dssmenu.partials.perawatan_form', compact('model','kategori', 'candi'));
    }

    public function chart($candi, $params, $tahun){
        $model = DB::table('perawatan as p')
            ->select('kategori', DB::raw('YEAR(tanggal) tahun'),
                     DB::raw('MONTHNAME(tanggal) bulan'),
                     DB::raw('count(p.id) total'))
            ->join('candi as c','c.id', '=', 'p.candi_id')
            ->where('c.id',$candi)
            ->where('kategori',$params)
            ->where(DB::raw('YEAR(tanggal)'), $tahun)
            ->orderBy('bulan', 'desc')
            ->groupBy('bulan','tahun')
            ->get();
        return response()->json($model);
    }

    public function getKategori(){
        $candi = DB::table('candi')->select('id','nama')->get();
        $kategori = Perawatan::select(DB::raw('kategori as kategori_id'), 'kategori')
            ->groupBy('kategori_id')            
            ->get();
        $tahun = Perawatan::select(DB::raw('YEAR(tanggal) tahun'))
            ->groupBy('tahun')
            ->get();
        return response()->json(['cagar' => $candi, 'kategori' => $kategori, 'tahun' => $tahun]);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'aktivitas' => 'required',
            'tanggal' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required'
        ]);

        $path_file = null;
        if($request->hasFile('gambar')){
            $path_file = "/upload/perawatan/".str_slug($request->aktivitas,'-').'.'.$request->gambar->getClientOriginalExtension();
            $request->gambar->move(public_path('upload/perawatan'), $path_file);
        }

        $model = Perawatan::create([
            'candi_id' => $request->candi_id,
            'user_id' => Auth::user()->id,
            'aktivitas' => $request->aktivitas,
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'gambar' => $path_file
        ]);

        return $model;
    }

    public function show($id)
    {
        $perawatan = Perawatan::findOrFail($id);
        return view('dssmenu.detail_perawatan', compact('perawatan'));
    }

    public function edit($id)
    {
        $model = Perawatan::findOrFail($id);
        $candi = Candi::pluck('nama','id')->toArray();
        $kategori = Perawatan::pluck('kategori','kategori')->toArray();
        return view('dssmenu.partials.perawatan_form', compact('model','kategori', 'candi'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'aktivitas' => 'required',
            'tanggal' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required'
        ]);

        $perawatan = Perawatan::findOrFail($id);
        $input = $request->all();
        $input['gambar'] = $perawatan->gambar;

        if($request->hasFile('gambar')){
            if($perawatan->gambar != NULL){
                unlink(public_path($perawatan->gambar));
            }
            $input['gambar'] = "/upload/perawatan/".str_slug($request->aktivitas,'-').'.'.$request->gambar->getClientOriginalExtension();
            $request->gambar->move(public_path('upload/perawatan'), $input['gambar']);
        }

        $perawatan->update([
            'candi_id' => $request->candi_id,
            'user_id' => Auth::user()->id,
            'aktivitas' => $request->aktivitas,
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'gambar' => $input['gambar']
        ]);

        return $perawatan;
    }

    public function destroy($id)
    {
        $perawatan = Perawatan::findOrFail($id);
        if(!empty($perawatan->gambar))
            unlink(public_path($perawatan->gambar));
        $perawatan->delete();
    }

    public function dataTablePerawatan(){
        $model = Perawatan::with(['candi' => function($q){
            $q->select('id', 'nama');
        }])->select('id','candi_id', 'aktivitas', 
        DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'),
        DB::raw('DATE_FORMAT(tanggal, "%M-%Y") as bulan'), 'kategori', 'lokasi')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('perawatan.show', $model->id),
                    'url_edit' => route('perawatan.edit', $model->id),
                    'url_destroy' => route('perawatan.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
