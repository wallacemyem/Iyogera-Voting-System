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
        <!-- Icons -->
        <link href="{{ asset('public/signon/') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="{{ asset('public/signon/') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="{{ asset('backend/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/vendor/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/vendor/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/notyf.min.css') }}" rel="stylesheet" type="text/css" />
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
        <script src="{{ asset('backend/js/notyf.min.js') }}"></script>
        @stack('js')
     

    <script>

        var form;

        function classWiseSection(election_id) {

            if(election_id > 0) {

            }else {

                console.log(123);

            }

            var url = '{{ route("section.show", "election_id") }}';

            url = url.replace('election_id', election_id);

            $.ajax({

                type : 'GET',

                url: url,

                success : function(response) {

                    $('#section_content').html(response);

                }

            });

        }

        function onChangeSection(position_id) {

        }

        $(".ajaxForm").validate({});

        $("#single_admission").submit(function(e) {

            form = $(this);

            ajaxSubmit(e, form, refreshForm);

        });

        var refreshForm = function () {

            form.trigger("reset");

        }

    </script>
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
