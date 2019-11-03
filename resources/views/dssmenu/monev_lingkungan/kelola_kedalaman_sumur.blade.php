@extends('dssmenu.monev')

@section('content_monev_lingkungan')

<!-- Data tables monev geohidrologi - kedalaman sumur -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-info alert-with-icon" data-notify="container">
                    <i class="material-icons" data-notify="icon">add_alert</i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span data-notify="message">
                            1. Untuk menampilkan grafik data, silahkan pilih <strong>tahun</strong> dan <strong>bulan</strong>.<br/>
                            <!-- 2. Pilih 4 bulan (sesuai dengan ketentuan waktu pengukuran) yang sudah terisi lengkap data kedalaman sumur dari setiap lokasi. -->
                    </span>
                </div>
                <div class="container" id="app">
                    <kedalaman-sumur-component></kedalaman-sumur-component>
                        
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
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title ">Kelola Data Kedalaman Sumur Penduduk</h4>
                <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
            </div>
            <div class="card-body">
                <div class="bd-example text-right">
                    <a href="{{ route('kedalaman_sumur.create') }}" title="Tambah Data" data-target="#modal" class="btn btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
                    <a href="{{ route('kedalaman_sumur.import') }}" title="Import Data" data-target="#modal" class="btn btn-outline-success modal-show"><i class="fa fa-file-excel-o"></i> Import Data</a>
                </div>
                <div class="table-responsive">
                    <table  id="datatable" class="table table-bordered">
                    <thead class=" text-primary">
                        <th class="th-index">No</th>
                        <th>Observasi_id</th>
                        <th>Waktu</th>
                        <th>Bulan</th>
                        <th>Lokasi</th>
                        <th>Kedalaman</th>
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

<!-- END -->
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<style>
    .th-actions{
        text-align:center;
    }

    thead{
        font:caption;
        line-height: 35px;
    }

    .th-index{
      width:5%;
    }

    td a.btn-sm{
      padding: 0.40625rem 0.5rem !important;
    }
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
<script>
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('kedalaman_sumur.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'monev_geohidrologi.judul', name: 'monev_geohidrologi.judul'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'bulan', name: 'bulan'},
        {data: 'lokasi', name: 'lokasi'},
        {data: 'kedalaman', name: 'kedalaman'},
        {data: 'action', name: 'action'},
      ],
      order: [[2,'desc']],
      rowGroup: {
        dataSrc: ['monev_geohidrologi.judul','bulan']
      },
      columnDefs: [{
        targets: [1,3],
        visible: false
      }],
      aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
    });
</script>
@endpush