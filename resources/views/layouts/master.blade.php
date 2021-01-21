
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Project Management WebApp </title>

  <!-- Font Awesome Icons -->
  <!-- <link rel="stylesheet" href="/css/fontawesome.css">
  <link rel="stylesheet" href="/css/fontawesome.min.css"> -->
  <!-- <script type="text/javascript" src="/js/jquery.js"></script> -->
  
  <!-- <script type="text/javascript" src="/js/bs-stepper.min.js"></script>
    <link rel="stylesheet" href="css/bs-stepper.min.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
     integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
  
     <link rel="stylesheet" href="/css/app.css">
     <link rel="stylesheet" href="/css/myCss.css">
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
    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3"> -->
      <!-- <div class="input-group input-group-sm" style="width: 350px; display: inline-flex;">
        <input class="form-control form-control-navbar" v-model="search" @keyup="searchit"
        type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div> -->
    <!-- </form> -->
    
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
      <router-link to="/profile">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/img/man.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <!-- <a href="#" class="d-block"> -->
            {{ Auth::user()->name }}
            <!-- <p>{{ Auth::user()->type }}</p>
          </a> -->
        </div>
      </div>
      </router-link>
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
            <router-link to="/userdashbord" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>             
              <p>
                Dashbord
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/assignedTasks"  class="nav-link"> 
            <i class="nav-icon fas fa-clipboard-list"></i>             
             <p>
                Assigned Tasks
              </p>              
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/MyTasks" class="nav-link"> 
            <i class="nav-icon fas fa-tasks"></i>
              <p>
                My Tasks
              </p>
            </router-link>
          </li>
          
          <!-- <li class="nav-item">
            <router-link to="/savedJob" class="nav-link"> 
            <i class="nav-icon fas fa-tasks"></i> 
              <p>
                My Tasks
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/searchJob" class="nav-link">
              <i class="nav-icon fas fa-bell"></i> 
              <p>
                Notifications
              </p>
            </router-link>
          </li>
     
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-cog"></i> 
              <p>
                Management
                <i class="right fa fa-angle-left green"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link ">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Users</p>
                </router-link>
              </li>
            </ul>
          </li>  -->
         
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off red"></i>   
                <p> {{ __('Logout') }}  </p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid mt-20">
        <router-view></router-view>
      </div>
    </div>
  </div>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@auth
  <script>
    window.user = @json(auth()->user())
   
  </script>
@endauth

<script src="/js/app.js"></script>

<!-- <script>
     var app = new Vue({
   el: '#app',
        computed:{
          navigationItems(){
            let navItems =[ ]
            if(Auth::user()->role()->pluck('title')->contains('user')){
              navItems =[ 
              {icon: , title: , link: ,},
              {icon: , title: , link: ,},
              {icon: , title: , link: ,},
              ]

            }
            
            else if(Auth::user()->role()->pluck('title')->contains('manager')){
              navItems =[ 
              {icon: , title: , link: ,},
              {icon: , title: , link: ,},
              {icon: , title: , link: ,},
              ]
              
            }
            else if(Auth::user()->role()->pluck('title')->contains('exc')){
              navItems =[ 
              {icon: , title: , link: ,},
              {icon: , title: , link: ,},
              {icon: , title: , link: ,},
              ]
              
            }
            else {
              navItems =[ 
              {icon: , title: , link: ,},
              {icon: , title: , link: ,},
              {icon: , title: , link: ,},
              ]
            }
            return navItems
          },
        }
      });
  </script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script src="https://cdn.jsdelivr.net/npm/vee-validate@latest/dist/vee-validate.js"></script>
<script>
  Vue.component('ValidationProvider', VeeValidate.ValidationProvider);
Vue.use(VeeValidate, {
  events: 'change|blur|xxx',
  classes: true,
  classNames: {
      valid: 'is-valid',
  invalid: 'is-invalid'
  }
});
</script> -->
<!-- <script src="/js/vue-router.js"></script> -->

<!-- <script src="/js/vue-multiselect.min.js"></script>
<link rel="stylesheet" href="css/vue-multiselect.min.css"> -->
<!-- <script type="text/javascript" src="/js/moment.min.js"></script> -->
<!-- <script src="js/vue-date-picker.js"></script>
    <script src="js/vue-date-picker.min.js"></script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/af.js" integrity="sha256-I5ZXO8KcMnqNkrXU7baGig70nATYjNDnxxA2d40PcR8=" crossorigin="anonymous"></script> -->
</body>
</html>


