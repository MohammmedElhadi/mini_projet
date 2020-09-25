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
    


    <link rel="stylesheet" href=" {{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href=" {{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href=" {{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{ asset('dist/css/adminlte.min.css') }}">
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
              @hasanyrole('chef_service|element')
              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <
                  <span class="badge badge-warning navbar-badge">nouveau courrier</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">{{Auth::user()->unreadNotifications()->count()}} Notifications</span>
                  <div class="dropdown-divider"></div>
                  @foreach (Auth::user()->unreadNotifications as $item)
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-mail-bulk    "></i> {{$item->data['expediteur']}}
                    {{-- <span class="float-right text-muted text-sm">2 days</span> --}}
                  </a>
                  <div class="dropdown-divider"></div>
                  @endforeach
                 
                  
                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
              </li>
              @endhasanyrole
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

        @if(session()->has('error'))
          <div class="alert alert-danger text-center">{{session()->get('error')}} </div>
        @endif 

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

      
          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <i class="fas fa-user-circle fa-3x" style="color:rgb(229, 226, 226)"></i>
              </div>
              <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->nom }}  {{ Auth::user()->prenom }}</a>
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
                    @role('admin')
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
                    @endrole
                  </ul>
                </li>






                
                
                @hasanyrole('admin|chef_service')
                <li class="nav-item has-treeview">
                  <a href="{{ route('users.index') }}" class="nav-link">
                      <i class="fa fa-users" aria-hidden="true"></i>
                      <p>
                        {{__('Utilisateurs')}} 
                       
                      </p>
                    </a>
                  </li>
                  @endhasanyrole
                 @role('admin')
                 <li class="nav-item has-treeview">
                  <a href="{{ route('service.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-chart-pie"></i>
                      <p>
                        {{__('Service')}} 
                       
                      </p>
                    </a>
                  </li>
                <li class="nav-item has-treeview">
                <a href="{{ route('backups.list') }}" class="nav-link">
                      <i class="nav-icon fas fa-database"></i>
                      <p>
                        {{__('BackUp')}} 
                       
                      </p>
                    </a>
                  </li>
                @endrole
                  <li class="nav-item has-treeview">
                    <a href="{{ route('password.reset',csrf_token()) }}" class="nav-link" >
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                        </form>
                      <i class="nav-icon fas fa-unlock-alt"></i>
                      <p>
                        {{ __('Password') }}
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
  

  


</body>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
@yield('js')

</html>
