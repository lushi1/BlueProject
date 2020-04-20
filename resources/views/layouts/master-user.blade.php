<!DOCTYPE HTML>
<html>

<head>
    <title>Trang chủ</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="My School Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

    <!-- //Meta tag Keywords -->

    <!-- Custom-Files -->
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
        <div class="container">
            <div class="header d-lg-flex justify-content-between align-items-center py-2 px-sm-2 px-1">
                <!-- logo -->
                <div id="logo">
                    <h1><a href="index.html">My School</a></h1>
                </div>
                <!-- //logo -->
                <!-- nav -->
                <div class="nav_w3ls ml-lg-5">
                    <nav>
                        <label for="drop" class="toggle">Menu</label>
                        <input type="checkbox" id="drop" />
                        <ul class="menu">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#join">Join Now</a></li>
                            <li>
                                <!-- First Tier Drop Down -->
                                <label for="drop-2" class="toggle toogle-2">Pages <span class="fa fa-angle-down"
                                        aria-hidden="true"></span>
                                </label>
                                <a href="#">Pages <span class="fa fa-angle-down" aria-hidden="true"></span></a>
                                <input type="checkbox" id="drop-2" />
                                <ul>
                                    <li><a href="#events" class="drop-text">Events</a></li>
                                    <li><a href="#what" class="drop-text">What We Do?</a></li>
                                    <li><a href="#courses" class="drop-text">Popular Courses</a></li>
                                    <li><a href="#stats" class="drop-text">Statistics</a></li>
                                    <li><a href="#gallery" class="drop-text">Gallery</a></li>
                                </ul>
                            </li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="register.html">Register</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- //nav -->
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
    <footer class="py-5">
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
                                My School</a>
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
    
</body>

</html>