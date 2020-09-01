<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  @yield('css')
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>


    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            
          </ul>
     

      
          <!-- Right navbar links -->
          <div class="navbar-nav ml-auto">
              <!-- SEARCH FORM -->
              <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
          </div>
        </nav>
        <!-- /.navbar -->
        @if(session()->has('success'))
          <div class="alert alert-success text-center">{{session()->get('success')}} </div>
        @endif 
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

      
          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
              </div>
            </div>
      
            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                  <a href=" {{ route('home')}} " class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      {{ __('Dashboard') }}
                    </p>
                  </a>
                </li>





                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                      {{__('Courrier')}}
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('courrier.index') }}" class="nav-link">
                        <i class="nav-icon far fa-circle"></i>
                        <p>{{__('List des courriers')}}</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('typecourrier.index') }}" class="nav-link">
                        <i class="nav-icon far fa-circle"></i>
                        <p>{{__('Types')}}</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('mention.index') }}" class="nav-link">
                        <i class="nav-icon far fa-circle"></i>
                        <p>{{__('Montions')}}</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('classement.index') }}" class="nav-link">
                        <i class="nav-icon far fa-circle"></i>
                        <p>{{__('Classements')}}</p>
                      </a>
                    </li>
                  </ul>
                </li>







                <li class="nav-item has-treeview">
                <a href="{{ route('service.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                      {{__('Service')}} 
                     
                    </p>
                  </a>
                </li>

                <li class="nav-item has-treeview">
                  <a href="{{ route('users.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-chart-pie"></i>
                      <p>
                        {{__('Utilisateurs')}} 
                       
                      </p>
                    </a>
                  </li>










                <li class="nav-item has-treeview">
                  <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                      {{ __('Logout') }}
                    </p>
                  </a>
                  
                </li>

                
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>
      
        <main class="py-4">
            @yield('content')
        </main>
      
        <footer class="main-footer">
          <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.1
          </div>
          <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
          reserved.
        </footer>
      

      <!-- ./wrapper -->
      



    </div>


    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  
  @yield('datatable')
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
@yield('js')
  

</body>
</html>
