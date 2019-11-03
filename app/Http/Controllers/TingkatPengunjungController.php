<?php

namespace App\Http\Controllers;

use App\TingkatPengunjung;
use App\MonevPemanfaatan;
use App\Candi;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class TingkatPengunjungController extends Controller
{
    public function index()
    {
        return view('dssmenu.monev_lingkungan.kelola_pengunjung');
    }

    public function chart($candi_id, $tahun){
        $model = DB::table('tingkat_pengunjung as tp')
            ->join('monev_pemanfaatan as mp','mp.id','tp.observasi_id')
            ->select(DB::raw('YEAR(tp.tanggal) tahun'),
                    DB::raw('MONTHNAME(tp.tanggal) bulan'),
                    DB::raw('sum(tp.pelajar) pelajar'), 
                    DB::raw('sum(tp.umum) umum'),
                    DB::raw('sum(tp.dinas) dinas'),
                    DB::raw('sum(tp.mancanegara) mancanegara'))
            ->where(DB::raw('YEAR(tanggal)'),$tahun)
            ->where('mp.candi_id',$candi_id)
            ->orderBy('tahun', 'desc')
            ->groupBy('tahun','bulan')
            ->get();
        return response()->json($model);
    }

    public function getKategori(){
        $tahun = TingkatPengunjung::select(DB::raw('YEAR(tanggal) tahun'))
            ->groupBy('tahun')
            ->get();
        $candi = Candi::select('id','nama')
            ->groupBy('nama')
            ->get();
        return response()->json(['tahun' => $tahun, 'candi' => $candi]);
    }

    public function create()
    {
        $model = new TingkatPengunjung();
        $observasi = MonevPemanfaatan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.tingkat_pengunjung_form', compact('model', 'observasi'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'tanggal' => 'required',
            'pelajar' => 'required',
            'umum' => 'required',
            'dinas' => 'required',
            'mancanegara' => 'required',
            'total' => 'required',
            'keterangan' => 'required',
        ]);
        
        $model = TingkatPengunjung::create([
            'observasi_id' => $request->observasi_id,
            'tanggal' => $request->tanggal,
            'pelajar' => $request->pelajar,
            'umum' => $request->umum,
            'dinas' => $request->dinas,
            'mancanegara' => $request->mancanegara,
            'total' => $request->total,
            'keterangan' => $request->keterangan,
        ]);

        return $model;
    }

    public function show($id)
    {
        $model = TingkatPengunjung::findOrFail($id);
        return view('dssmenu.monev_lingkungan.tingkat_pengunjung_form', compact('model'));
    }
    
    public function edit($id)
    {
        $model = TingkatPengunjung::findOrFail($id);
        $observasi = MonevPemanfaatan::pluck('judul','id')->toArray();
        return view('dssmenu.monev_lingkungan.tingkat_pengunjung_form', compact('model', 'observasi'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'observasi_id' => 'required',
            'tanggal' => 'required',
            'pelajar' => 'required',
            'umum' => 'required',
            'dinas' => 'required',
            'mancanegara' => 'required',
            'total' => 'required',
            'keterangan' => 'required',
        ]);

        $model = TingkatPengunjung::findOrFail($id);
        $model->update([
            'observasi_id' => $request->observasi_id,
            'tanggal' => $request->tanggal,
            'pelajar' => $request->pelajar,
            'umum' => $request->umum,
            'dinas' => $request->dinas,
            'mancanegara' => $request->mancanegara,
            'total' => $request->total,
            'keterangan' => $request->keterangan,
        ]);

        return $model;
    }

    public function destroy($id)
    {
        $model = TingkatPengunjung::findOrFail($id);
        $model->delete();
    }

    public function dataTablePengunjung(){
        $model = TingkatPengunjung::with(['monev_pemanfaatan' => function($q){
            $q->select('id', 'judul');
        }])->select('id','observasi_id', 
        DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'),
        DB::raw('DATE_FORMAT(tanggal, "%Y") as tahun'),
        DB::raw('DATE_FORMAT(tanggal, "%M %Y") as bulan'), 'pelajar', 'umum', 'dinas', 'mancanegara', 'total', 'keterangan')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('tingkat_pengunjung.show', $model->id),
                    'url_edit' => route('tingkat_pengunjung.edit', $model->id),
                    'url_destroy' => route('tingkat_pengunjung.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
