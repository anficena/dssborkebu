@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'kemitraan', 'title' => __('SOC')])

@section('content')
@section('content')
<!-- <div class="container" style="height: auto;"> -->
  @include("dssmenu.kemitraan");
<!-- </div> -->
@endsection
@push('styles')
  <style>
  .th-actions, td:nth-child(8), a.btn{
    display: none;
  }
  </style>
@endpush
@push('scripts')
  <script>
    $(document).ready(function(){
      $('.content').removeClass('content').addClass('container');
    });
  </script>
@endpush