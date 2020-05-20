<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>GoChri | Admin</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin-lte/dist/css/adminlte.min.css')}}">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

  <!-- Main stylesheet -->
  <link rel="stylesheet" href="{{asset('css/admin.css')}}">

  <!-- Extra Styles -->
  @yield('styles')

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">GOCHRI</a>
      </li>

    </ul>


    <!-- Authentication Links -->
    <ul class="navbar-nav ml-auto">
    @guest
      <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      </li>
      @if (Route::has('register'))
          <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
      @endif
      @else
          <li class="nav-item">


                  <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
          </li>

    @endguest
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link text-center">
      <span class="brand-text font-weight-light"><img src="/storage/images/assets/gochri.png" alt="gochri logo" style="max-width:40%"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-4 pb-4 mb-4 d-flex align-items-center">
        <div class="image">
          <img src="{{ Str::contains(Auth::user()->image, 'https://') ? Auth::user()->image : '/storage/images/profiles/' . Auth::user()->image }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/admin/profile/{{Auth::id()}}/edit" class="d-block"><p class="m-0">{{Auth::user()->name}}</p></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


          <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="/admin/orders" class="nav-link {{ Request::is('admin/orders/*') || Request::is('admin/orders') ? 'active' : ''}}">
              <i class="fas fa-list-alt nav-icon"></i>
              <p>
                Les commandes
              </p>
            </a>
          </li>

          <br>

          <li class="nav-item has-treeview {{ Request::is('admin/products/*') || Request::is('admin/products') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ Request::is('admin/products/*') || Request::is('admin/products') ? 'active' : ''}}">
              <i class="fas fa-pizza-slice nav-icon"></i>
              <p>
                Les produits
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/products" class="nav-link {{ Request::is('admin/products') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Voir tous</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/products/create" class="nav-link {{ Request::is('admin/products/create') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nouveau produit</p>
                </a>
              </li>

            </ul>
          </li>


          <li class="nav-item has-treeview {{ Request::is('admin/categories/*') || Request::is('admin/categories') || Request::is('admin/subcategories/*') || Request::is('admin/subcategories') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ Request::is('admin/categories/*') || Request::is('admin/categories') || Request::is('admin/subcategories/*') || Request::is('admin/subcategories') ? 'active' : ''}}">
              <i class="fa fa-list nav-icon" aria-hidden="true"></i>

              <p>
                Les catégories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/categories" class="nav-link {{ Request::is('admin/categories') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Voir tous</p>
                </a>
              </li>

              <li class="nav-item has-treeview {{ Request::is('admin/subcategories/*') || Request::is('admin/subcategories') ? 'menu-open' : ''}}">
                <a href="#" class="nav-link {{ Request::is('admin/subcategories') || Request::is('admin/subcategories/*') ? 'active' : ''}}">
                  {{-- <i class="fas fa-boxes nav-icon"></i> --}}

                  <i class="fa fa-list-alt nav-icon" aria-hidden="true"></i>
                  <p>
                    Les sous-catégories
                    <i class="fas fa-angle-left right"></i>

                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/admin/subcategories" class="nav-link {{ Request::is('admin/subcategories') ? 'active' : ''}}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Voir tous</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin/subcategories/create" class="nav-link {{ Request::is('admin/subcategories/create') ? 'active' : ''}}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Ajouter</p>
                    </a>
                  </li>

                </ul>
              </li>

            </ul>
          </li>

          <br>

              <li class="nav-item">
                <a href="/admin/users" class="nav-link {{ Request::is('admin/users') | Request::is('admin/users/*') ? 'active' : ''}}">
                  <i class="fas fa-user-friends nav-icon"></i>
                  <p>
                    Les utilisateurs

                  </p>
                </a>
              </li>

               <hr>

              <li class="nav-item">
                <a href="/admin/profile/{{Auth::id()}}/edit" class="nav-link {{ Request::is('admin/profile/*/edit') ? 'active' : ''}}">
                  <i class="fas fa-user-edit nav-icon"></i>
                  <p>Profil</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/settings" class="nav-link {{ (Request::is('admin/settings') || Request::is('admin/settings/*')) ? 'active' : ''}}">
                  <i class="fa fa-cog nav-icon" style="margin-left:0;"></i>
                  <p>Paramètres</p>
                </a>
              </li>

            </ul>
      </nav>
      <!-- /.sidebar-menu -->






    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="admin">


    @yield('content')


  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer text-sm">

    <a href="/" class="text-warning float-left mr-2">Gochri.com</a>

    <span>Copyright &copy; 2020-2021 </span>

    <div class="float-right">
      All rights reserved.
    </div>

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Extra Scripts -->
@yield('scripts')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

<!-- overlayScrollbars -->
<script src="{{asset('admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('admin-lte/dist/js/adminlte.min.js')}}"></script>

<!-- Main Js File -->
<script src="{{asset('js/admin.js')}}"></script>

</body>
</html>
