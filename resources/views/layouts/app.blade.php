<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://unpkg.com/vue@2.4.2"></script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken'=> csrf_token(),
            'user'=> [
                'authenticated' => auth()->check(),
                'id' => auth()->check() ? auth()->user()->id : null,
                'name' => auth()->check() ? auth()->user()->name : null,
                ]
            ])
        !!};
    </script>
    <script>
        window.auth = {!! auth()->user() !!}
    </script>

    <script>
        @if(!auth()->guest())
            window.Laravel.userId = <?php echo auth()->user()->id; ?>
        @endif
    </script>






    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home') }}">
                    <i class="fas fa-house-damage"></i>
                    {{ config('app.name', 'Laravel') }}
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
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else

                            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
                            <li class="dropdown">
                                <a class="dropdown-toggle" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fas fa-bell"></i>
                                    <span class="glyphicon glyphicon-user"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="notificationsMenu" id="notificationsMenu">
                                    <li class="dropdown-header">No notifications</li>
                                </ul>
                            </li>



                            <form action="/search" method="POST" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q"
                                           placeholder="Search users"> <span class="input-group-btn">
                                      <button type="submit"   class="btn btn-dark">
                                         <span class="glyphicon glyphicon-search">

                                         </span> Search
                                      </button>
                            </span>
                                </div>
                            </form>

                            <li class="nav-item dropdown">

                                <a  id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name}} <span class="caret"></span>

                                        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px;  border-radius:50%">

                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ url('/home') }}">
                                        <i class="fas fa-home"></i>
                                        {{ __('Home') }}

                                    </a>

                                    <a class="dropdown-item" href="{{ url('/users') }}">
                                        <i class="fas fa-users"></i>
                                        {{ __('Users') }}

                                    </a>
                                    <a class="dropdown-item" href="{{ url('/profile') }}">
                                        <i class="fas fa-user-alt"></i>
                                        {{ __('Profile') }}

                                    </a>

                                    <a class="dropdown-item" href="{{action('HomeController@edit',Auth::user()->id)}}">
                                        <i class="fas fa-edit"></i>
                                        {{ __('Edit profile') }}

                                    </a>
                                    <a class="dropdown-item" href="{{ route('post.create') }}">
                                        <i class="fas fa-ghost"></i>
                                        {{ __('Add post') }}

                                    </a>

                                    <a class="dropdown-item" href="{{'chat'}}" >
                                        <i class="far fa-comments"></i>
                                        {{ __('Chat') }}

                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
