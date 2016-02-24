<!DOCTYPE html>
<html>
<head>
    <title>Resly &#187; @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}"> --}}
    <link href='https://fonts.googleapis.com/css?family=Montez|Montserrat|Raleway+Dots|Raleway:100,200,300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/application.css') !!}">

    <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
    @yield('styles')
</head>
<body>
    {{-- <div class="container-wrapper"> --}}
        @include('partials.navbar')

        @yield('content')
    {{-- </div> --}}
    {{-- <footer>
        <div class="container">
            <div class="footer-inner">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="footer-content text-center padding-ver-clear">
                            <p><a target="_blank" href="/">Resly</a> | Home for your reservation needs.</p>
                            <div class="separator"></div>
                            <p class="text-center margin-clear">Copyright © 2015. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{!! asset('js/jquery.cookie.js') !!}"></script>
    @yield('scripts')
</body>
</html>
