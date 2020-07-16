<!DOCTYPE HTML>
<html>

<head>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Du Lịch Bình Dương, Đại Nam, Suối Rạc, Hồ Bình, ..." />

    <!-- //Meta tag Keywords -->
    <title>Web GIS hỗ trợ tìm kiếm thông tin</title>
    <!-- Custom-Files -->
    <link rel="stylesheet" type='text/css' href="{{asset('/user/css/tonghopreview.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- <link href="{{asset('/user/css/bootstrap.css')}}" rel='stylesheet' type='text/css' /> -->
    <link href="{{asset('/user/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />
    <!-- Bootstrap-CSS -->
    <link href="{{asset('/user/css/style.css')}}" rel='stylesheet' type='text/css' />
    <!-- Style-CSS -->
    <link href="{{asset('/user/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Jquery -->
    <script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container-fluid">
            <div class="header d-lg-flex align-items-center py-2 px-sm-2 px-1">
                <!-- logo -->
                <div id="logo">
                    <h1><a href="{{route('trang-chu')}}">Du Lịch Bình Dương</a></h1>
                </div>
                <!-- //logo -->
                <!-- nav -->
                <div class="nav_w3ls mx-auto">
                    <nav>
                        <label for="drop" class="toggle">Menu</label>
                        <input type="checkbox" id="drop" />
                        <ul class="menu">
                            <li><a href="{{route('trang-chu')}}">Trang chủ</a></li>
                            <li><a href="{{route('khach-san')}}">Khách sạn</a></li>
                            <li><a href="{{route('tong-hop-review')}}">Cẩm nang du lịch</a></li>
                            <li><a href="{{route('lien-he')}}">Liên hệ</a></li>  
                            @if (!session()->has('tenkh') && !session()->has('tenadmin'))
                            <li><a href="{{route('trang-dang-nhap')}}">Đăng nhập</a></li>
                            <li><a href="{{route('dang-ky')}}">Đăng ký</a></li>
                            @endif
                            @if (session()->has('tenkh'))                          
                                    <li><a href="#">{{ Session::get('tenkh') }}</a></li>
                                    <li><a href="{{route('thoat')}}">Thoát</a></li>
                            @endif
                            @if (session()->has('tenadmin'))                          
                                    <li><a href="#">{{ Session::get('tenadmin') }}</a></li>
                                    <li><a href="{{route('thoat')}}">Thoát</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>

                <!-- //nav -->
                
            </div>
        </div>
    </header>
    <!-- //header -->

    <!-- banner -->
    <div class="content" id="home">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <!-- //banner -->

    <!-- footer -->
    <footer class="py-5">
        <div class="container py-xl-4 py-lg-3">
            <div class="row footer-grids">
                <div class="col-lg-2 col-12 footer-grid">
                    <h3 class="mb-sm-4 mb-3">Điều hướng</h3>
                    <ul class="list-unstyled">
                        <li>
                            <a href="index.html">Trang chủ</a>
                        </li>
                        <li>
                            <a href="#about">Khách Sạn</a>
                        </li>
                        <li>
                            <a href="#what">Cẩm Nang Du Lịch</a>
                        </li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-6 footer-grid footer-contact mt-lg-0 mt-4">
                    <h3 class="mb-sm-4 mb-3">Liên lạc với chúng tôi</h3>
                    <ul class="list-unstyled">
                        <li>
                            Phone: +(84) 344 023 451
                        </li>
                        <li>
                            <a href="mailto:dulichbd.info@gmail.com">Gmail: dulichbd.info@gmail.com</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6 footer-grid text-center">
                <h3 class="mb-sm-4 mb-3">Mạng xã hội</h3>
                    <ul class="list-unstyled">
                        <li>
                            <a href="login.html">Facebook: <i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="login.html">Instagram: <i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="login.html">Twitter: <i class="fa fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 footer-grid mt-lg-0 mt-4">
                    <div class="footer-logo">
                        <h2 class="text-lg-center text-center">
                            <a class="logo text-wh font-weight-bold" href="index.html">
                            Du Lịch Bình Dương</a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- //footer -->

    <!-- move top icon -->
    <a href="#home" class="move-top text-center">
        <span class="fa fa-angle-double-up" aria-hidden="true"></span>
    </a>
    <!-- //move top icon -->
    <script>
		$('div.alert').not('.alert-important').delay(4000).fadeOut(350);
	</script>
</body>
</html>