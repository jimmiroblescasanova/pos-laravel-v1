<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ settings()->get('app_name') ?? config('app.name') }}</title>

    <!-- Responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}"><b>{{ settings()->get('app_name') ?? config('app.name') }}</b></a>
    </div>

    <div class="card card-danger">
        <div class="card-header text-center">
            <h3 class="card-title">Acceso Suspendido</h3>
        </div>
        <div class="card-body text-center">
            <p class="mb-4">
                Hemos detectado que tu pago está <strong>pendiente</strong>.
                Para volver a acceder, por favor realiza tu pago lo antes posible.
            </p>
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-sync-alt mr-2"></i>Actualizar página
            </a>
        </div>
    </div>
</div>

<!-- AdminLTE App -->
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}" defer></script>
</body>
</html>
