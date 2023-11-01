<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    
    @stack('third_party_stylesheets')
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button" data-enable-remember="true"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @if (Auth::user()->unreadNotifications()->exists())
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge">{{ Auth::user()->unreadNotifications()->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Notificaciones</span>
                        <div class="dropdown-divider"></div>
                        @foreach (Auth::user()->unreadNotifications as $notification)
                        <a href="{{ route('home.readNotification', $notification) }}" class="dropdown-item">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Producto agotado
                            <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans(null, true, true) }}</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        @endforeach
                        <a href="{{ route('home.readAllNotifications') }}" class="dropdown-item dropdown-footer"><i class="fas fa-check-circle mr-2"></i> Marcar como leídas</a>
                    </div>
                    @endif
                </li>
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random"
                            class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random"
                                class="img-circle elevation-2" alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                                <small>Perfil: {{ Auth::user()->getRoleNames() }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                            <a href="#" class="btn btn-default btn-flat float-right"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        @yield('content-header')
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Main Footer -->
        @include('layouts.footer')
    </div>
    @stack('third_party_scripts')
    @livewireScripts
</body>
</html>
