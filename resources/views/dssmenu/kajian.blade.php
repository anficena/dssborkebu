@extends('layouts.app', ['activePage' => 'studi', 'titlePage' => __('Kajian dan Studi')])

@section('content')
<div class="content">
  <div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="col-md-12">
              <div class="alert alert-info alert-with-icon" data-notify="container">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span data-notify="message">Berikut tabulasi data<strong>kajian</strong> dapat dilihat berdasarkan tahun yang dipilih.
              </div>
              <h5><i class="fa fa-text-width"></i> &nbsp;Kategori:</h5>
              <ol>
                  <li>Kajian Konservasi Candi Borobudur <strong>(KKCB 1)</strong></li>
                  <li>Kajian Konservasi Cagar Budaya di KCB Borobudur <strong>(KKCB 2)</strong></li>
                  <li>Kajian Konservasi Cagar Budaya di luar KCB Borobudur <strong>(KKCB 3)</strong></li>
                  <li>Pengembangan Metode dan Teknik Konservasi <strong>(PMTK)</strong></li>
              </ol>
            </div>
            <div class="form-group col-md-4">
              <label>Pilih Tahun</label>
                {!! Form::select('kajian_tahun',  $tahun, null, ['class' => 'custom-select', 'id' => 'tahun']) !!}
            </div>
            @include('dssmenu.kajian_table_count')
            <div class="alert alert-info alert-with-icon" data-notify="container">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="material-icons">close</i>
              </button>
              <span data-notify="message">Grafik data <strong>kajian</strong> dapat dilihat berdasarkan tahun yang dipilih.
            </div>
            <div class="container" id="app">
              <kajian-component></kajian-component>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title ">Kelola Data Kajian dan Studi</h4>
            <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
          </div>
          <div class="card-body">
            <div class="bd-example text-right">
              <a href="{{ route('kajian.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
            </div>
            <div class="table-responsive">
              <table id="datatable" class="table table-bordered">
                <thead class="thead-light">
                  <th class="th-index">ID</th>
                  <th>Tahun</th>
                  <th>Tanggal</th>
                  <th>Judul</th>
                  <th>Penulis</th>                  
                  <th>Kategori</th>
                  <th class="th-actions">Action</th>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              
            </div>
        </div>
      </div>
    </div> -->
  </div>
</div>
@endsection

@push('styles')
<!-- Data table -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<style>
  .label-info{
    background-color:#34b0a5;
    border-radius: 4px;
    padding:2px;
  }
  .img-thumbnail{
    margin-right:15px;
  }

  .th-index{
    width:5%;
  }
  .th-actions{
    width:15%;
  }
  td a.btn-sm{
    padding: 0.40625rem 0.5rem !important;
  }

  thead{
    font:caption;
    line-height: 35px;
  }
  .th-actions{
      text-align:center;
  }
  table.dataTable tr.dtrg-group.dtrg-level-0 td{
      font-weight: bold;
     
  }

  table.dataTable tr.dtrg-group.dtrg-level-1 td{
    font-weight: bold;
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
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>

<script>
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('kajian.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'tahun', name: 'tahun'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'judul', name: 'judul'},
        {data: 'penulis', name: 'penulis'},
        {data: 'kategori', name: 'kategori'},
        {data: 'action', name: 'action'},
      ],
      order: [[1,'desc'], [2,'desc']],
      rowGroup: {
        dataSrc: ['tahun', 'kategori']
      },
      columnDefs: [{
        targets: [1,5],
        visible: false
      }]
    });
</script>
@endpush