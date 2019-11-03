@extends('dssmenu.monev')

@section('content_monev_lingkungan')

<!-- <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <div id="googleMap" style="width:100%;height:380px;"></div>
                <form action="" method="post">
                    <input type="text" id="lat" name="lat" value="">
                    <input type="text" id="lng" name="lng" value="">
                </form>
            </div>
        </div>
    </div>
</div> -->
<!-- Data tables monev stabilitas - titik kontrol -->
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title ">Kelola Data Kemiringan Dinding</h4>
            <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
        </div>
        <div class="card-body">
        <!-- <div class="row">
            <div class="col-md-3 social-buttons-demo">
                <a href="{{ route('kemiringan_dinding.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-social btn-fill btn-facebook modal-show"><i class="material-icons">add</i>Tambah Data<div class="ripple-container"></div></a>
            </div>
        </div> -->
        <div class="bd-example text-right">
            <a href="{{ route('kemiringan_dinding.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
            <a href="{{ route('kemiringan_dinding.import') }}" title="Import Data" data-target="#modal" class="btn btn-outline-success modal-show"><i class="fa fa-file-excel-o"></i> Import Data</a>
        </div>
        <div class="table-responsive">
            <table  id="datatable" class="table table-bordered">
                <thead class=" text-primary thead-light text-center">
                    <tr>
                        <th rowspan="2" class="th-index">No</th>
                        <th rowspan="2">Candi_id</th>
                        <th rowspan="2">Bulan</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Lokasi</th>
                        <th rowspan="2">Titik</th>
                        <th colspan="2">Kemiringan</th>
                        <th colspan="2">Dibanding Pedoman</th>
                        <th rowspan="2" class="th-actions">Action</th>
                    </tr>
                    <tr>
                        <th>X</th>
                        <th>Y</th>
                        <th>iX</th>
                        <th>iY</th>
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
      ajax:"{{ route('kemiringan_dinding.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'candi.nama', name: 'candi.nama'},
        {data: 'bulan', name: 'bulan'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'lokasi', name: 'lokasi'},
        {data: 'titik', name: 'titik'},
        {data: 'kemiringan_x', name: 'kemiringan_x'},
        {data: 'kemiringan_y', name: 'kemirinan_y'},
        {data: 'selisih_x', name: 'selisih_x'},
        {data: 'selisih_y', name: 'selisih_y'},
        {data: 'action', name: 'action'},
      ],
      orderFixed: [[2,'desc'],[5,'asc']],
      rowGroup: {
        dataSrc: ['bulan', 'candi.nama', 'lokasi']
      },
      columnDefs: [{
        targets: [1,2, 3, 4],
        visible: false
      }]
    });
</script>
<script>
// var marker;
// function taruhMarker(peta, posisiTitik){
//     if( marker ){
//       // pindahkan marker
//       marker.setPosition(posisiTitik);
//     } else {
//       // buat marker baru
//       marker = new google.maps.Marker({
//         position: posisiTitik,
//         map: peta
//       });
//     }
  
//      // isi nilai koordinat ke form
//     document.getElementById("lat").value = posisiTitik.lat();
//     document.getElementById("lng").value = posisiTitik.lng();
    
// }

// function initialize() {
//   var propertiPeta = {
//     center:new google.maps.LatLng(-2.548926,118.0148634),
//     zoom:5,
//     mapTypeId:google.maps.MapTypeId.ROADMAP
//   };
  
//   var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
  
//   // membuat Marker
//   var marker=new google.maps.Marker({
//       position: new google.maps.LatLng(-8.5830695,116.3202515),
//       map: peta,
//       icon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png"
//   });

//   google.maps.event.addListener(peta, 'click', function(event) {
//     taruhMarker(this, event.latLng);
//   });

// }

// // event jendela di-load  
// google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endpush