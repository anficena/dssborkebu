@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'kajian', 'title' => __('SOC')])

@section('content')
<!-- <div class="container" style="height: auto;"> -->
  @include("dssmenu.kajian");
<!-- </div> -->
@endsection
@push('styles')
  <style>
  a.btn_edit, a.btn_delete, a.btn-outline-primary{
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