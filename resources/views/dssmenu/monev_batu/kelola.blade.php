@extends('dssmenu.monev')

@section('content_monev_lingkungan')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="container" id="app">
                  <div class="alert alert-info alert-with-icon" data-notify="container">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span data-notify="message">Grafik data <strong>keterawatan batu</strong> dapat dilihat berdasarkan jenis observasi dan tahun yang dipilih.
                </div>
                <monev_batu-component></monev_batu-component>
                    
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
<!-- Data tables monev keterawatan batu -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title ">Kelola Data Monev Keterawatan Batu</h4>
                <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
            </div>
            <div class="card-body">
              <div class="bd-example text-right">
                    <a href="{{ route('monev_batu.create') }}" title="Tambah Data" data-target="#modal" class="btn btn btn-outline-success modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
                </div>
                <div class="table-responsive">
                    <table  id="datatable" class="table table-bordered">
                    <thead class=" text-primary thead-light">
                        <th class="th-index">No</th>
                        <th>Candi</th>
                        <th>Tahun</th>
                        <th>Tanggal</th>
                        <th>Observasi</th>
                        <th>Hasil</th>
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
<script>  
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('monev_batu.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'candi.nama', name: 'candi.nama'},
        {data: 'tahun', name: 'tahun'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'jenis_observasi', name: 'jenis_observasi'},
        {data: 'jumlah', name: 'jumlah'},
        {data: 'action', name: 'action'},
      ],
      order: [[2,'dsc']],
      rowGroup: {
        dataSrc: ['tahun', 'candi.nama']
      },
      columnDefs: [{
        targets: [1, 2],
        visible: false
      }]
    });
</script>
@endpush