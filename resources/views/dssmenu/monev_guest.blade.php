@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'monev', 'title' => __('SOC')])

@section('content')
<div class="container" style="height: auto;">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title ">Monev Lingkungan</h4>
            <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
          </div>
          <div class="card-body">
            <div class="container" id="app">
                <div class="alert alert-info alert-with-icon" data-notify="container">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span data-notify="message">Berikut adalah grafik monitoring dan evaluasi <strong>keterawatan batu</strong></span>
                </div>
                <monev_batu-component></monev_batu-component>
                <div class="alert alert-info alert-with-icon" data-notify="container">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span data-notify="message">Berikut adalah grafik monitoring dan evaluasi <strong>iklim</strong></span>
                </div>
                <iklim-component></iklim-component>
                <div class="alert alert-info alert-with-icon" data-notify="container">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span data-notify="message">Berikut adalah grafik monitoring dan evaluasi <strong>kedalman sumur penduduk</strong></span>
                </div>
                <kedalaman-sumur-component></kedalaman-sumur-component>
                <div class="alert alert-info alert-with-icon" data-notify="container">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span data-notify="message">Berikut adalah grafik monitoring dan evaluasi <strong>kedalman sumur resapan</strong></span>
                </div>
                <kedalaman-resapan-component></kedalaman-resapan-component>
                
                <div class="alert alert-warning alert-with-icon" data-notify="container">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span data-notify="message">Berikut adalah grafik monitoring dan evaluasi <strong>TINGKAT PENGUNJUNG</strong> yang terhimpun didalam sistem</span>
                </div>
                <pengunjung-component></pengunjung-component>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection