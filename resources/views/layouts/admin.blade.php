<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('img/logo.svg')}}" type="image/x-icon">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/map.js', 'resources/css/app.css'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container d-flex flex-colum">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('img/logo.png')}}" style="max-width: 70px" alt="">
                    {{ config('app.name', 'Air-gps') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                    </ul>

                    <ul class="navbar-nav me-auto mt-md-0 ">
                        <aside id="mobile_menu" class="col-md-2 bg-dark text-light shadow-sm py-4 nav-pills flex-column mb-auto">
                            <ul class="nav nav-pills flex-column mb-auto">
                                @if (Auth::user()->isSuperAdmin)
                                    <x-admin></x-admin>
                                @else
                                    <x-menu></x-menu> 
                                @endif
                            </ul>                  
                        </aside>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    {{__('Logout')}}
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row  my-2 justify-content-center">
            <aside id="menu" class="col-md-2 bg-dark text-light shadow-sm py-4 nav-pills flex-column mb-auto">
                <ul class="nav nav-pills flex-column mb-auto">
                    @if (Auth::user()->isSuperAdmin)
                        <x-admin></x-admin>
                    @else
                        <x-menu></x-menu> 
                    @endif
                </ul>                  
            </aside>

            <main class="py-4 border-left col-md-8 bg-white shadow-sm">
                @if (Session::has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('message') }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <div class="container footer">
        <footer class="py-3 my-4">
          <p class="text-center text-muted">© 2023</p>
        </footer>
    </div>
</body>
</html>