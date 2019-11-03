<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mow;
use App\Dokumentasi;
use DataTables;
use DB;

class MowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $model = Dokumentasi::pluck('id','kategori')->toArray();
        // $mow = Dokumentasi::where('kategori','mow')->pluck('id','kategori')->toArray();
        // $model = Dokumentasi::select('id','judul','thumbnail','kategori',DB::raw('count(id) as total'))
        // ->groupBy('kategori')
        // ->orderBy('created_at','desc')
        // ->get();
        // return response()->json($model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Mow();
        $mow = Dokumentasi::where('kategori','mow')->pluck('judul','id')->toArray();
        return view('dssmenu.partials.mow_form', compact('model','mow'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'dokumentasi_id' => 'required',
            'koleksi' => 'required',
            'jumlah' => 'required',
            'terkonservasi' => 'required',
            'tindakan' => 'required',
        ]);

        $model = Mow::create([
            'dokumentasi_id' => $request->dokumentasi_id,
            'koleksi' => $request->koleksi,
            'jumlah' => $request->jumlah,
            'terkonservasi' => $request->terkonservasi,
            'tindakan' => $request->tindakan,
        ]);

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Mow::findOrFail($id);
        $mow = Dokumentasi::where('kategori','mow')->pluck('judul','id')->toArray();
        return view('dssmenu.partials.mow_form', compact('model','mow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'dokumentasi_id' => 'required',
            'koleksi' => 'required',
            'jumlah' => 'required',
            'terkonservasi' => 'required',
            'tindakan' => 'required',
        ]);
        $model = Mow::findOrFail($id);
        $model->update([
            'dokumentasi_id' => $request->dokumentasi_id,
            'koleksi' => $request->koleksi,
            'jumlah' => $request->jumlah,
            'terkonservasi' => $request->terkonservasi,
            'tindakan' => $request->tindakan,
        ]);

        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Mow::findOrFail($id);
        $model->delete();
    }


    public function dataTableMow(){
        $model = Mow::with(['dokumentasi' => function($q){
            $q->select('id', 'judul');
        }])->select('id', DB::raw('YEAR(created_at) as tahun'),
            'dokumentasi_id', 'koleksi',  'jumlah', 'terkonservasi',
            DB::raw('(jumlah - terkonservasi) as blm_terkonservasi'),
            'tindakan')->get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('dssmenu._action', [
                    'model' => $model,
                    'url_show' => route('mow.show', $model->id),
                    'url_edit' => route('mow.edit', $model->id),
                    'url_destroy' => route('mow.destroy', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
