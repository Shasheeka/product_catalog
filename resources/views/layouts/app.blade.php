<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daigou Australia Group</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/freelancer.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="app">
        <nav  class="navbar navbar-default navbar-fixed-top  navbar-custom">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Daigou Australia Group</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li><a href="/">Home</a></li>
                        {{--<li><a href="/agent">Agent</a></li>--}}
                        <li><a href="/product-request/create">Product Request</a></li>
                        <li><a href="/info">Info</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/multimedia">Multimedia</a></li>
                        @if(Auth::check())
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                        @endif

                        @if(Auth::guest())
                            <li><a href="{{ route('login') }}" >Login</a></li>

                        @endif
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        @yield('content')

    <!-- Footer -->
        <footer class="text-center">
            <div class="footer-above">
                <div class="container">

                </div>
            </div>
            <div class="footer-below">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            Copyright &copy; Daigou Australia Group 2017
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/freelancer.js') }}"></script>
    <script>
        $(function () {
            var nua = navigator.userAgent
            var isAndroid = (nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1 && nua.indexOf('Chrome') === -1)
            if (isAndroid) {
                $('select.form-control').removeClass('form-control').css('width', '100%')
            }
        })
    </script>
    {{--<script src="{{ asset('js/jqBootstrapValidation.js') }}"></script>--}}
    {{--<script src="{{ asset('js/contact_me.js') }}"></script>--}}
</body>
</html>
