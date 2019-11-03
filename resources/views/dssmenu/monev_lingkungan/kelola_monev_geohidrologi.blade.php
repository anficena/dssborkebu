@extends('dssmenu.monev')

@section('content_monev_lingkungan')

<!-- Data tables monev geohidrologi -->
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title ">Kelola Data Kualitas Udara</h4>
            <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
        </div>
        <div class="card-body">
        <div class="bd-example text-right">
            <a href="{{ route('monev_geohidrologi.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
        </div>
        <div class="table-responsive">
            <table  id="datatable" class="table table-bordered">
            <thead class=" text-primary thead-light">
                <th class="th-index">No</th>
                <th>Candi</th>
                <th>Tahun</th>
                <th>Judul</th>
                <th>Mulai</th>
                <th>Selesai</th>
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
.th-index{
        width: 5%;
    }
    .th-actions{
        text-align:center;
    }

    thead{
      font:caption;
      line-height:35px;
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
      ajax:"{{ route('monev_geohidrologi.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'candi.nama', name: 'candi.nama'},
        {data: 'tahun', name: 'tahun'},
        {data: 'judul', name: 'judul'},
        {data: 'mulai', name: 'mulai'},
        {data: 'selesai', name: 'selesai'},
        {data: 'action', name: 'action'},
      ],
      order: [[2,'desc']],
      rowGroup: {
        dataSrc: ['tahun','candi.nama']
      },
      columnDefs: [{
        targets: [1,2],
        visible: false
      }]
    });
</script>
@endpush