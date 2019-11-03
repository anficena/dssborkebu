@extends('layouts.app', ['activePage' => 'settings', 'titlePage' => __('Settings Client')])

@section('content')
<div class="content">
  <div class="container-fluid">
        <div class="col-md-12 col-md-offset-2">    
            <div class="container" id="app">        
            <passport-authorized-clients></passport-authorized-clients>
            <passport-clients></passport-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
    </div>
</div>
@endsection
