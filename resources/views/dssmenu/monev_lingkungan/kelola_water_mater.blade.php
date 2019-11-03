@extends('dssmenu.monev')

@section('content_monev_lingkungan')

<!-- Data tables monev geohidrologi - kelola water mater -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-success">
                    <h4 class="card-title ">Kelola Data Monitoring Water Mater</h4>
                    <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 social-buttons-demo">
                        <a href="{{ route('water_mater.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-social btn-fill btn-facebook modal-show"><i class="material-icons">add</i>Tambah Data<div class="ripple-container"></div></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table  id="datatable" class="table">
                    <thead class=" text-primary">
                        <th class="th-index">No</th>
                        <th>Observasi_id</th>
                        <th>Waktu</th>
                        <th>Bulan</th>
                        <th>Lokasi</th>
                        <th>WMK</th>
                        <th>WMB</th>
                        <th>Photo</th>
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
      ajax:"{{ route('water_mater.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'monev_geohidrologi.judul', name: 'monev_geohidrologi.judul'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'bulan', name: 'bulan'},
        {data: 'lokasi', name: 'lokasi'},
        {data: 'wmk', name: 'wmk'},
        {data: 'wmb', name: 'wmb'},
        {data: 'photo', name: 'photo'},
        {data: 'action', name: 'action'},
      ],
      order: [[3,'desc']],
      rowGroup: {
        dataSrc: ['bulan','monev_geohidrologi.judul']
      },
      columnDefs: [{
        targets: [1,3],
        visible: false
      }]
    });
</script>
@endpush