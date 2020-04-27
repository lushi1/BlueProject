<!DOCTYPE HTML>
<html>

<head>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Du Lịch Bình Dương, Đại Nam, Suối Rạc, Hồ Bình, ..." />

    <!-- //Meta tag Keywords -->

    <!-- Custom-Files -->
    <link rel="stylesheet" type='text/css' href="{{asset('/user/css/tonghopreview.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <link href="{{asset('/user/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
    <!-- Bootstrap-CSS -->
    <link href="{{asset('/user/css/style.css')}}" rel='stylesheet' type='text/css' />
    <!-- Style-CSS -->
    <link href="{{asset('/user/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Jquery -->
    <script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container-fluid">
            <div class="header d-lg-flex align-items-center py-2 px-sm-2 px-1">
                <!-- logo -->
                <div id="logo">
                    <h1><a href="trang-chu">Du Lịch Bình Dương</a></h1>
                </div>
                <!-- //logo -->
                <!-- nav -->
                <div class="nav_w3ls mx-auto">
                    <nav>
                        <label for="drop" class="toggle">Menu</label>
                        <input type="checkbox" id="drop" />
                        <ul class="menu">
                            <li><a href="trang-chu">Trang chủ</a></li>
                            <li><a href="#about">Địa điểm nổi bật</a></li>
                            <li><a href="tong-hop-review">Tổng hợp Review</a></li>
                            <li><a href="#contact">Liên hệ</a></li>  
                            @if (!session()->has('tenkh') && !session()->has('tenadmin'))
                            <li><a href="trangdangnhap">Đăng nhập</a></li>
                            <li><a href="trangdangky">Đăng ký</a></li>
                            @endif
                            @if (session()->has('tenkh'))                          
                                    <li><a href="#">{{ Session::get('tenkh') }}</a></li>
                                    <li><a href="thoat">Thoát</a></li>
                            @endif
                            @if (session()->has('tenadmin'))                          
                                    <li><a href="#">{{ Session::get('tenadmin') }}</a></li>
                                    <li><a href="thoat">Thoát</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>

                <!-- //nav -->
                <!-- dang nhap dang ky/tenkh thoat -->
                
                
                <!-- ket thuc -->
                
            </div>
        </div>
    </header>
    <!-- //header -->

    <!-- banner -->
    <div class="content text-center" id="home">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <!-- //banner -->



    

    <!-- footer -->
    <!-- <footer class="py-5">
        <div class="container py-xl-4 py-lg-3">
            <div class="row footer-grids">
                <div class="col-lg-2 col-6 footer-grid">
                    <h3 class="mb-sm-4 mb-3">Navigation</h3>
                    <ul class="list-unstyled">
                        <li>
                            <a href="index.html">Index</a>
                        </li>
                        <li>
                            <a href="#about">About Us</a>
                        </li>
                        <li>
                            <a href="#what">What We Do?</a>
                        </li>
                        <li>
                            <a href="#gallery">Our Gallery</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 footer-grid">
                    <h3 class="mb-sm-4 mb-3">Some More</h3>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#join">Apply Now</a>
                        </li>
                        <li>
                            <a href="#events">Our Events</a>
                        </li>
                        <li>
                            <a href="#courses">Popular Courses</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 footer-grid footer-contact mt-lg-0 mt-4">
                    <h3 class="mb-sm-4 mb-3">Get In Touch</h3>
                    <ul class="list-unstyled">
                        <li>
                            +01(24) 8543 8088
                        </li>
                        <li>
                            <a href="mailto:info@example.com">info@example.com</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 footer-grid text-lg-right">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#stats">Our Statistics</a>
                        </li>
                        <li>
                            <a href="login.html">Login</a>
                        </li>
                        <li>
                            <a href="register.html">Register</a>
                        </li>
                        <li>
                            <a href="#contact">Contact Us</a>
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
    </footer> -->
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