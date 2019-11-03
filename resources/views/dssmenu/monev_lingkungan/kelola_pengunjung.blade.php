@extends('dssmenu.monev')

@section('content_monev_lingkungan')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-info alert-with-icon" data-notify="container">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                  </button>
                  <span data-notify="message">Grafik data <strong>pengunjung</strong> dapat dilihat berdasarkan tahun yang dipilih.
                </div>
                <div class="container" id="app">
                <pengunjung-component></pengunjung-component>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Data tables monev pemanfaatan -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title ">Kelola Data Tingkat Pengunjung</h4>
                <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
            </div>
            <div class="card-body">
                <div class="bd-example text-right">
                    <a href="{{ route('tingkat_pengunjung.create') }}" title="Tambah Data" data-target="#modal" class="btn btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
                </div>
                <div class="row">
                    <!-- <div class="col-md-12">
                    <h5><i class="fa fa-text-width"></i> &nbsp;Kategori:</h5>
                    <ol>
                        <li>W1 <strong>(Pelajar)</strong></li>
                        <li>W2  <strong>(Umum)</strong></li>
                        <li>W3  <strong>(Dinas)</strong></li>
                        <li>W4  <strong>(Mancanegara)</strong></li>
                    </ol>
                    </div> -->
                    <!-- <div class="col-md-3 social-buttons-demo">
                        <a href="{{ route('tingkat_pengunjung.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-social btn-fill btn-facebook btn-sm modal-show"><i class="material-icons">add</i>Tambah Data<div class="ripple-container"></div></a>
                    </div> -->
                    <!-- <div class="col-md-3 social-buttons-demo">
                        <button id="disable" class="btn btn-social btn-fill btn-facebook btn-sm"><i class="fa fa-gear"></i>&nbsp; Disable Kelola<div class="ripple-container"></div></button>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-6">
                    </div>
                </div>
                <div class="table-responsive">
                    <table  id="datatable" class="table table-bordered">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th rowspan="2" class="th-index">No</th>
                            <th rowspan="2">Faktor_id</th>
                            <th rowspan="2">Tanggal</th>
                            <th rowspan="2">Bulan</th>
                            <th rowspan="2">Tahun</th>
                            <th colspan="4">Wisatawan</th>
                            <th rowspan="2">Total</th>
                            <th rowspan="2">Keterangan</th>
                            <th rowspan="2" class="th-actions">Action</th>
                        </tr>
                        <tr class="text-center">
                            <th>Pelajar</th>
                            <th>Umum</th>
                            <th>Dinas</th>
                            <th>Mancanegara</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        
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
    }
    .th-actions{
        text-align:center;
    }
    table.dataTable tr.dtrg-group.dtrg-level-0 td{
        font-weight: bold;
        text-align: left !important;
    }
    table.dataTable tr.dtrg-group.dtrg-level-1 td, table.dataTable tr.dtrg-group.dtrg-level-2 td{
      padding-top: 0.25em;
      padding-bottom: 0.25em;
      padding-left: 4em !important;
      font-size: 1em;
      font-weight: normal;
      text-align: left !important;
    }

    table.dataTable tr.dtrg-group.dtrg-level-1 td{
        font-style:italic;
    }

    ol li {
        display: inline;
        margin-right: 10px;
    }

    /* th:nth-child(5), td:nth-child(5){
        display: none;
    } */

    

</style>
@endpush
@push('scripts')
<script src="{{ asset('material/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('material/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('bower_components')}}/datatables.net-bs/js/dataTables.rowGroup.min.js"></script>
<script>
    $(document).ready(function(){
    $('#disable').click(function(){
        $('.btn_show').addClass('hide');
        $('.btn_edit').addClass('hide');
        $('.btn_delete').addClass('hide');
        $('.th-actions').addClass('hide');
    })
})

   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('tingkat_pengunjung.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'monev_pemanfaatan.judul', name: 'monev_pemanfaatan.judul'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'bulan', name: 'bulan'},
        {data: 'tahun', name: 'tahun'},
        {data: 'pelajar', name: 'pelajar'},
        {data: 'umum', name: 'umum'},
        {data: 'dinas', name: 'dinas'},
        {data: 'mancanegara', name: 'mancanegara'},
        {data: 'total', name: 'total'},
        {data: 'keterangan', name: 'keterangan'},
        {data: 'action', name: 'action'},
      ],
      order: [[4,'desc'], [3,'desc']],
      rowGroup: {
        dataSrc: ['tahun', 'monev_pemanfaatan.judul', 'bulan']
      },
      columnDefs: [{
        targets: [1,2,3,4],
        visible: false
      }]
    });
</script>
@endpush