<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kajian;
use DataTables;
use DB;

class KajianController extends Controller
{
    public function index()
    {
        $kajian = DB::table('kajian')
                ->select(DB::raw('YEAR(tanggal) tahun'), 
                    DB::raw('sum(kategori="KKCB1") as kkcb1'),
                    DB::raw('sum(kategori="KKCB2") as kkcb2'),
                    DB::raw('sum(kategori="KKCB3") as kkcb3'),
                    DB::raw('sum(kategori="PMTK") as pmtk'))
                ->groupBy('tahun')
                ->orderBy('tahun')
                ->get();

        $dump = DB::table('kajian')->select(DB::raw('YEAR(tanggal) tahun'), DB::raw('YEAR(tanggal) id'))->get();
        $tahun = $dump->pluck('tahun', 'id')->toArray();
        // return response()->json($kajian);
        return view("dssmenu.kajian", compact('kajian', 'tahun'));
    }

    public function filter($tahun){
        // if(empty($tahun))
        //     $where = "whereNotNull(DB::raw('YEAR(tanggal)'))";
        // else
        //     $where = "where(DB::raw('YEAR(tanggal)'), ".$tahun.")";
        if($tahun==0){
            $kajian = DB::table('kajian')
                    ->select(DB::raw('YEAR(tanggal) tahun'), 
                        DB::raw('sum(kategori="KKCB1") as kkcb1'),
                        DB::raw('sum(kategori="KKCB2") as kkcb2'),
                        DB::raw('sum(kategori="KKCB3") as kkcb3'),
                        DB::raw('sum(kategori="PMTK") as pmtk'))
                    ->groupBy('tahun')
                    ->orderBy('tahun')
                    ->get();
        }else{
            $kajian = DB::table('kajian')
                    ->select(DB::raw('YEAR(tanggal) tahun'), 
                        DB::raw('sum(kategori="KKCB1") as kkcb1'),
                        DB::raw('sum(kategori="KKCB2") as kkcb2'),
                        DB::raw('sum(kategori="KKCB3") as kkcb3'),
                        DB::raw('sum(kategori="PMTK") as pmtk'))
                    ->where(DB::raw('YEAR(tanggal)'), $tahun)
                    ->groupBy('tahun')
                    ->orderBy('tahun')
                    ->get();
        }
        return view("dssmenu.kajian_table_count", compact('kajian'));
    }

    public function showCount($tahun, $kategori){
        $model = DB::table('kajian')
            ->select('*')
            ->where(DB::raw('YEAR(tanggal)'),$tahun)
            ->where('kategori',$kategori)
            ->orderBy(DB::raw('YEAR(tanggal)'),'desc')
            ->get();
        // return response()->json($model); 
        return view('dssmenu.detail_kajian_count', compact('model'));
    }

    public function chart($start, $end){
        $model = DB::table('kajian')
            ->select('kategori', DB::raw('YEAR(tanggal) tahun'),
                     DB::raw('MONTHNAME(tanggal) bulan'),
                     DB::raw('sum(kategori="KKCB1") as kkcb1'),
                     DB::raw('sum(kategori="KKCB2") as kkcb2'),
                     DB::raw('sum(kategori="KKCB3") as kkcb3'),
                     DB::raw('sum(kategori="PMTK") as pmtk'))
            ->whereBetween(DB::raw('YEAR(tanggal)'), [$start, $end])
            ->orderBy('bulan', 'desc')
            ->groupBy('tahun')
            ->get();
        return response()->json($model);
    }

    public function create()
    {
        $kajian = new Kajian();
        // $kategori = Kajian::pluck('kategori', 'kategori')->toArray();
        $kategori = array();
        $kategori = ['KKCB1' => 'KKCB1',
                     'KKCB2' => 'KKCB2',
                     'KKCB3' => 'KKCB3',
                     'PMTK' => 'PMTK',
                     'Publikasi' => 'Publikasi'];
        return view("dssmenu.partials.kajian_form", compact('kajian', 'kategori'));
    }

    public function getKategori(){
        $tahun = Kajian::select(DB::raw('YEAR(tanggal) tahun'))
            ->groupBy('tahun')
            ->get();
        return response()->json(['tahun' => $tahun]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
            'keyword' => 'required',
            'tanggal' => 'required',
            'abstrak' => 'required',
        ]);

        $path_file = null;
        if($request->hasFile('file')){
            $path_file = "/upload/kajian/".str_slug($request->judul,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/kajian'), $path_file);
        }

        $kajian = Kajian::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'abstrak' => $request->abstrak,
            'file' => $path_file
        ]);

        $tags = explode(",", $request->keyword);
        $kajian->tag($tags);

        return $kajian;
    }

    
    public function show($id)
    {
        $kajian = Kajian::findOrFail($id);
        return view('dssmenu.detail_kajian', compact('kajian'));
    }

    public function edit($id)
    {
        $kajian = Kajian::findOrFail($id);
        $kategori = Kajian::pluck('kategori', 'kategori')->toArray();
        if(!empty($kajian->tags)){
            $tags = $kajian->tags;
            $tag = null;
            for($i = 0; $i < count($tags); $i++){
                $tag[$i] = $tags[$i]->name;
            }
            $tag=  implode(",", array_flatten($tag));
        }
        return view("dssmenu.partials.kajian_form", compact('kajian', 'kategori', 'tag'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'judul' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
            'keyword' => 'required',
            'tanggal' => 'required',
            'abstrak' => 'required',
        ]);

        $kajian = Kajian::findOrFail($id);
        $input = $request->all();
        $input['file'] = $kajian->file;

        if($request->hasFile('file')){
            if($kajian->file != NULL){
                unlink(public_path($kajian->file));
            }
            $input['file'] = "/upload/kajian/".str_slug($request->judul,'-').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/kajian'), $input['file']);
        }

        $kajian->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'abstrak' => $request->abstrak,
            'file' => $input['file']
        ]);

        $tags = explode(",", $request->keyword);
        $kajian->retag($tags);
    }


    public function destroy($id)
    {
        $kajian = Kajian::findOrFail($id);
        $kajian->untag();
        if(!empty($kajian->file))
            unlink(public_path($kajian->file));
        $kajian->delete();
    }

    public function dataTableKajian(){
        $model = Kajian::select('id',  DB::raw('DATE_FORMAT(tanggal, "%d-%M-%Y") as tanggal'), 
        DB::raw('DATE_FORMAT(tanggal, "%Y") as tahun'), 'judul', 'penulis', 'kategori', 'file')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('kajian.show', $model->id),
                    'url_edit' => route('kajian.edit', $model->id),
                    'url_destroy' => route('kajian.destroy', $model->id)
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
            ->rawColumns(['file','action'])
            ->toJson();
    }

    public function dataTablePublikasi(){
        $model = Kajian::where(['kategori' => 'Publikasi'])->select('id',  DB::raw('DATE_FORMAT(tanggal, "%d-%M-%Y") as tanggal'), 
        DB::raw('DATE_FORMAT(tanggal, "%Y") as tahun'), 'judul', 'penulis', 'kategori', 'file')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('kajian.show', $model->id),
                    'url_edit' => route('kajian.edit', $model->id),
                    'url_destroy' => route('kajian.destroy', $model->id)
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
            ->rawColumns(['file','action'])
            ->toJson();
    }

    public function searchPublikasi($params){
        if(!empty($params)){
        $model = Kajian::where('judul', 'like', '%'.$params.'%')
                ->where('kategori','Publikasi')
                ->get();
        }else{
            $model = Kajian::where('kategori','Publikasi')
                ->get();
        }
        return response()->json($model);
    }

    
}
