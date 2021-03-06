<!DOCTYPE html>
<html>
<head>
    <title>Resly &#187; @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="//raw.github.com/jharding/typeahead.js-bootstrap.css/master/typeahead.js-bootstrap.css" rel="stylesheet" media="screen">
    {{-- <link href='https://fonts.googleapis.com/css?family=Montez|Montserrat|Raleway+Dots|Raleway:100,200,300,400,700|Lato|Tangerine' rel='stylesheet' type='text/css'> --}}
    <link href='https://fonts.googleapis.com/css?family=Montez|Lato:400,100,100italic,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/alertify.core.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/alertify.default.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/application.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/refund.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/changepassword.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/typeahead-auto-complete.css') !!}">
    @yield('styles')
</head>
<body>

    @include('partials.navbar')
    @yield('content')
    {{-- <h5 class="home-footer">#TeamResly</h5> --}}
    <div id="footer" class="row">
        <nav class="footer-nav">
            <a href="/aboutus">About us</a>
            <a href="#">Terms of service</a>
            <a href="/contactus">Contact us</a>
            <a href="#">Help</a>
        </nav>
        <p>© {{ date('Y') }} Resly.</p>
        <p class="pull-right"><a href="#">Back to top</a></p>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{!! asset('js/jquery.confirm.min.js') !!}"></script>
    <script src="{!! asset('js/jquery.cookie.js') !!}"></script>
    <script src="{!! asset('js/alertify.js') !!}"></script>
    <script src="{!! asset('js/search.js') !!}"></script>
    <script src="{!! asset('js/refund.js') !!}"></script>
    <script src="{!! asset('js/changepassword.js') !!}"></script>
    <script src="{!! asset('js/typeahead.bundle.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/search_autocomplete.js') !!}"></script>
    <script type="text/javascript">
        @if(Session::has('success'))
            alertify.success("{{Session::get('success')}}");
            {{Session::forget('success')}}
        @elseif(Session::has('error'))
            alertify.error("{{Session::get('error')}}");
            {{Session::forget('error')}}
        @elseif(Session::has('info'))
            alertify.log("{{Session::get('info')}}");
            {{Session::forget('info')}}
        @endif
    </script>
    @yield('scripts')
</body>
</html>