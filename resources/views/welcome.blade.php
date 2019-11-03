@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Material Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <br/><br/><br/>
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8 align-center">
          <h1 class="text-white text-center">{{ __('Selamat datang di halaman DSS Kawasan') }}</h1>
        <div class="col-md-12 text-center">
          <a href="{{route('login')}}" class="btn btn-primary text-center">Login Sebagai Admin</a>
        </div>
      </div>
  </div>
</div>
@endsection
