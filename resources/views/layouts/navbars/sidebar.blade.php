<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('DSS KAWASAN BUDAYA') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fa fa-dashboard"></i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>

      <!--START MENU DSS-->
      <!-- <li class="nav-item{{ $activePage == 'settings' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('settings') }}">
        <i class="fa fa-desktop"></i>
            <p>{{ __('Settings Client') }}</p>
        </a>
      </li> -->
      <li class="nav-item{{ $activePage == 'kawasan' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('kawasan') }}">
        <i class="fa fa-bank"></i>
            <p>{{ __('Data Kawasan') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'soc' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('soc') }}">
          <i class="fa fa-calendar-check-o"></i>
            <p>{{ __('FGD') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'monev' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('monev') }}">
        <i class="fa fa-desktop"></i>
            <p>{{ __('Monitoring & Evaluasi') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'perawatan' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('perawatan') }}">
            <i class="fa fa-gears"></i>
            <p>{{ __('Perawatan & Pemeliharaan') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'studi' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('studi') }}">
          </i><i class="fa fa-file-text-o"></i>
            <p>{{ __('Kajian & Studi') }}</p> 
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="false">
        </i><i class="fa fa-film"></i>
          <p>{{ __('Dok & Publikasi') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'dokumentasi' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('dokumentasi.index') }}">
                <span class="sidebar-mini"> O </span>
                <span class="sidebar-normal">Dokumentasi </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'publikasi' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('publikasi') }}">
                <span class="sidebar-mini"> O </span>
                <span class="sidebar-normal"> Publikasi </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <!-- <li class="nav-item{{ $activePage == 'pelayanan' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pelayanan') }}">
        </i><i class="fa fa-commenting"></i>
            <p>{{ __('Pelayanan Masyarakat') }}</p>
        </a>
      </li> -->
      <li class="nav-item{{ $activePage == 'kemitraan' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('kemitraan') }}">
          </i><i class="fa fa-users"></i>
            <p>{{ __('Layanan & Kemitraan') }}</p>
        </a>
      </li>
      <!-- END MENU DSS -->

      <!-- <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Laravel Examples') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>


      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Table List') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('typography') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Typography') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Maps') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('language') }}">
          <i class="material-icons">language</i>
          <p>{{ __('RTL Support') }}</p>
        </a>
      </li>

      <li class="nav-item active-pro{{ $activePage == 'upgrade' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('upgrade') }}">
          <i class="material-icons">unarchive</i>
          <p>{{ __('Upgrade to PRO') }}</p>
        </a>
      </li> -->
    </ul>
  </div>
</div>