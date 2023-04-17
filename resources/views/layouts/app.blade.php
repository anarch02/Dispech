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
                        <li class="nav-item">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newApplication" type="button">
                                {{ __('Новая заявка') }}
                            </button>
                        </li>
                    </ul>

                    <ul class="navbar-nav me-auto mt-md-0 ">
                        <aside id="mobile_menu" class="col-md-2 bg-dark text-light shadow-sm py-4 nav-pills flex-column mb-auto">
                            <ul class="nav nav-pills flex-column mb-auto">
                                <x-organization-menu></x-organization-menu>
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

        <div class="row my-2 justify-content-center">
            <aside id="menu" class="col-md-2 bg-dark text-light shadow-sm py-4 nav-pills flex-column mb-auto">
                <ul class="nav nav-pills flex-column mb-auto">
                    <x-organization-menu></x-organization-menu>
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

    <div class="modal fade" id="newApplication" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
      
          <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Politic')}} </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam ullam sint culpa consequuntur! Quas quaerat, nobis optio repudiandae architecto, maiores, cupiditate asperiores exercitationem temporibus eveniet totam eius quod! Ullam delectus maxime quisquam eligendi ratione similique? Repellendus, fugit laborum repellat qui aliquid quo, illum debitis, quaerat et nostrum expedita voluptatem provident consectetur nihil tempore vero dolor necessitatibus. Autem impedit quas unde aliquam cupiditate alias in omnis expedita necessitatibus eveniet, vitae earum asperiores molestias molestiae id ducimus odit quia corrupti modi dolore nam accusantium quis. Minus neque recusandae dolor quia, eos harum voluptatum eius debitis facere suscipit beatae corporis omnis. Accusamus autem, asperiores aperiam sapiente dolore totam? Autem quos, non dolorem, numquam consequatur necessitatibus possimus ratione sint quidem similique, reiciendis maiores? Sint ipsum amet dignissimos. Obcaecati veniam fuga autem in quisquam unde porro non exercitationem, repudiandae quasi inventore excepturi perspiciatis, laborum doloremque nesciunt recusandae! Quas, omnis. Qui architecto itaque repudiandae cupiditate totam ex enim debitis neque exercitationem quas in maiores tempore saepe natus fugiat praesentium perspiciatis beatae iure, sequi laudantium esse. Accusantium deserunt, aliquam veritatis facere corporis facilis, maiores cum veniam excepturi ad ratione molestias. Distinctio at dolorum sint delectus, ex illo deleniti quidem possimus assumenda nobis voluptas rerum sapiente velit ipsam.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{route('organization.application.create')}}" class="btn btn-primary">Create</a>
              </div>
          </div>
        </div>
      </div>

</body>
</html>
