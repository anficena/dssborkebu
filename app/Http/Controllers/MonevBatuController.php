<?php

namespace App\Http\Controllers;

use App\MonevBatu;
use App\Candi;
use Illuminate\Http\Request;
use DataTables;
use Response;
use Auth;
use DB;

class MonevBatuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dssmenu.monev_batu.kelola');
    }

    public function chart($awal, $akhir, $params){
        
        $model = DB::table('monev_batu')
                ->select(DB::raw('YEAR(tanggal) tahun'),
                        'jenis_observasi',
                        DB::raw('sum(jumlah) total'))
                ->whereBetween(DB::raw('YEAR(tanggal)'),[$awal, $akhir])
                ->where('jenis_observasi',$params)
                ->orderBy('tanggal', 'asc')
                ->groupBy('tahun')
                ->get();
        

                // $model1 = DB::table('monev_batu')
                // ->select(DB::raw('YEAR(tanggal) tahun'),
                //         DB::raw('MonthName(tanggal) bulan'),
                //         DB::raw('sum(jumlah) totalv'))
                // ->where('jenis_observasi','Vandalisme')
                // ->orderBy('tanggal', 'asc')
                // ->groupBy('tahun', 'bulan')
                // ->get();

        // $x = array();
        // for($i = 0; $i < count($model); $i++){
        //     if($model[$i]->bulan == $model1[$i]->bulan)
        //         $model[$i]->child = $model1[$i]->totalv;
                
        // }
        return response()->json($model);
    }

    public function getKategori(){
        $kategori = MonevBatu::select(DB::raw('jenis_observasi as jenis_id'), 'jenis_observasi')
            ->groupBy('jenis_id')            
            ->get();

        $tahun = MonevBatu::select(DB::raw('YEAR(tanggal) tahun'))
            ->groupBy('tahun')
            ->get();
        return response()->json(['kategori' => $kategori, 'tahun' => $tahun]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new MonevBatu();
        $kategori = MonevBatu::pluck('jenis_observasi', 'jenis_observasi')->toArray();
        $candi = Candi::pluck('nama', 'id')->toArray();
        return view('dssmenu.monev_batu.keterawatan_batu_form', compact('model','kategori','candi'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'tanggal' => 'required',
            'jenis_observasi' => 'required',
            'jumlah' => 'required',
        ]);

        $model = MonevBatu::create([
            'candi_id' => $request->candi_id,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'jenis_observasi' => $request->jenis_observasi,
            'jumlah' => $request->jumlah
        ]);

        return $model;
    }

    public function show(MonevBatu $monevBatu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MonevBatu  $monevBatu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = MonevBatu::findOrFail($id);
        $kategori = MonevBatu::pluck('jenis_observasi', 'jenis_observasi')->toArray();
        $candi = Candi::pluck('nama', 'id')->toArray();
        return view('dssmenu.monev_batu.keterawatan_batu_form', compact('model','kategori','candi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MonevBatu  $monevBatu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'candi_id' => 'required',
            'tanggal' => 'required',
            'jenis_observasi' => 'required',
            'jumlah' => 'required',
        ]);
        
        $model = MonevBatu::findOrFail($id);
        $model->update([
            'candi_id' => $request->candi_id,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'jenis_observasi' => $request->jenis_observasi,
            'jumlah' => $request->jumlah
        ]);

        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MonevBatu  $monevBatu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = MonevBatu::findOrFail($id);
        $model->delete();
    }

    public function dataTableMonevBatu(){
        $model = MonevBatu::with(['candi'=>function($q){
            $q->select('id', 'nama');
        }])->select('id', 'candi_id', 
                    DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'), 
                    DB::raw('DATE_FORMAT(tanggal, "%Y") as tahun'), 
                    'jenis_observasi', 'jumlah')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('monev_batu.show', $model->id),
                    'url_edit' => route('monev_batu.edit', $model->id),
                    'url_destroy' => route('monev_batu.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
