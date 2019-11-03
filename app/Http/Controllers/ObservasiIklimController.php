<?php

namespace App\Http\Controllers;

use App\ObservasiIklim;
use App\Candi;
use App\Imports\ObservasiIklimImport;
use Excel;
use App\MonevLingkungan;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

class ObservasiIklimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_iklim');
    }

    public function getDataKlimatologi($kawasan, $params, $tahun){
        $data = DB::table('observasi_iklim as oi')
                ->select('ml.candi_id','oi.nama_data', DB::raw('YEAR(oi.tanggal) tahun'),
                        DB::raw('MONTHNAME(oi.tanggal) bulan'),
                        DB::raw('sum(oi.hasil) total'))
                ->where('ml.candi_id',$kawasan)
                ->where('oi.nama_data',$params)
                ->where(DB::raw('YEAR(oi.tanggal)'), $tahun)
                ->join('monev_lingkungan as ml', 'ml.id', '=', 'oi.observasi_id')
                ->orderBy(DB::raw('Month(oi.tanggal)'), 'asc')
                ->groupBy('bulan','tahun')
                ->get();
        return response()->json($data);
    }

    public function chart($kawasan, $params, $tahun){
        // $model = DB::table('observasi_iklim')
        //     ->select('nama_data', DB::raw('YEAR(tanggal) tahun'),
        //              DB::raw('MONTHNAME(tanggal) bulan'),
        //              DB::raw('sum(hasil) total'))
        //     ->where('nama_data',$params)
        //     ->where(DB::raw('YEAR(tanggal)'), $tahun)
        //     ->orderBy(DB::raw('Month(tanggal)'), 'asc')
        //     ->groupBy('bulan','tahun')
        //     ->get();
        
        // if(($params == "Curah hujan") || ($params == "Jumlah hari hujan")){
        //     $curah_hujan = DB::table('observasi_iklim as oi')
        //         ->select('ml.candi_id','oi.nama_data', DB::raw('YEAR(oi.tanggal) tahun'),
        //                 DB::raw('MONTHNAME(oi.tanggal) bulan'),
        //                 DB::raw('sum(oi.hasil) total'))
        //         ->where('ml.candi_id',$kawasan)
        //         ->where('oi.nama_data','Curah hujan')
        //         ->where(DB::raw('YEAR(oi.tanggal)'), $tahun)
        //         ->join('monev_lingkungan as ml', 'ml.id', '=', 'oi.observasi_id')
        //         ->orderBy(DB::raw('Month(oi.tanggal)'), 'asc')
        //         ->groupBy('bulan','tahun')
        //         ->get();
            
        //     $hari_hujan = DB::table('observasi_iklim as oi')
        //         ->select('ml.candi_id', 'oi.nama_data', DB::raw('YEAR(oi.tanggal) tahun'),
        //                 DB::raw('MONTHNAME(oi.tanggal) bulan'),
        //                 DB::raw('sum(oi.hasil) total'))
        //         ->where('ml.candi_id',$kawasan)
        //         ->where('oi.nama_data','Jumlah hari hujan')
        //         ->where(DB::raw('YEAR(oi.tanggal)'), $tahun)
        //         ->join('monev_lingkungan as ml', 'ml.id', '=', 'oi.observasi_id')
        //         ->orderBy(DB::raw('Month(oi.tanggal)'), 'asc')
        //         ->groupBy('bulan','tahun')
        //         ->get();
        //     for($i = 0; $i <= count($curah_hujan) - 1; $i++) {
        //         $curah_hujan[$i]->hari_hujan = $hari_hujan[$i]->total;
        //     }
            
        //     return response()->json($curah_hujan);
        // }else if((($params) == "Temperatur udara maksimal") || (($params) == "Temperatur udara minimal") || (($params) == "Temperatur udara rata-rata")){

        // }

        if(($params == "Curah hujan") || ($params == "Jumlah hari hujan")){
            $curah_hujan = $this->getDataKlimatologi($kawasan, "Curah hujan", $tahun);
            $hari_hujan = $this->getDataKlimatologi($kawasan, "Jumlah hari hujan", $tahun);
            for($i = 0; $i <= count($curah_hujan->original) - 1; $i++) {
                $curah_hujan->original[$i]->hari_hujan = $hari_hujan->original[$i]->total;
            }
            return response()->json($curah_hujan->original);
        }

        if((($params) == "Temperatur udara maksimal") || (($params) == "Temperatur udara minimal") || (($params) == "Temperatur udara rata-rata")){
            $temp_min = $this->getDataKlimatologi($kawasan, "Temperatur udara minimal", $tahun);
            $temp_max = $this->getDataKlimatologi($kawasan, "Temperatur udara maksimal", $tahun);
            $temp_avg = $this->getDataKlimatologi($kawasan, "Temperatur udara rata-rata", $tahun);
            for($i = 0; $i <= count($temp_avg->original) - 1; $i++) {
                $temp_avg->original[$i]->temp_min = $temp_min->original[$i]->total;
                $temp_avg->original[$i]->temp_max = $temp_max->original[$i]->total;
            }
            return response()->json($temp_avg->original);
        }
        
        if((($params) == "Kelembaban udara maksimal") || (($params) == "Kelembaban udara minimal") || (($params) == "Kelembaban udara rata-rata")){
            $kelembaban_min = $this->getDataKlimatologi($kawasan,'Kelembaban udara minimal',$tahun);
            $kelembaban_max = $this->getDataKlimatologi($kawasan,'Kelembaban udara maksimal',$tahun);
            $kelembaban_avg = $this->getDataKlimatologi($kawasan,'Kelembaban udara rata-rata',$tahun);
            for($i = 0; $i <= count($kelembaban_avg->original) - 1; $i++) {
                $kelembaban_avg->original[$i]->kelembaban_min = $kelembaban_min->original[$i]->total;
                $kelembaban_avg->original[$i]->kelembaban_max = $kelembaban_max->original[$i]->total;
            }
            return response()->json($kelembaban_avg->original);
        }

        if(($params) == "Penguapan air"){
            $penguapan = $this->getDataKlimatologi($kawasan,'Penguapan air',$tahun);
            return response()->json($penguapan->original);
        }

        if(($params) == "Kecepatan angin"){
            $kecepatan_angin = $this->getDataKlimatologi($kawasan,'Kecepatan angin',$tahun);
            return response()->json($kecepatan_angin->original);
        }
        
    }

    public function getKategori(){
        $candi = Candi::select(DB::raw('id'), 'nama')
            ->groupBy('id')            
            ->get();
        $kategori = ObservasiIklim::select(DB::raw('nama_data as jenis_id'), 'nama_data')
            ->groupBy('jenis_id')            
            ->get();
        $tahun = ObservasiIklim::select(DB::raw('YEAR(tanggal) tahun'))
            ->groupBy('tahun')
            ->get();
        return response()->json(['candi' => $candi, 'kategori' => $kategori, 'tahun' => $tahun]);
    }

    public function import(){
        return view("dssmenu.import.import_klimatologi");
    }

    public function importStore(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand().$file->getClientOriginalName();

        $file->move('import/klimatologi/',$nama_file);

        Excel::import(new ObservasiIklimImport, public_path('/import/klimatologi/'.$nama_file));
    }


    public function create()
    {
        $model = new ObservasiIklim();
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        $data = ObservasiIklim::pluck('nama_data','nama_data')->toArray();
        return view('dssmenu.monev_lingkungan.iklim_form', compact('model','observasi', 'data'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'tanggal' => 'required',
            'nama_data' => 'required',
            'hasil' => 'required',
            'satuan' => 'required'
        ]);

        $model = ObservasiIklim::create([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'nama_data' => $request->nama_data,
            'hasil' => $request->hasil,
            'satuan' => $request->satuan,
        ]);

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ObservasiIklim  $observasiIklim
     * @return \Illuminate\Http\Response
     */
    public function show(ObservasiIklim $observasiIklim)
    {
        //
    }

    public function edit($id)
    {
        $model = ObservasiIklim::findOrFail($id);
        $observasi = MonevLingkungan::pluck('judul','id')->toArray();
        $data = ObservasiIklim::pluck('nama_data','nama_data')->toArray();
        return view('dssmenu.monev_lingkungan.iklim_form', compact('model','observasi', 'data'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'tanggal' => 'required',
            'nama_data' => 'required',
            'hasil' => 'required',
            'satuan' => 'required'
        ]);
        
        $model = ObservasiIklim::findOrFail($id);
        $model->update([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'nama_data' => $request->nama_data,
            'hasil' => $request->hasil,
            'satuan' => $request->satuan,
        ]);

    }

    public function destroy($id)
    {   
       $model = ObservasiIklim::findOrFail($id);
       $model->delete();
    }

    public function dataTableIklim(){
        $model = ObservasiIklim::with(['monev_lingkungan' => function($q){
            $q->select('id', 'judul');
        }])->select('id','observasi_id', 
            DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'),
            DB::raw('DATE_FORMAT(tanggal, "%M %Y") as bulan'),
            DB::raw('DATE_FORMAT(tanggal, "%Y") as tahun'),
            'nama_data', 'hasil', 'satuan')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('iklim.show', $model->id),
                    'url_edit' => route('iklim.edit', $model->id),
                    'url_destroy' => route('iklim.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action','status_pelayanan'])
            ->toJson();
    }
}
