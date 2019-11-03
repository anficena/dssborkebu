<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soc;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;

class SocController extends Controller
{

    public function index()
    {
        // $soc = DB::table('soc')
        //         ->select((DB::raw('YEAR(tanggal) tahun')),
        //                 (DB::raw('MonthName(tanggal) bulan')),
        //                 DB::raw('sum(kategori="L") as jmll'),
        //                 DB::raw('sum(kategori="P") as jmlp'))
        //         ->orderBy('tanggal', 'asc')
        //         ->groupBy('tahun', 'bulan')
        //         ->get();

        // $socp = DB::table('soc')
        //         ->select(DB::raw('sum(kategori="L") as jmll'),
        //                 DB::raw('sum(kategori="P") as jmlp'))
        //         ->groupBy(DB::raw('YEAR(tanggal)'),DB::raw('MonthName(tanggal)'))
        //         ->get();
        // $soc = $soc->toArray();
        // $socp = $socp->toArray();
        // for($i = 0; $i <= count($soc)-1; $i++){
        //     $soc[$i]['bulan'] = $socp[$i];
        // }
        // $data = $soc->merge($socp);
        

        
        // $socp = DB::table('soc')
        //         ->select('decision_id','decision', 'kategori',(DB::raw('YEAR(tanggal) tahun')),
        //                 (DB::raw('MonthName(tanggal) bulan')),
        //                 DB::raw('count(decision_id) as jmlp'))
        //         ->where('kategori','P')
        //         ->orderBy('tahun', 'ASC')
        //         ->groupBy('tahun', 'bulan')
        //         ->get();
        // $merged = $socl->merge($socp);
        // $result = $merged->all();
        // return response()->json($soc);
        // $model = Soc::select('id','decision_id', 
        //         DB::raw('DATE_FORMAT(tanggal, "%d-%M-%Y") as tanggal'), 
        //         'decision', 'file')
        //         ->orderBy('tanggal','desc')
        //         ->paginate(4);
        $dump = Soc::select(DB::raw('YEAR(tanggal) as tahun'),DB::raw('YEAR(tanggal) as id'))->orderBy('tahun','asc')->get();
        // $tahun = Pameran::pluck(DB::raw('YEAR(tanggal)'),DB::raw('YEAR(tanggal)'))->toArray();
        $tahun = $dump->pluck('tahun','id')->toArray();
        return view('dssmenu.soc', compact('tahun'));
    }

    public function chart($start, $end){
        $soc = DB::table('soc')
                ->select((DB::raw('YEAR(tanggal) tahun')),
                        (DB::raw('MonthName(tanggal) bulan')),
                        DB::raw('count(id) as total'))
                ->whereBetween(DB::raw('YEAR(tanggal)'),[$start, $end])
                ->orderBy('tanggal', 'asc')
                ->groupBy('tahun')
                ->get();
        return response()->json($soc);
    }

    public function getTahun(){
        $tahun = Soc::select(DB::raw('YEAR(tanggal) tahun'))
            ->groupBy('tahun')
            ->get();
        return response()->json(['tahun' => $tahun]);
    }

    public function create()
    {
        $soc = new Soc();
        $kategori = Soc::pluck('kategori','kategori')->toArray();
        return view("dssmenu.partials.soc_form", compact('soc', 'kategori'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'decision_id' => 'required',
            'tanggal' => 'required',
            'decision' => 'required',
            'kategori' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'keterangan' => 'required',
        ]);

        $path_image = null;
        $path_file = null;
        if($request->hasFile('file')){
            $path_file = "/upload/soc/".str_slug($request->decision,'-').'-lampiran-'.date().'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/soc'), $path_file);
        }
        if($request->hasFile('image')){
            $path_image = "/upload/soc/".str_slug($request->decision,'-').'-image-'.date().$request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload/soc'), $path_image);
        }

        $soc = Soc::create([
            'decision_id' => $request->decision_id,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'decision' => $request->decision,
            'kategori' => $request->kategori,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $path_image,
            'file' => $path_file,
            'keterangan' => $request->keterangan
        ]);

        return $soc;
    }

    public function show($id)
    {
        $soc = Soc::findOrFail($id);
        return view('dssmenu.detail_soc', compact('soc'));
    }

    public function edit($id)
    {
        $soc = Soc::findOrFail($id);
        $kategori = Soc::pluck('kategori','kategori')->toArray();
        return view("dssmenu.partials.soc_form", compact('soc', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'decision_id' => 'required',
            'tanggal' => 'required',
            'decision' => 'required',
            'kategori' => 'required',
            'keterangan' => 'required',
        ]);

        $soc = Soc::findOrFail($id);
        $input = $request->all();
        $input['image'] = $soc->image;
        $input['file'] = $soc->file;

        if($request->hasFile('file')){
            if($soc->file != NULL){
                unlink(public_path($soc->file));
            }
            $input['file'] = "/upload/soc".str_slug($request->decision,'-').'-lampiran-'.date().'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('upload/soc'), $input['file']);
        }

        if($request->hasFile('image')){
            if($soc->image != NULL){
                unlink(public_path($soc->image));
            }
            $input['image'] = "/upload/soc".str_slug($request->decision,'-').'-lampiran-'.date().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload/soc'), $input['image']);
        }

        $soc->update([
            'decision_id' => $request->decision_id,
            'tanggal' => $request->tanggal,
            'decision' => $request->decision,
            'kategori' => $request->kategori,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $input['image'],
            'file' => $input['file'],
            'keterangan' => $request->keterangan
        ]);

        return $soc;
    }

    public function destroy($id)
    {
        $soc = Soc::findOrFail($id);
        if(!empty($soc->file))
            unlink(public_path($soc->file));
        if(!empty($soc->image))
            unlink(public_path($soc->image));
        $soc->delete();
    }

    public function dataTahunan($param){
        $model = Soc::select('decision', DB::raw('DATE_FORMAT(tanggal, "%d-%M-%Y") as tanggal'),
                    'decision_id', 'kategori', 'latitude', 'longitude', 'image', 'file', 'keterangan')
                    ->where(DB::raw('YEAR(tanggal)'),$param)
                    ->get();
        return response()->json(['data' => $model]);
    }

    public function dataTableSoc(){
        $model = Soc::select('id','decision_id', DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'), DB::raw('DATE_FORMAT(tanggal, "%Y") as tahun'), 'decision', 'kategori')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('soc.show', $model->id),
                    'url_edit' => route('soc.edit', $model->id),
                    'url_destroy' => route('soc.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
