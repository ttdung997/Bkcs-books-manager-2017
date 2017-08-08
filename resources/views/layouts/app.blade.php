<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{URL::asset('images/logo.png')}}" />
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!--        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">-->

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>thư viện BKCS</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <p style="margin-top: -9px;s">BKCS <img style="width: 35px;height: 35px;" src="{{URL::asset('images/logo.png')}}"></p>
                        </a>

                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Đăng nhập </a></li>
                            <li><a href="{{ route('register') }}">Đăng kí</a></li>
                            @else
                            <li class=""><a href="/Bookview/1" class="ui-link">Quản lý sách</a></li>
                            <li class=""><a href="/khachview/1" class="ui-link">Quản lý khách</a></li>
                            <li class=""><a href="/DealView/1" class="ui-link">Quản lý giao dịch</a></li>
                            <li class=""><a href="/TypeTagManager" class="ui-link">Quản lý loại sách và tag</a></li>
                            <li class=""><a href="/demo" class="ui-link">QrCode</a></li>
                            <li class="dropdown"><a class="ui-link">{{ Auth::user()->name }}</a>
                                <ul class="dropdown-content">
                                    <li><a href="/userInfo">Thông tin cá nhân</a></li>
                                    <li> <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                                            Đăng xuất
                                        </a></li>
                                </ul>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">

                <div class="loader"></div>
                @yield('content')
            </div><br><br><br>
            <div id="footer">
                <div class="container">
                    <div class="row">
                        <!-- #bottom-logo end -->
                        <div class="clear"></div>
                        <p class="copyright"     style="text-align: left;">© Trung tâm an toàn máy tinh, ĐHBK Hà Nội.&nbsp; 1 Đại Cồ Việt, Hai Bà Trưng, Hà Nội</p>
                    </div><!-- row -->
                </div><!-- container -->
            </div>
        </div>

        <!-- Scripts -->

<!--        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>-->
        <script type="text/javascript" src="{{ URL::asset('js/jquery.tinycarousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<!--        <script src="{{ asset('js/app.js') }}"></script>-->

    </body>
</html>
