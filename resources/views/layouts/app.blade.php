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
    
    <script src="/js/jquery-3.4.1.slim.min.js" ></script>
    <script src="/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- <script src="bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    @yield('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="css/fontGoogle.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
     integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
  
     <link rel="stylesheet" href="/css/app.css">
     <link rel="stylesheet" href="/css/myCss.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/myCss.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body style="background-color:#F0F4FF;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ __('Projects Managment') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
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

                            @if( Auth::user()->role()->pluck('title')->contains('manager'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('createNewProject') }}">{{ __('New Project') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('MyProjects') }}">{{ __('My Projects') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('departmentProjects')}}">{{ __('All Projects') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('Dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            @endif

                            @if( Auth::user()->role()->pluck('title')->contains('exc'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('createNewProject') }}">{{ __('New Project') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('AllProjects') }}">{{ __('All Projects') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('eDashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Filtter
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="nav-link" href="/pType">{{ __('Project Type') }}</a>
                                    <a class="nav-link" href="/pStatuses">{{ __('Project Statuses') }}</a>
                                    <a class="nav-link" href="/department">{{ __('Project Department') }}</a>
                                    
                                </div>
                            </li>
                            @endif

                            @if( Auth::user()->role()->pluck('title')->contains('admain'))

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     <i class="nav-icon fas fa-cog"> <span class="caret"></span>
                                     </i>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="nav-link" href="/users">{{ __('Manage users') }}</a>
                                    <a class="nav-link" href="/department">{{ __('Manage Department') }}</a>
                                    <a class="nav-link" href="/pType">{{ __('Manage Project Type') }}</a>
                                    <a class="nav-link" href="/pStatuses">{{ __('Manage Project Statues') }}</a>
                                </div>
                            </li>
                            
                            @endif
                            @if( Auth::user()->role()->pluck('title')->contains('user'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('my-tasks') }}">{{ __('MY TO DO TASKS') }}</a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     <i class="fas fa-user"> <span class="caret"></span>
                                     </i>
                                   
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('show-user-profile', ['id' =>  Auth::user()->id]) }}">
                                        {{ Auth::user()->name }} 
                                    </a>


                                   
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                                
                            </li>

                          

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container">
            @yield('content')
        </main>
    </div>
</body>
</html>
