<?php

namespace App\Http\Controllers;

use App\Pameran;
use Illuminate\Http\Request;
use DataTables;
use DB;

class PameranController extends Controller
{
    public function index()
    {
        $dump = Pameran::select(DB::raw('YEAR(tanggal) as tahun'),DB::raw('YEAR(tanggal) as id'))->orderBy('tahun','asc')->get();
        // $tahun = Pameran::pluck(DB::raw('YEAR(tanggal)'),DB::raw('YEAR(tanggal)'))->toArray();
        $tahun = $dump->pluck('tahun','id')->toArray();
        // $tahun = array();
        // for($i = 0; $i <= count($dump) - 1; $i++){
        //     $tahun[$i] = [$dump[$i]->tahun => $dump[$i]->tahun];
        // }
        // return response()->json($tahun);
        return view('dssmenu.pameran', compact('tahun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pameran = new Pameran();
        return view('dssmenu.partials.pameran_form', compact('pameran'));
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
            'nama' => 'required',
            'tema' => 'required',
            'tanggal' => 'required',
            'tempat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'pengunjung' => 'required'
        ]);

        $path_photo = null;
        if($request->hasFile('photo')){
            $path_photo = "/upload/pameran/".date("d-m-Y").'_'.str_slug($request->nama,'-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/pameran'), $path_photo);
        }

        $pameran = Pameran::create([
            'nama' => $request->nama,
            'tema' => $request->tema,
            'tanggal' => $request->tanggal,
            'tempat' => $request->tempat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'pengunjung' => $request->pengunjung,
            'photo' => $path_photo
        ]);

        return $pameran;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pameran  $pameran
     * @return \Illuminate\Http\Response
     */
    public function show(Pameran $pameran)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pameran  $pameran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pameran = Pameran::findOrFail($id);
        return view('dssmenu.partials.pameran_form', compact('pameran'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required',
            'tema' => 'required',
            'tanggal' => 'required',
            'tempat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'pengunjung' => 'required'
        ]);

        $pameran = Pameran::findOrFail($id);
        $input = $request->all();
        $input['photo'] = $pameran->photo;

        if($request->hasFile('photo')){
            if($pameran->photo != NULL){
                unlink(public_path($pameran->photo));
            }
            $input['photo'] = "/upload/pameran/".date("d-m-Y").'_'.str_slug($request->nama,'-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/pameran'), $input['photo']);
        }

        $pameran->update([
            'nama' => $request->nama,
            'tema' => $request->tema,
            'tanggal' => $request->tanggal,
            'tempat' => $request->tempat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'pengunjung' => $request->pengunjung,
            'photo' => $input['photo']
        ]);

        return $pameran;
    }


    public function destroy($id)
    {
        $pameran = Pameran::findOrFail($id);
        if(!empty($pameran->photo))
            unlink(public_path($pameran->photo));
        $pameran->delete();
    }

    public function dataTahunan($tahun){
        $model = Pameran::select('id','nama', 
        DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'), 
        DB::raw('DATE_FORMAT(tanggal, "%Y") as tahun'),
        'tema', 'tempat', 'latitude', 'longitude', 'pengunjung', 'photo')
        ->where(DB::raw('DATE_FORMAT(tanggal, "%Y")'),$tahun)
        ->get();
        return response()->json(['data' => $model]);
    }

    public function dataTablePameran(){
        $model = Pameran::select('id','nama', 
        DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'), 
        DB::raw('DATE_FORMAT(tanggal, "%Y") as tahun'),
        'tema', 'tempat', 'latitude', 'longitude', 'pengunjung', 'photo')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('pameran.show', $model->id),
                    'url_edit' => route('pameran.edit', $model->id),
                    'url_destroy' => route('pameran.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
