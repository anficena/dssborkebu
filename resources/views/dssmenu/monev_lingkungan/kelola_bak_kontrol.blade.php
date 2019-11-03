@extends('dssmenu.monev')

@section('content_monev_lingkungan')

<!-- Data tables monev lingkungan - kelola bak kontrol -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title ">Kelola Data Analisis Air Bak Kontrol</h4>
            <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-md-3 social-buttons-demo">
                <a href="{{ route('bak.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-social btn-fill btn-facebook modal-show"><i class="material-icons">add</i>Tambah Data<div class="ripple-container"></div></a>
            </div>
        </div>
        <div class="table-responsive">
            <table  id="datatable" class="table">
            <thead class=" text-primary">
                <th class="th-index">No</th>
                <th>Observasi_id</th>
                <th>Waktu</th>
                <th>Tahun</th>
                <th>Kategori</th>
                <th>Parameter</th>
                <th>Satuan</th>
                <th>Lokasi</th>
                <th>Hasil</th>
                <th>Standar</th>
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
<style>
    a.btn_show {
        visibility: hidden;
    }

    .th-actions{
        text-align:center;
    }

    thead{
      font:caption;
    }

    .th-index{
      width:5%;
    }

    td a.btn-sm{
      padding: 0.40625rem 0.5rem !important;
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
      ajax:"{{ route('bak.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'monev_lingkungan.judul', name: 'monev_lingkungan.judul'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'tahun', name: 'tahun'},
        {data: 'kategori', name: 'kategori'},
        {data: 'parameter', name: 'parameter'},
        {data: 'satuan', name: 'satuan'},
        {data: 'lokasi', name: 'lokasi'},
        {data: 'hasil', name: 'hasil'},
        {data: 'standar', name: 'standar'},
        {data: 'action', name: 'action'},
      ],
      order: [[3,'desc'], [2,'desc']],
      rowGroup: {
        dataSrc: ['tahun', 'monev_lingkungan.judul', 'kategori']
      },
      columnDefs: [{
        targets: [1,3,4],
        visible: false
      }]
    });
</script>
@endpush