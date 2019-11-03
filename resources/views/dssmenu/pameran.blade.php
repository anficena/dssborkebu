@extends('layouts.app', ['activePage' => 'publikasi', 'titlePage' => __('Publikasi')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bd-example text-center">
                    <a href="{{ route('publikasi') }}" title="publikasi"  class="btn btn-info">Publikasi</a>
                    <a href="{{ route('pameran.index') }}" title="pameran"  class="btn btn-info">Pameran</a>
                </div>
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title ">Kelola Data Pameran</h4>
                        <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                    </div>
                    
                    <div class="card-body">
                        <div class="col-md-4">
                          <label>Pilih Tahun</label>
                          {!! Form::select('pameran_tahun', $tahun, null, ['class' => 'custom-select', 'id' => 'pameran_tahun']) !!} 
                        </div>
                        <br/>
                        <div id="map"></div>
                        <br/>
                        <div class="bd-example text-right">
                            <a href="{{ route('pameran.create') }}" title="Tambah Data" data-target="#modal" class="btn btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered">
                                <thead class="thead-light">
                                <th class="th-index">ID</th>
                                <th>Tahun</th>
                                <th>Tanggal</th>
                                <th>Kegiatan</th>
                                <th>Tema</th>
                                <th>Lokasi</th>                  
                                <th>Pengunjung</th>
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
        <!-- <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="bd-example text-right">
                        <a href="{{ route('pameran.create') }}" title="Tambah Data" data-target="#modal" class="btn btn btn-outline-primary modal-show"><i class="fa fa-fw fa-plus"></i> Tambah Data<div class="ripple-container"></div></a>
                    </div>
                    <div id="map"></div>
                </div>
            </div>
          </div>
        </div> -->
    </div>
</div>
@endsection
@push('styles')
<!-- Data table -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}"> -->
<style>
  .label-info{
    background-color:#34b0a5;
    border-radius: 4px;
    padding:2px;
  }
  .img-thumbnail{
    margin-right:15px;
  }

  .th-index{
    width:5%;
  }
  .th-actions{
    width:15%;
  }
  td a.btn-sm{
    padding: 0.40625rem 0.5rem !important;
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
    font-weight: bold;
    padding-top: 0.25em;
    padding-bottom: 0.25em;
    padding-left: 4em !important;
    font-size: 1em;
  }

  .btn-success {
      visibility: hidden;
  }
  #map{
        height: 500px;
        width: 100%;
    }
  
</style>
@endpush
@push('scripts')
<script src="{{ asset('material/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('material/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('bower_components')}}/datatables.net-bs/js/dataTables.rowGroup.min.js"></script>
<!-- <script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script> -->
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script>
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('pameran.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'tahun', name: 'tahun'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'nama', name: 'nama'},
        {data: 'tema', name: 'tema'},
        {data: 'tempat', name: 'tempat'},
        {data: 'pengunjung', name: 'pengunjung'},
        {data: 'action', name: 'action'},
      ],
      order: [[1,'desc']],
      rowGroup: {
        dataSrc: ['tahun']
      },
      columnDefs: [{
        targets: [1],
        visible: false
      }]
    });
</script>
<script>
    var map;
    var geocorder;
    var places;
    var markers = [];

    function initialize() {
        // create the geocoder
        geocoder = new google.maps.Geocoder();
        
        // set some default map details, initial center point, zoom and style
        var mapOptions = {
            center: new google.maps.LatLng(-2.548926,118.0148634),
            zoom: 5,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        // create the map and reference the div#map-canvas container
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        // fetch the existing places (ajax) 
        // and put them on the map
        fetchPlaces();
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    
    function reloadMarker(){
      for (var i=0; i<markers.length; i++) {

      markers[i].setMap(null);
      }
      // Reset the markers array
      markers = [];
    }

    var fetchPlaces = function() {
      var infowindow =  new google.maps.InfoWindow({
          content: ''
      });
      $('body').on('change', 'select[name="pameran_tahun"]', function(event){
      var tahun = $('#pameran_tahun').val();
      console.log(tahun);

      jQuery.ajax({
        url : '/pameran/data/' + tahun,
        dataType : 'json',
        success : function(response) {
          console.log(response);
            reloadMarker();
            places = response.data;
            // loop through places and add markers
            for (p in places) {
              //create gmap latlng obj
              tmpLatLng = new google.maps.LatLng( places[p].latitude, places[p].longitude);
              // make and place map maker.
              var marker = new google.maps.Marker({
                  map: map,
                  position: tmpLatLng,
                  title : places[p].nama + " - " + places[p].tempat
              });
              bindInfoWindow(marker, map, infowindow, 
                  '<h6>'+ places[p].nama +'</h6> <p> <i class="fa fa-fw fa-building"></i><strong>Lokasi</strong> : '+ places[p].tempat +' &ensp; <i class="fa fa-fw fa-calendar"></i><strong>Pelaksanan</strong> : '+ places[p].tanggal +' &ensp; <i class="fa fa-fw fa-users"></i><strong>Pengunjung</strong>: '+ places[p].pengunjung +'</p> <p><strong>Tema</strong>: <i> "'+ places[p].tema +'" </i></p><img src="'+ places[p].photo +'" alt="" class="img-thumbnail" style="height:400px;">'
              );
              // not currently used but good to keep track of markers
              markers.push(marker);
            }
        }
      })
    });
    };
    // binds a map marker and infoWindow together on click
    var bindInfoWindow = function(marker, map, infowindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(html);
            infowindow.open(map, marker);
        });
    }
</script>
@endpush