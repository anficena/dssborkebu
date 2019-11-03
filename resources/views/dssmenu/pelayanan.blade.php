@extends('layouts.app', ['activePage' => 'pelayanan', 'titlePage' => __('Pelayanan Masyarakat')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title ">Kelola Data Pelayanan Masyarakat</h4>
            <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                <a href="{{ route('pelayanan.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-sm btn-primary modal-show"><i class="material-icons">add</i>Tambah Data<div class="ripple-container"></div></a>
              </div>
            </div>
            
            <div class="table-responsive">
              <table id="datatable" class="table">
                <thead class=" text-primary">
                  <th style="width:5%;">ID</th>
                  <th>Bulan</th>
                  <th>Tanggal</th>
                  <th>Perihal</th>
                  <th>Pengirim</th>
                  <th>Penerima</th>
                  <th>Status</th>
                  <th style="width:15%;">Action</th>
                </thead>
                <tbody>
                  <!-- <tr>
                    <td>1</td>
                    <td>27-Agustus-2019</td>
                    <td>Peletakan Batu Kanal Barat</td>
                    <td>Basuki Purnama</td>
                    <td>Anies Baswedan</td>
                    <td><span class="badge badge-primary">Selesai</span></td>
                    <td class="td-actions">
                      <a href=""  rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="Detail">
                        <i class="material-icons">remove_red_eye</i><div class="ripple-container"></div>
                      </a>
                      <a href=""  rel="tooltip" title="" class="btn btn-warning btn-link btn-sm" data-original-title="Edit">
                        <i class="material-icons">edit</i><div class="ripple-container"></div>
                      </a>
                      <a href="" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" data-original-title="Delete">
                        <i class="material-icons">clear</i><div class="ripple-container"></div>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>27-Agustus-2019</td>
                    <td>Peletakan Batu Kanal Barat</td>
                    <td>Anies Baswedan</td>
                    <td>Basuki Purnama</td>
                    <td><span class="badge badge-warning">Process</span></td>
                    <td class="td-actions">
                      <a href=""  rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="Detail">
                        <i class="material-icons">remove_red_eye</i><div class="ripple-container"></div>
                      </a>
                      <a href=""  rel="tooltip" title="" class="btn btn-warning btn-link btn-sm" data-original-title="Edit">
                        <i class="material-icons">edit</i><div class="ripple-container"></div>
                      </a>
                      <a href="" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" data-original-title="Delete">
                        <i class="material-icons">clear</i><div class="ripple-container"></div>
                      </a>
                    </td>
                  </tr> -->
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
<script src="{{ asset('bower_components')}}/datatables.net-bs/js/dataTables.rowGroup.min.js"></script>

<script>
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('pelayanan.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'bulan', name: 'bulan'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'perihal', name: 'perihal'},
        {data: 'pengirim', name: 'pengirim'},
        {data: 'penerima', name: 'penerima'},
        {data: 'status_pelayanan', name: 'status_pelayanan'},
        {data: 'action', name: 'action'},
      ],
      order: [[1,'desc'], [2,'desc']],
      rowGroup: {
        dataSrc: ['bulan']
      },
      columnDefs: [{
        targets: [1],
        visible: false
      }]
    });
</script>
@endpush