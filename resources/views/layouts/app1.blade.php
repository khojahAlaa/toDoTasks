
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Project Management WebApp </title>
  <!-- <script src="/js/jquery-3.4.1.slim.min.js" ></script> -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet"/>

  <script src="/js/popper.min.js"  crossorigin="anonymous"></script> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
     integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
  
     <link rel="stylesheet" href="/css/app.css">
     <link rel="stylesheet" href="/css/myCss.css">
     <link rel="stylesheet" href="/css/iconsStyle.css">
     <link rel="stylesheet" href="/css/CustomCheckBox.css">
     
    
 
  <style>
  .dropdown-menu.show {
    display: inline-grid;
}
.dropdown-menu {
  min-width: 16rem; 
}

  </style>
  
</head>
<body class="hold-transition sidebar-mini" style="background-color:#F0F4FF;">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- page indecater -->
    
    <ul class="navbar-nav">
      <li  class="nav-item d-none d-sm-inline-block">
        <h5 class="page_name_indecater">Page name</h5>
        
      </li>
    </ul>
    
    <ul class="navbar-nav ml-auto">
      <!-- SEARCH FORM -->
    <form class="form-inline ml-3 " style=" margin-right: 40px;">
      <div class="input-group input-group-sm" style="width: 300px; display: inline-flex;">
        <input class="form-control form-control-navbar"
        type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" >
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="nav-icon far fa-bell mr-2" style=" font-size: x-large"></i> 
          <span class="badge badge-warning navbar-badge" >3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">3 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-project-diagram mr-2"></i> 4 new projects
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-tasks mr-2"></i> 8 new tasks
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="nav-icon fas fa-file-alt mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/img/meeting.png" alt="PM Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PM WebApp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <a  href="{{ route('show-user-profile', ['id' =>  Auth::user()->id]) }}">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if(empty($user->photo))
                        <img src="{{asset('img/man.png')}}" class="img-circle elevation-2" title="" alt="User Image">
                    @else
                        <img src="{{asset('uploads/avatar')}}/{{$user->photo}}" class="img-circle elevation-2" title="" alt="User Image">
                    @endif
                </div>
                <div class="info">
                    {{ Auth::user()->name }}
                </div>
            </div>
        </a>
     

      <!-- Sidebar Menu -->
      
      <nav class="mt-2">
        @if( Auth::user()->role()->pluck('title')->contains('user'))
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <!-- <router-link to="/userdashbord" class="nav-link"> -->
                    <a class="nav-link" href="{{ url('UserDashboard') }}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>             
                      <p>
                          Dashbord
                      </p>
                    </a>
                    <!-- </router-link> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('my-tasks') }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>             
                        <p>
                            {{ __('Assigned Tasks') }}
                        </p>              
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('assignedTasks') }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>             
                        <p>
                            {{ __('Assigned Tasks 1') }}
                        </p>              
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('myCreatedTasks') }}">
                        <i class="nav-icon fas fa-tasks"></i>             
                        <p>
                            {{ __('My Tasks') }}
                        </p>              
                    </a>
                </li>
            </ul>
        @endif
        @if( Auth::user()->role()->pluck('title')->contains('manager'))
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('managerDashboard') }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>             
                        <p>
                            {{ __('Dashboard') }}
                        </p>              
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('departmentProjects')}}">
                        <i class="nav-icon fas fa-clipboard-list"></i>             
                        <p>
                            {{ __('All Projects') }}
                        </p>              
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('createNewProject') }}"> 
                        <i class="nav-icon fas fa-clipboard-list"></i>             
                        <p>
                            {{ __('New Project') }}
                        </p>              
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('MyProjects') }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            {{ __('My Projects') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('myCreatedTasks') }}">
                        <i class="nav-icon fas fa-tasks"></i>             
                        <p>
                            {{ __('My Tasks') }}
                        </p>              
                    </a>
                </li>
            </ul>
        @endif
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-power-off "></i>   
                    <p> {{ __('Logout') }}  </p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
          </ul>
        <!-- </ul> -->
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid mt-20">
        @yield('content')
      </div>
    </div>
  </div>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script>
// this auth will store sign in to store state of user in boolean value 
  window.signIn= @json(auth()->check());
</script>
<!-- to store the current user info into javasecript window global object -->
@auth
  <script>
    window.user = @json(auth()->user());
  </script>
@endauth

<script src="/js/app.js"></script>

</body>
</html>


