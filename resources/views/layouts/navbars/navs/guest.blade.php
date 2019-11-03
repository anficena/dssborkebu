<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="{{ route('home') }}"></a>
    </div>
    <button class="navbar-toggler" style="background-color:#fff;" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <!-- <li class="nav-item">
          <a href="{{ route('guest') }}" class="nav-link">
            <i class="material-icons">dashboard</i> {{ __('Masuk Sebagai Pengunjung') }}
          </a>
        </li> -->
        <li class="nav-item{{ $activePage == 'soc' ? ' active' : '' }}">
          <a href="{{ route('soc_guest') }}" class="nav-link">
          <i class="material-icons">dashboard</i> {{ __('SOC') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'monev' ? ' active' : '' }}">
          <a href="{{ route('monev_guest') }}" class="nav-link">
          <i class="fa fa-desktop"></i> {{ __('Monev') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'perawatan' ? ' active' : '' }} ">
          <a href="{{ route('perawatan_guest') }}" class="nav-link">
           <i class="fa fa-gears"></i> {{ __('Perawatan') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'kajian' ? ' active' : '' }} ">
          <a href="{{ route('kajian_guest') }}" class="nav-link">
          <i class="fa fa-file-text-o"></i> {{ __('Kajian & Studi') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'pelayanan' ? ' active' : '' }} ">
          <a href="{{ route('dokumentasi_guest') }}" class="nav-link">
          <i class="fa fa-film"></i> {{ __('Dok & Publikasi') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'kemitraan' ? ' active' : '' }} ">
          <a href="{{ route('kemitraan_guest') }}" class="nav-link">
          <i class="fa fa-users"></i> {{ __('Layanan & Kemitraan') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'kemitraan' ? ' active' : '' }} ">
          <a href="{{route('login')}}" class="btn btn-primary text-center">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->