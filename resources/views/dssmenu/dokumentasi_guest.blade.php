@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'pelayanan', 'title' => __('SOC')])

@section('content')
<div class="container">
  <div class="row">
      <div id="app" class="col-md-12">
        <div id="publikasi-content">
          <publikasi-content-component></publikasi-content-component>
        </div>
      </div>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <label>Pilih Tahun</label>
          {!! Form::select('pameran_tahun', $tahun, null, ['class' => 'custom-select', 'id' => 'pameran_tahun']) !!} 
        </div>
        <br/>
        <br/>
        <div class="col-md-12">
          <div id="map"></div>
        </div>
        <br/>
      </div>
    </div>
  </div>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
      <!-- <div class="card">
        <div class="card-body"> -->
            <div class="bd-example text-center">
              <a href="{{route('dokumentasi.kategori','arsitektur')}}" id="arsitektur" title="Arsitektur Candi"  class="btn btn-primary active">Arsitektur Candi</a>
              <a href="{{route('dokumentasi.kategori','mow')}}" id="mow" title="MOW Pemugaran"  class="btn btn-primary active">Mow Pemugaran</a>
              <a href="{{route('dokumentasi.kategori','video')}}" id="video" title="Video"  class="btn btn-primary active">Video</a>
              <a href="{{route('dokumentasi.kategori','photo')}}" id="photo" title="Photo"  class="btn btn-primary active">Photo</a>
            </div>
            <!-- <br/>
            <div class="col-sm-12">
              <div class="alert alert-info" role="alert">
                This is a primary alert—check it out!
              </div>
            </div>  -->
        <!-- </div>
      </div> -->
      </div>
    </div>
    <div class="row" id="kategori">
      @include('dssmenu.partials.dokumentasi_content')
    </div>
  </div>
</div>
</div>
@endsection
@push('styles')
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

  th.jml{
    width:10%;
  }

  table#datatable-mow a.btn-success{
    visibility: hidden;
  }

  .card-img-top{
    height:200px;
    width: 100%;
  }

  .card-footer{
    justify-content: left !important;
    border-top: 1px solid rgba(0,0,0,.12) !important;
  }

  #map{
    height: 500px;
    width: 100%;
    margin-top: 20px;
  }
</style>
@endpush
@push('scripts')
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
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