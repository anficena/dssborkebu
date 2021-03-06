@extends('dssmenu.monev')

@section('content_monev_lingkungan')

<!-- Data tables monev stabilitas - titik kontrol -->
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title ">Kelola Data Koordinat Titik Kontrol</h4>
            <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
        </div>
        <div class="card-body">
            <!-- <div class="row">
                <div class="col-md-3 social-buttons-demo">
                    <a href="{{ route('titik_kontrol.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-social btn-fill btn-facebook modal-show"><i class="material-icons">add</i>Tambah Data<div class="ripple-container"></div></a>
                </div>
            </div> -->
            <div class="bd-example text-right">
                <a href="{{ route('titik_kontrol.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
                <a href="{{ route('titik_kontrol.import') }}" title="Import Data" data-target="#modal" class="btn btn-outline-success modal-show"><i class="fa fa-file-excel-o"></i> Import Data</a>
            </div>
            <div class="table-responsive">
                <table  id="datatable" class="table table-bordered">
                    <thead class=" text-primary thead-light">
                        <tr class="text-center">
                            <th rowspan="2" class="th-index">No</th>
                            <th rowspan="2">Candi</th>
                            <th rowspan="2">Tahun</th>
                            <th rowspan="2">Lokasi</th>
                            <th rowspan="2">Tanggal</th>
                            <th rowspan="2">Titik</th>
                            <th colspan="3">Koordinat</th>
                            <th rowspan="2" class="th-actions">Action</th>
                        </tr>
                        <tr>
                            <th>(X)</th>
                            <th>(Y)</th>
                            <th>(Z)</th>
                        </tr>
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
    thead{
      font:caption;
    }
    .th-actions{
        text-align:center;
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
        font-weight: bold;
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
      ajax:"{{ route('titik_kontrol.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'candi.nama', name: 'candi.nama'},
        {data: 'tahun', name: 'tahun'},
        {data: 'nama_koordinat', name: 'nama_koordinat'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'titik', name: 'titik'},
        {data: 'sumbu_x', name: 'sumbu_x'},
        {data: 'sumbu_y', name: 'sumbu_y'},
        {data: 'sumbu_z', name: 'sumbu_z'},
        {data: 'action', name: 'action'},
      ],
      orderFixed: [[2,'asc']],
      rowGroup: {
        dataSrc: ['tahun','candi.nama','nama_koordinat']
      },
      columnDefs: [{
        targets: [1, 2, 3, 4],
        searchable: true,
        visible: false
      }]
    });
</script>
@endpush