@extends('layouts.app', ['activePage' => 'kemitraan', 'titlePage' => __('Kemitraan')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title ">Kelola Data Kemitraan</h4>
            <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
          </div>
          <div class="card-body">
            <div class="btn-group">
              <button class="btn btn-outline-primary dropdown-toggle" type="button" id="buttonMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pilih Jenis Layanan
              </button>
              <div class="dropdown-menu" aria-labelledby="buttonMenu1">
                <a id="layanan_kunjungan" class="dropdown-item" href="{{route('kemitraan.kategori','kunjungan')}}">Layanan Kunjungan Tamu</a>
                <a id="layanan_pemanfaatan" class="dropdown-item" href="{{route('kemitraan.kategori','pemanfaatan')}}">Layanan Pemanfaatan</a>
                <a id="layanan_kemitraan" class="dropdown-item" href="{{route('kemitraan.kategori','kemitraan')}}">Layanan Kemitraan</a>
                <a id="layanan_lab" class="dropdown-item" href="{{route('kemitraan.kategori','laboratorium')}}">Layanan Laboratorium</a>
                <a id="layanan_dok" class="dropdown-item" href="{{route('kemitraan.kategori','dokumentasi')}}">Layanan Dokumentasi dan Publikasi</a>
                <a id="layanan_temuan" class="dropdown-item" href="{{route('kemitraan.kategori','temuan')}}">Layanan Laporan Temuan Cagar Budaya</a>
                <a id="layanan_temuan" class="dropdown-item" href="{{route('kemitraan.kategori','perpustakaan')}}">Layanan Perpustakaan</a>
                <a id="layanan_aduan" class="dropdown-item" href="{{route('kemitraan.kategori','aduan')}}">Layanan Aduan</a>
              </div>
            </div>
            <!-- <div class="row">
             
            </div> -->
            
            <div class="row" id="kategori_layanan">
              
            <div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<!-- Data table -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<style>
    a.btn_show {
        display: none;
    }

    .th-actions{
        text-align:center;
        width:10%;
    }
    thead{
      font:caption;
      line-height: 35px;
    }

    td a.btn-sm{
      padding: 0.40625rem 0.5rem !important;
    }

    /* .th-actions{
        text-align:center;
        width:150px;
    } */
    table.dataTable tr.dtrg-group.dtrg-level-0 td{
        font-weight: bold;
        
    }

    table.dataTable tr.dtrg-group.dtrg-level-1 td{
      font-style: italic;
      font-weight: normal;
      padding-top: 0.25em;
      padding-bottom: 0.25em;
      padding-left: 4em !important;
      font-size: 1em;
    }

</style>
@endpush
@push('scripts')
<script src="{{ asset('material/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('material/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('bower_components')}}/datatables.net-bs/js/dataTables.rowGroup.min.js"></script>
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
@endpush