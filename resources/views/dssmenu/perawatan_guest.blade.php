@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'perawatan', 'title' => __('SOC')])

@section('content')
<!-- <div class="container" style="height: auto;"> -->
  @include("dssmenu.perawatan");
<!-- </div> -->
@endsection
@push('styles')
  <style>
  .th-actions, td:nth-child(6), a.btn{
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