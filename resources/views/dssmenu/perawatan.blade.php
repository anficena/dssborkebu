@extends('layouts.app', ['activePage' => 'perawatan', 'titlePage' => __('Perawatan dan Pemeliharaan')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-info alert-with-icon" data-notify="container">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                  </button>
                  <span data-notify="message">Grafik data <strong>perawatan & pemeliharaan</strong> dapat dilihat berdasarkan tahun yang dipilih.
                </div>
              <div class="container" id="app">
                <perawatan-component></perawatan-component>
                  
                  <!-- <script>
                        window.Laravel = <?php echo json_encode([
                            'csrfToken' => csrf_token(),
                          ]); ?>
                  </script> -->
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
              <h4 class="card-title ">Kelola Data Perawatan dan Pemeliharaan</h4>
              <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
          </div>
          <div class="card-body">
            <div class="bd-example text-right">
              <a href="{{ route('perawatan.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
            </div>
            <div class="table-responsive">
              <table id="datatable" class="table table-bordered">
                <thead class=" text-primary thead-light">
                  <th class="th-index">No</th>
                  <th>Candi</th>
                  <th>Aktivitas</th>
                  <th>Bulan</th>
                  <th>Tanggal</th>
                  <th>Kategori</th>
                  <th>lokasi</th>
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
.th-index{
        width: 5%;
    }
    .th-actions{
        text-align:center;
        width: 15%;
    }

    thead{
      font:caption;
      line-height:35px;
    }

    td a.btn-sm{
      padding: 0.40625rem 0.5rem !important;
    }

    table.dataTable tr.dtrg-group.dtrg-level-0 td{
        font-weight: bold;
    }
    table.dataTable tr.dtrg-group.dtrg-level-1 td {
        padding-top: 0.25em;
        padding-bottom: 0.25em;
        padding-left: 2em !important;
        font-size: 1em;
        font-weight: bold;
    }

    table.dataTable tr.dtrg-group.dtrg-level-2 td{
        padding-left: 4em !important;
        font-style: italic;
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
      ajax:"{{ route('perawatan.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'candi.nama', name: 'candi.nama'},
        {data: 'aktivitas', name: 'aktivitas'},
        {data: 'bulan', name: 'bulan'},
        {data: 'tanggal', name: 'tanggal'}, 
        {data: 'kategori', name: 'kategori'},
        {data: 'lokasi', name: 'lokasi'},
        {data: 'action', name: 'action'},
      ],
      order: [[3,'desc'], [4,'desc']],
      rowGroup: {
        dataSrc: ['bulan', 'candi.nama']
      },
      columnDefs: [{
        targets: [1,3],
        visible: false
      }]
    });
</script>
@endpush