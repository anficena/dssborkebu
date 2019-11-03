@extends('layouts.app', ['activePage' => 'dokumentasi', 'titlePage' => __('Dokumentasi dan Publikasi')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header card-header-success">
                  <h4 class="card-title ">Kelola Data Dokumentasi</h4>
                  <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
              </div>
              <div class="card-body">
                  <div class="bd-example text-right">
                      <a href="{{ route('dokumentasi.create') }}" title="Tambah Data" data-target="#modal" class="btn btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
                  </div>
                  <div class="table-responsive">
                      <table  id="datatable" class="table table-bordered">
                      <thead class="thead-light">
                          <th class="th-index">No</th>
                          <th>Tahun</th>
                          <th>Judul</th>
                          <th>Upload</th>
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
    <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header card-header-warning">
                  <h4 class="card-title ">Kelola Data MOW Dokumentasi Pemugaran</h4>
                  <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
              </div>
              <div class="card-body">
                  <div class="bd-example text-right">
                      <a name="mow" href="{{ route('mow.create') }}" title="Tambah Data" data-target="#modal" class="btn btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
                  </div>
                  <div class="table-responsive">
                      <table  id="datatable-mow" class="table table-bordered">
                      <thead class="thead-light text-center" style="line-height:20px">
                          <th class="th-index">No</th>
                          <th>Tahun</th>
                          <th>Dokumentasi</th>
                          <th>Koleksi</th>
                          <th class="jml">Jumlah</th>
                          <th class="jml">Sudah Terkonservasi</th>
                          <th class="jml">Belum Terkonservasi</th>
                          <th>Tindakan</th>
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
          <h5 class="card-header"><strong>MULTICULTURAL COMPETENCE OF PROSPECTIVE PRESCHOOL TEACHERS IN PREDOMINANTLY MUSLIM COUNTRY</strong></h5>
          <div class="card-body">
            <img src="login.jpg" alt="..." class="img-thumbnail float-left" style="width: 90px; height: 110px;">
           
            <i class="fa fa-fw fa-calendar"></i><strong>Tanggal</strong>: 1 Oktober 2019 &ensp;&ensp;
            <i class="fa fa-fw fa-user"></i><strong>Penulis</strong>: Cristiano Ronaldo &ensp;&ensp;
            <i class="fa fa-fw fa-folder-open-o"></i><strong>Kategori</strong>: Cristiano Ronaldo
            <p class="card-category">Here is a subtitle for this table</p>
            <a href="#" class="btn btn-social btn-fill btn-facebook btn-sm"><i class="fa fa-fw fa-search"></i> Preview</a>
            
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

  th.jml{
    width:10%;
  }

  table#datatable-mow a.btn-success{
    visibility: hidden;
  }

  .card-img-top{
    height:200px;
    width: 100%;
  }

  .card-footer{
    justify-content: left !important;
    border-top: 1px solid rgba(0,0,0,.12) !important;
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
      ajax:"{{ route('dokumentasi.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'tahun', name: 'tahun'},
        {data: 'judul', name: 'judul'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'kategori', name: 'kategori'},
        {data: 'action', name: 'action'},
      ],
      order: [[1,'desc'], [2,'desc']],
      rowGroup: {
        dataSrc: ['tahun']
      },
      columnDefs: [{
        targets: [1], visible: false
      },
      {
        orderable: false, targets: [3,4,5]
      }]
    });

    $('#datatable-mow').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('mow.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'tahun', name: 'tahun'},
        {data: 'dokumentasi.judul', name: 'dokumentasi.judul'},
        {data: 'koleksi', name: 'koleksi'},
        {data: 'jumlah', name: 'jumlah'},
        {data: 'terkonservasi', name: 'terkonservasi'},
        {data: 'blm_terkonservasi', name: 'blm_terkonservasi'},
        {data: 'tindakan', name: 'tindakan'},
        {data: 'action', name: 'action'},
      ],
      order: [[1,'desc'], [2,'desc']],
      rowGroup: {
        dataSrc: ['tahun','dokumentasi.judul']
      },
      columnDefs: [{
        targets: [1,2], 
        visible: false
      },
      {
        orderable: false, 
        targets: [2,3,4,5,6,7,8]
      }]
    });
</script>
@endpush