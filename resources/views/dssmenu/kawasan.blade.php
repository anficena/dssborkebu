@extends('layouts.app', ['activePage' => 'kawasan', 'titlePage' => __('Cagar Budaya')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title ">Kelola Data Cagar Budaya</h4>
            <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
          </div>
          <div class="card-body">
            <div class="bd-example text-right">
              <a href="{{ route('kawasan.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
            </div>
            <div class="table-responsive">
              <table id="datatable" class="table">
                <thead class=" text-primary">
                  <th class="th-index">No</th>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Keterangan</th>
                  <th>File</th>
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
  </div>
</div>
@endsection

@push('styles')
<!-- Data table -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap4.min.css') }}">
<style>
    a.btn_show {
        visibility: hidden;
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
    }
    .th-actions{
        text-align:center;
    }
    table.dataTable tr.dtrg-group.dtrg-level-0 td{
        font-weight: bold;
        background-color: #e0e0e0;
    }

    table.dataTable tr.dtrg-group.dtrg-level-1 td{
        background-color: #f0f0f0;
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
<script>
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('kawasan.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'id', name: 'id'},
        {data: 'nama', name: 'nama'},
        {data: 'alamat', name: 'alamat'},
        {data: 'keterangan', name: 'keterangan'},
        {data: 'file', name: 'file'},
        {data: 'action', name: 'action'},
      ]
    });
</script>
@endpush