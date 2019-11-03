<?php

namespace App\Http\Controllers;

use App\KedalamanSumur;
use App\MonevGeohidrologi;
use App\Imports\KedalamanSumurImport;
use Excel;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class KedalamanSumurController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_kedalaman_sumur');
    }

    public function getKategori(){
        $bulan = KedalamanSumur::select(DB::raw('MONTH(waktu) number'), DB::raw('MONTHNAME(waktu) bulan'))
            ->groupBy('bulan')
            ->orderBy('number')
            ->get();

        $tahun = KedalamanSumur::select(DB::raw('Year(waktu) tahun'))
            ->groupBy('tahun')
            ->get();
        return response()->json(['bulan' => $bulan, 'tahun' => $tahun]);
    }
    
    public function filterLokasi($param, $start, $end){
        $model = KedalamanSumur::select(DB::raw('YEAR(waktu) tahun'),
            DB::raw('MONTH(waktu) month_number'),
            DB::raw('MONTHNAME(waktu) month'),
            'lokasi','kedalaman')
            ->where([['lokasi', '=',$param]])
            ->whereBetween(DB::raw('YEAR(waktu)'), [$start, $end])
            ->groupBy('tahun','month_number')
            ->orderBy('tahun','desc')
            ->orderBy('month_number','asc')
            ->get();
        return response()->json($model);
    }

    public function chart($params, $params1){
        // $model = DB::table('kedalaman_sumur')
        //     ->select('lokasi', 'kedalaman',
        //              DB::raw('YEAR(waktu) tahun'),
        //              DB::raw('MONTHNAME(waktu) bulan'),
        //              DB::raw('MONTH(waktu) month_number'))
                    //  DB::raw('(lokasi="Sisi Barat") barat'),
                    //  DB::raw('(lokasi="Sisi Barat Daya") barat_daya'),
                    //  DB::raw('(lokasi="Sisi Barat Laut") barat_laut'),
                    //  DB::raw('(lokasi="Sisi Selatan") selatan'),
                    //  DB::raw('(lokasi="Sisi Tenggara") tenggara'),
                    //  DB::raw('(lokasi="Sisi Timur") timur'),
                    //  DB::raw('(lokasi="Sisi Timur Laut") timur_laut'),
                    //  DB::raw('(lokasi="Sisi Utara") utara'))
            // ->where(DB::raw('YEAR(waktu)'), $params)
            // ->groupBy('bulan','lokasi')
            // ->orderBy('tahun', 'desc')
            // ->orderBy('month_number', 'asc')
            // ->get();
        $barat = $this->filterLokasi('Sisi Barat', $params, $params1);
        $barat_daya = $this->filterLokasi('Sisi Barat Daya', $params, $params1);
        $barat_laut = $this->filterLokasi('Sisi Barat Laut', $params, $params1);
        $selatan = $this->filterLokasi('Sisi Selatan', $params, $params1);
        $tenggara = $this->filterLokasi('Sisi Tenggara', $params, $params1);
        $timur = $this->filterLokasi('Sisi Timur', $params, $params1);
        $timur_laut = $this->filterLokasi('Sisi Timur Laut', $params, $params1);
        $utara = $this->filterLokasi('Sisi Utara', $params, $params1);
        
        $bulan = KedalamanSumur::select(DB::raw('YEAR(waktu) tahun'),
            DB::raw('MONTH(waktu) month_number'),
            DB::raw('DATE_FORMAT(waktu, "%M-%Y") month'))
            ->whereBetween(DB::raw('YEAR(waktu)'), [$params, $params1])
            ->groupBy('tahun','month_number')
            ->orderBy('tahun','desc')
            ->orderBy('month_number','asc')
            ->get();
        
        // $model = KedalamanSumur::select('lokasi')->groupBy('lokasi')->get();
        // $lokasi = KedalamanSumur::select('lokasi')->groupBy('lokasi')->get();
        // $first = KedalamanSumur::where([[DB::raw('MONTH(waktu)'), '=', $p1],[DB::raw('YEAR(waktu)'), '=', $params]])    
        //     ->get([DB::raw('MONTHNAME(waktu) as bulan'),DB::raw('kedalaman as first')]);
        // $second = KedalamanSumur::where([[DB::raw('MONTH(waktu)'), '=', $p2],[DB::raw('YEAR(waktu)'), '=', $params]])    
        //     ->get([DB::raw('MONTHNAME(waktu) as bulan'),DB::raw('kedalaman as second')]);
        // $third = KedalamanSumur::where([[DB::raw('MONTH(waktu)'), '=', $p3],[DB::raw('YEAR(waktu)'), '=', $params]])    
        //     ->get([DB::raw('MONTHNAME(waktu) as bulan'),DB::raw('kedalaman as third')]);
        // $fourth = KedalamanSumur::where([[DB::raw('MONTH(waktu)'), '=', $p4],[DB::raw('YEAR(waktu)'), '=', $params]])    
        //     ->get([DB::raw('MONTHNAME(waktu) as bulan'),DB::raw('kedalaman as fourth')]);
        // $data = null;
        for($i = 0; $i <= count($bulan)-1; $i++){
            $bulan[$i]['lokasi'] = ['barat' => $barat->original[$i]->kedalaman ,
            'barat_daya' => $barat_daya->original[$i]->kedalaman,
            'barat_laut' => $barat_laut->original[$i]->kedalaman,
            'selatan' => $selatan->original[$i]->kedalaman,
            'tenggara' => $tenggara->original[$i]->kedalaman,
            'timur' => $timur->original[$i]->kedalaman,
            'timur_laut' => $timur_laut->original[$i]->kedalaman,
            'utara' => $utara->original[$i]->kedalaman];
        }
        return response()->json($bulan);
        
    }

    public function create()
    {
        $model = new KedalamanSumur();
        $observasi = MonevGeohidrologi::pluck('judul','id')->toArray();
        $tempat = KedalamanSumur::pluck('lokasi','lokasi')->toArray();
        return view('dssmenu.monev_lingkungan.kedalaman_sumur_form', compact('model', 'observasi', 'tempat'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'kedalaman' => 'required',
            'kondisi' => 'required'
        ]);
        
        $path_file = null;
        if($request->hasFile('photo')){
            $path_file = "/upload/kedalaman_sumur/".str_slug($request->waktu,'-').'-'.str_slug($request->lokasi,'-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/kedalaman_sumur'), $path_file);
        }

        $model = KedalamanSumur::create([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'kedalaman' => $request->kedalaman,
            'kondisi' => $request->kondisi,
            'photo' => $path_file
        ]);

        return $model;
    }

    public function import(){
        return view("dssmenu.import.import_kedalaman_sumur");
    }

    public function importStore(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand().$file->getClientOriginalName();

        $file->move('import/kedalaman_sumur/',$nama_file);

        Excel::import(new KedalamanSumurImport, public_path('/import/kedalaman_sumur/'.$nama_file));
    }

    public function show($id)
    {
        $model = KedalamanSumur::findOrFail($id);
        return view('dssmenu.monev_lingkungan.detail_kedalaman_sumur', compact('model'));
    }
    
    public function edit($id)
    {
        $model = KedalamanSumur::findOrFail($id);
        $observasi = MonevGeohidrologi::pluck('judul','id')->toArray();
        $tempat = KedalamanSumur::pluck('lokasi','lokasi')->toArray();
        return view('dssmenu.monev_lingkungan.kedalaman_sumur_form', compact('model', 'observasi', 'tempat'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'kedalaman' => 'required',
            'kondisi' => 'required'
        ]);

        $model = KedalamanSumur::findOrFail($id);
        $input = $request->all();
        $input['photo'] = $model->photo;

        if($request->hasFile('photo')){
            if($model->photo != NULL){
                unlink(public_path($model->photo));
            }
            $input['photo'] = "/upload/kedalaman_sumur/".str_slug($request->waktu,'-').'-'.str_slug($request->lokasi,'-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/kedalaman_sumur'), $input['photo']);
        }

        $model->update([
            'observasi_id' => $request->observasi_id,
            'user_id' => Auth::user()->id,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'kedalaman' => $request->kedalaman,
            'kondisi' => $request->kondisi,
            'photo' => $input['photo']
        ]);

        return $model;
    }

    public function destroy($id)
    {
        $model = KedalamanSumur::findOrFail($id);
        if(!empty($model->photo))
            unlink(public_path($model->photo));
        $model->delete();
    }

    public function dataTableKedalamanSumur(){
        $model = KedalamanSumur::with(['monev_geohidrologi' => function($q){
            $q->select('id', 'judul');
        }])->select('id','observasi_id', 
        DB::raw('DATE_FORMAT(waktu, "%d-%m-%Y") as tanggal'),
        DB::raw('DATE_FORMAT(waktu, "%M-%Y") as bulan'), 'lokasi', 'kedalaman')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('kedalaman_sumur.show', $model->id),
                    'url_edit' => route('kedalaman_sumur.edit', $model->id),
                    'url_destroy' => route('kedalaman_sumur.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
