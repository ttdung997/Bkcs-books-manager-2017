<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/reponsive.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/tinycarousel.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/jquery.simpleLens.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/jquery.simpleGallery.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/layout.css') }}" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<div id ="wrap-page" style="background-color: #4facd6" >
    <header>
        <div class="container" style="margin-left: 6%">
            <div class="row">
                <div class="header-in">
                    <div class="col-sm-12">
                        <br>
                        <a href="/bookForm"><h1 style="font-size: 50px;font-weight: 900;color: black">I   <img style="width: 60px;height: 60px;margin-top: -1%;" src="{{URL::asset('images/traitim.png')}}">   SAMI   <img style="width: 65px;height: 65px;" src="{{URL::asset('images/logo.png')}}"> </h1></a>
                    </div>

                </div>
            </div>
        </div>

        <br>
        <br>
        </div><!-- end .container-->
        <div class="container" style="width: 103%;">
            <div class="row">
                <div class="col-sm-12">
                    <div class="menu">
                        <div class="navbar-header navbar-brand">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="navbar" class="collapse navbar-collapse" style="margin-top: 1%">
                            <ul class="nav navbar-nav" >

                                <li style="margin-left: 5%" class=""><a href="/bookForm" class="ui-link" >Thêm đầu sách</a></li>
                                <li class=""><a href="/customerForm" class="ui-link">Thêm bản ghi</a></li>
                                <li class=""><a href="/form" class="ui-link">Quản lý sách</a></li>
                                <li class=""><a href="/quanlykhach" class="ui-link">Quản lý khách</a></li>
                                <?php
                                if (!isset(Auth::user()->name)) {
                                    header("Location:/");
                                }else{
                                    ?>
                                         <li> <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            ( {{ Auth::user()->name }})Logout
                                        </a></li>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                <?php
                                
                                }
                                
                                ?>
                            </ul>
                        </div><!--/.nav-collapse -->   </div><!--end menu -->
                </div>
            </div></div>
        <!--                  
        <br> <br class="space">-->
    </header><!-- end header -->
    @yield('content')
    <footer>
          <div class="container">
            <div class="row">
                <div class="col-sm-2 footer-social">
                    <a target="_blank" class="facebook" href="https://www.facebook.com/SamiHust/"></a>
                    <a target="_blank" class="youtube" rel="publisher" href="https://www.youtube.com/channel/UC7VfhbiHucmmZpVbjhbKqtw"></a>
                </div>
            </div>

        </div>
    </footer>
      

</body>
</html>

<script type="text/javascript" src="{{ URL::asset('js/jquery.tinycarousel.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js//bootstrap.min.js') }}"></script>