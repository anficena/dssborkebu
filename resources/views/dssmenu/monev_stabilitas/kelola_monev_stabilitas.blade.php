@extends('dssmenu.monev')

@section('content_monev_lingkungan')

<!-- Data tables monev stabilitas - titik kontrol -->
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title ">Kelola Data Monev Stabilitas</h4>
            <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
        </div>
        <div class="card-body">
        <!-- <div class="row">
            <div class="col-md-3 social-buttons-demo">
                <a href="{{ route('kemiringan_dinding.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-social btn-fill btn-facebook modal-show"><i class="material-icons">add</i>Tambah Data<div class="ripple-container"></div></a>
            </div>
        </div> -->
        <div class="bd-example text-right">
            <a href="{{ route('monev_stabilitas.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
        </div>
        <div class="table-responsive">
            <table  id="datatable" class="table table-bordered">
                <thead class="text-primary thead-light">
                    <th class="th-index">No</th>
                    <th>ID</th>
                    <th>Tahun</th>
                    <th>Tanggal</th>
                    <th>Candi</th>
                    <th>Judul</th>
                    <th>Lampiran</th>
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
    td a.btn-success{
        visibility: hidden;
    }
    
    .th-index{
        width: 5%;
    }
    .th-actions{
        text-align:center;
    }

    thead{
      font:caption;
      line-height: 35px;
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
<!-- <script src="http://maps.googleapis.com/maps/api/js"></script> -->
<script>
    $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('monev_stabilitas.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'id', name: 'id'},
        {data: 'tahun', name: 'tahun'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'candi.nama', name: 'candi.nama'},
        {data: 'judul', name: 'judul'},
        {data: 'lampiran', name: 'lampiran'},
        {data: 'action', name: 'action'},
      ],
      orderFixed: [[2,'desc'],[3,'desc']],
      rowGroup: {
        dataSrc: ['tahun']
      },
      columnDefs: [{
        targets: [2],
        visible: false
      },
      {
        orderable: false, targets: [6, 7]
      }]
    });

</script>
@endpush