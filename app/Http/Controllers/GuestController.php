<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soc;
use App\Dokumentasi;
use App\Pameran;
use DB;

class GuestController extends Controller
{
    public function soc() {
        // $model = Soc::select('id','decision_id', 
        //     DB::raw('DATE_FORMAT(tanggal, "%d-%M-%Y") as tanggal'), 
        //     'decision', 'file')
        //     ->orderBy('tanggal','desc')
        //     ->paginate(4);
        $dump = Soc::select(DB::raw('YEAR(tanggal) as tahun'),DB::raw('YEAR(tanggal) as id'))->orderBy('tahun','asc')->get();
        // $tahun = Pameran::pluck(DB::raw('YEAR(tanggal)'),DB::raw('YEAR(tanggal)'))->toArray();
        $tahun = $dump->pluck('tahun','id')->toArray();
        return view('auth.soc_guest', compact('tahun'));
    }

    public function kajian(){
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
        return view('dssmenu.kajian_guest', compact('kajian','tahun'));
    }

    public function dokumentasi(){
        $dokumentasi = Dokumentasi::select('id','judul','thumbnail','kategori',DB::raw('count(id) as total'))
            ->groupBy('kategori')
            ->orderBy('created_at','desc')
            ->get();
        
        $dump = Pameran::select(DB::raw('YEAR(tanggal) as tahun'),DB::raw('YEAR(tanggal) as id'))->orderBy('tahun','asc')->get();
        // $tahun = Pameran::pluck(DB::raw('YEAR(tanggal)'),DB::raw('YEAR(tanggal)'))->toArray();
        $tahun = $dump->pluck('tahun','id')->toArray();

        return view('dssmenu.dokumentasi_guest',compact('dokumentasi','tahun'));
    }

    public function pelayanan(){
        return view('dssmenu.pelayanan_guest');
    }

    public function kemitraan(){
        return view('dssmenu.kemitraan_guest');
    }

    public function perawatan(){
        return view('dssmenu.perawatan_guest');
    }

    public function monev(){
        return view('dssmenu.monev_guest');
    }
}
