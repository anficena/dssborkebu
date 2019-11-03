@extends('layouts.app', ['activePage' => 'soc', 'titlePage' => __('SOC')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-success">
                  <h4 class="card-title ">Kelola Data FGD</h4>
                  <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
              </div>
              <div class="card-body">
                <div class="col-md-4">
                  <label>Pilih Tahun</label>
                  {!! Form::select('soc_tahun', $tahun, null, ['class' => 'custom-select', 'id' => 'soc_tahun']) !!} 
                </div>
                <br/>
                <div id="map"></div>
                <br/>
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('soc.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-outline-success modal-show"><i class="material-icons">add</i>Tambah Data<div class="ripple-container"></div></a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table id="datatable" class="table table-bordered">
                    <thead>
                      <th class="th-index">No</th>
                      <th>Tahun</th>
                      <th>Tanggal</th>
                      <th>ID</th>
                      <th>Nama </th>
                      <th>Kategori</th>
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
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              <div class="alert alert-info alert-with-icon" data-notify="container">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span data-notify="message">Grafik data <strong>SOC</strong> dapat dilihat berdasarkan tahun yang dipilih.
              </div>
              <div class="container" id="app">
                <soc-component></soc-component>
                  
                  <!-- <script>
                        window.Laravel = <?php echo json_encode([
                            'csrfToken' => csrf_token(),
                          ]); ?>
                  </script> -->
              </div>
            </div>
          <!-- <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Rekapitulasi Data</h4>
                </div>
                <div class="card-body">
                  <form>
                    <div class="form-row">
                      <div class="col-md-3">
                        <label for="exampleInputEmail1">Tanggal Awal</label>
                        <input type="date" class="form-control" placeholder="First name">
                      </div>
                      <div class="col-md-3">
                        <label for="exampleInputEmail1">Tanggal Akhir</label>
                        <input type="date" class="form-control" placeholder="Last name">
                      </div>
                      <div class="col-md-3">
                        <label for="exampleInputEmail1">Kategori</label>
                        <input type="text" class="form-control" placeholder="Last name">
                      </div>
                      <div class="col-md-3">
                        <label for="exampleInputEmail1">Instansi</label>
                        <input type="text" class="form-control" placeholder="Last name">
                      </div>
                    </div>
                    <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
            </div>
          </div> -->
          <!-- <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Rekapitulasi Data</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable" class="table">
                      <thead class=" text-primary">
                        <th class="th-index">ID</th>
                        <th>Tanggal</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Instansi</th>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>       
          </div>
          <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Rekapitulasi Data</h4>
                </div>
                
                  <div class="col-md-12">
                    <div class="card card-chart">
                        <div class="card-header">
                          <div class="ct-chart" id="websiteViewsChart"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-bar" style="width: 100%; height: 100%;"><g class="ct-grids"><line y1="120" y2="120" x1="40" x2="263.65625" class="ct-grid ct-vertical"></line><line y1="96" y2="96" x1="40" x2="263.65625" class="ct-grid ct-vertical"></line><line y1="72" y2="72" x1="40" x2="263.65625" class="ct-grid ct-vertical"></line><line y1="48" y2="48" x1="40" x2="263.65625" class="ct-grid ct-vertical"></line><line y1="24" y2="24" x1="40" x2="263.65625" class="ct-grid ct-vertical"></line><line y1="0" y2="0" x1="40" x2="263.65625" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><line x1="49.319010416666664" x2="49.319010416666664" y1="120" y2="54.959999999999994" class="ct-bar" ct:value="542" opacity="1"></line><line x1="67.95703125" x2="67.95703125" y1="120" y2="66.84" class="ct-bar" ct:value="443" opacity="1"></line><line x1="86.59505208333333" x2="86.59505208333333" y1="120" y2="81.6" class="ct-bar" ct:value="320" opacity="1"></line><line x1="105.23307291666667" x2="105.23307291666667" y1="120" y2="26.400000000000006" class="ct-bar" ct:value="780" opacity="1"></line><line x1="123.87109375" x2="123.87109375" y1="120" y2="53.64" class="ct-bar" ct:value="553" opacity="1"></line><line x1="142.50911458333331" x2="142.50911458333331" y1="120" y2="65.64" class="ct-bar" ct:value="453" opacity="1"></line><line x1="161.14713541666666" x2="161.14713541666666" y1="120" y2="80.88" class="ct-bar" ct:value="326" opacity="1"></line><line x1="179.78515624999997" x2="179.78515624999997" y1="120" y2="67.92" class="ct-bar" ct:value="434" opacity="1"></line><line x1="198.42317708333331" x2="198.42317708333331" y1="120" y2="51.84" class="ct-bar" ct:value="568" opacity="1"></line><line x1="217.06119791666666" x2="217.06119791666666" y1="120" y2="46.8" class="ct-bar" ct:value="610" opacity="1"></line><line x1="235.69921874999997" x2="235.69921874999997" y1="120" y2="29.28" class="ct-bar" ct:value="756" opacity="1"></line><line x1="254.33723958333331" x2="254.33723958333331" y1="120" y2="12.599999999999994" class="ct-bar" ct:value="895" opacity="1"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="40" y="125" width="18.638020833333332" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 19px; height: 20px;">J</span></foreignObject><foreignObject style="overflow: visible;" x="58.63802083333333" y="125" width="18.638020833333332" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 19px; height: 20px;">F</span></foreignObject><foreignObject style="overflow: visible;" x="77.27604166666666" y="125" width="18.638020833333336" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 19px; height: 20px;">M</span></foreignObject><foreignObject style="overflow: visible;" x="95.9140625" y="125" width="18.63802083333333" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 19px; height: 20px;">A</span></foreignObject><foreignObject style="overflow: visible;" x="114.55208333333333" y="125" width="18.63802083333333" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 19px; height: 20px;">M</span></foreignObject><foreignObject style="overflow: visible;" x="133.19010416666666" y="125" width="18.638020833333343" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 19px; height: 20px;">J</span></foreignObject><foreignObject style="overflow: visible;" x="151.828125" y="125" width="18.638020833333314" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 19px; height: 20px;">J</span></foreignObject><foreignObject style="overflow: visible;" x="170.46614583333331" y="125" width="18.638020833333343" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 19px; height: 20px;">A</span></foreignObject><foreignObject style="overflow: visible;" x="189.10416666666666" y="125" width="18.638020833333343" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 19px; height: 20px;">S</span></foreignObject><foreignObject style="overflow: visible;" x="207.7421875" y="125" width="18.638020833333314" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 19px; height: 20px;">O</span></foreignObject><foreignObject style="overflow: visible;" x="226.38020833333331" y="125" width="18.638020833333343" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 19px; height: 20px;">N</span></foreignObject><foreignObject style="overflow: visible;" x="245.01822916666666" y="125" width="30" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 30px; height: 20px;">D</span></foreignObject><foreignObject style="overflow: visible;" y="96" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">0</span></foreignObject><foreignObject style="overflow: visible;" y="72" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">200</span></foreignObject><foreignObject style="overflow: visible;" y="48" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">400</span></foreignObject><foreignObject style="overflow: visible;" y="24" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">600</span></foreignObject><foreignObject style="overflow: visible;" y="0" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">800</span></foreignObject><foreignObject style="overflow: visible;" y="-30" x="0" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">1000</span></foreignObject></g></svg></div>
                        </div>
                      
                      
                    </div>
                  </div>
                
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('styles')
<!-- Data table -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap4.min.css') }}">
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

  /* .btn-success {
      visibility: hidden;
  } */
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
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script>
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('soc.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'tahun', name: 'tahun'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'decision_id', name: 'decision_id'},
        {data: 'decision', name: 'decision'},
        {data: 'kategori', name: 'kategori'},
        {data: 'action', name: 'action'},
      ],
      order: [[1,'dsc']],
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
      $('body').on('change', 'select[name="soc_tahun"]', function(event){
      var tahun = $('#soc_tahun').val();
      console.log(tahun);

      jQuery.ajax({
        url : '/soc/data/map/' + tahun,
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
                  title : places[p].decision_id + " - " + places[p].decision
              });
              bindInfoWindow(marker, map, infowindow, 
                  '<h6>'+ places[p].decision +'</h6> <p> <i class="fa fa-fw fa-key"></i><strong>ID</strong>: '+ places[p].decision_id +' &ensp; <i class="fa fa-fw fa-archive"></i><strong>Kategori</strong> : '+ places[p].kategori +' &ensp; <i class="fa fa-fw fa-calendar"></i><strong>Uploaded</strong> : '+ places[p].tanggal +' &ensp; <img src="'+ places[p].image +'" alt="" class="img-thumbnail" style="height:400px;"><p><strong>Keterangan</strong>: "'+ places[p].keterangan +'"</p><p><a href="'+ places[p].file +'"><i class="fa fa-file-o"></i>&nbsp;Download File</a>'
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