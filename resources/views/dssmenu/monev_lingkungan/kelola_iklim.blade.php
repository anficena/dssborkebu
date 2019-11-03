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
                  <span data-notify="message">Grafik data <strong>Klimatologi</strong> dapat dilihat berdasarkan tahun yang dipilih.
                </div>
                <div class="container" id="app">
                  <iklim-component></iklim-component>
                  <!-- <canvas id="chart"></canvas> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Data tables monev lingkungan - observasi iklim -->
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title ">Kelola Data Klimatologi</h4>
            <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
        </div>
        <div class="card-body">
            <div class="bd-example text-right">
                <a href="{{ route('iklim.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
                <a href="{{ route('iklim.import') }}" title="Import Data" data-target="#modal" class="btn btn-outline-success modal-show"><i class="fa fa-file-excel-o"></i> Import Data</a>
            </div>
            <div class="table-responsive">
                <table  id="datatable" class="table table-bordered">
                <thead class=" text-primary">
                    <th class="th-index">ID</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Tahun</th>
                    <th>Bulan</th>
                    <th>Parameter</th>
                    <th>Hasil</th>
                    <th>Satuan</th>
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
    .th-actions{
        text-align:center;
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

    // $(".gear-disable").click(function(){
    //     $("th:nth-child(6)").css("display","none");
    //     $("td:nth-child(6)").css("display","none")
    // })
    
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('iklim.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'monev_lingkungan.judul', name: 'monev_lingkungan.judul'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'tahun', name: 'tahun'},
        {data: 'bulan', name: 'bulan'},
        {data: 'nama_data', name: 'nama_data'},
        {data: 'hasil', name: 'hasil'},
        {data: 'satuan', name: 'satuan'},
        {data: 'action', name: 'action'},
      ],
      order: [[3,'asc'],[4,'asc']],
      rowGroup: {
        dataSrc: ['bulan', 'monev_lingkungan.judul']
      },
      columnDefs: [{
        targets: [1, 3, 4],
        visible: false
      }],
      aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
    });

// var barChartData = {
//   labels: ['2016', '2017', '2018', '2019'],
//   datasets: [{
//     type: 'bar',
//     label: 'a',
//     id: "y-axis-0",
//     backgroundColor: "rgba(217,83,79,0.75)",
//     data: [1000, 2000, 4000, 5000]
//   }, {
//     type: 'bar',
//     label: 'b',
//     id: "y-axis-0",
//     backgroundColor: "rgba(92,184,92,0.75)",
//     data: [500, 600, 700, 800]
//   }, {
//     type: 'line',
//     label: 'c',
//     id: "y-axis-0",
//     backgroundColor: "rgba(51,51,51,0.5)",
//     data: [1500, 2600, 4700, 5800]
//   }, {
//     type: 'line',
//     label: 'd',
//     id: "y-axis-1",
//     backgroundColor: "rgba(151,187,205,0.5)",
//     data: [5000, 3000, 1000, 0]
//   }]
// };


// var ctx = document.getElementById("chart");
// // allocate and initialize a chart
// var ch = new Chart(ctx, {
//   type: 'bar',
//   data: barChartData,
//   options: {
//     title: {
//       display: true,
//       text: "Chart.js Bar Chart - Stacked"
//     },
//     tooltips: {
//       mode: 'label'
//     },
//     responsive: true,
//     scales: {
//       xAxes: [{
//         stacked: true
//       }],
//       yAxes: [{
//         stacked: true,
//         position: "left",
//         id: "y-axis-0",
//       }, {
//         stacked: false,
//         position: "right",
//         id: "y-axis-1",
//       }]
//     }
//   }
// });

</script>
@endpush