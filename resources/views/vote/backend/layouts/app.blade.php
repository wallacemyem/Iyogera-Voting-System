<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Voting System</title>
        <!-- Favicon -->
        <link href="{{ asset('public/signon/') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
        <link href="{{ asset('backend/css/notyf.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Icons -->
        <link href="{{ asset('public/signon/') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
        <link href="{{ asset('public/signon/') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('public/signon/') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    </head>
    <body class="{{ $class ?? '' }}">

        
        <div class="main-content">
            @include('signon.layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('signon.layouts.footers.guest')
        @endguest

        <script src="{{ asset('public/signon/') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('public/signon/') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('public/signon/') }}/js/argon.js?v=1.0.0"></script>
        @foreach (session('flash_notification', collect())->toArray() as $message)
            @if($message['level'] == 'success')
                <script type="text/javascript">
                    var notyf = new Notyf();
                    notyf.success('{{ $message['message'] }}');
                </script>
            @else
                <script type="text/javascript">
                    var notyf = new Notyf();
                    notyf.error('{{ $message['message'] }}');
                </script>
            @endif
        @endforeach
    </body>
</html>
