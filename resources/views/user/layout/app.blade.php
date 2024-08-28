<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/logo/logo_sekolah.png">
    <!-- CSS
	============================================ -->
    <link rel="stylesheet" href="../../assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/vendor/icomoon.css">
    <link rel="stylesheet" href="../../assets/css/vendor/remixicon.css">
    <link rel="stylesheet" href="../../assets/css/vendor/magnifypopup.min.css">
    <link rel="stylesheet" href="../../assets/css/vendor/odometer.min.css">
    <link rel="stylesheet" href="../../assets/css/vendor/lightbox.min.css">
    <link rel="stylesheet" href="../../assets/css/vendor/animation.min.css">
    <link rel="stylesheet" href="../../assets/css/vendor/jqueru-ui-min.css">
    <link rel="stylesheet" href="../../assets/css/vendor/swiper-bundle.min.css">
    <link rel="stylesheet" href="../../assets/css/vendor/tipped.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="../../assets/css/app.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>

<body class="sticky-header ">
        <!--=====================================-->
        <!--=        Header Area Start       	=-->
        <!--=====================================-->
        <header class="edu-header header-style-1 header-fullwidth">
            
            <div id="edu-sticky-placeholder"></div>
            <div class="header-mainmenu">
                <div class="container-fluid">
                    <div class="header-navbar">
                        <div class="header-brand">
                            <div class="logo">
                                <a href="{{route('login_admin')}}">
                                    <img class="logo-light" style="width: 75px;" src="../../assets/images/logo/logo_sekolah.png" alt="Corporate Logo">
                                    <img class="logo-dark" style="width: 75px;" src="../../assets/images/logo/logo_sekolah.png" alt="Corporate Logo">
                                </a>
                            </div>
                        </div>
                        <div class="header-mainnav">
                            <nav class="mainmenu-nav">
                                <ul class="mainmenu">
                                    <li>
                                        <a href="{{route('index')}}">Utama</a>
                                    </li>

                                    <li>
                                        <a href="{{route('tabung')}}">Tabung</a>
                                    </li>

                                    @if (Auth::check())
                                    <li>
                                        <a href="{{route('pibg')}}">PIBG</a>
                                    </li>
                                    <li>
                                        <a href="{{route('akaun')}}">Akaun Saya</a>
                                    </li>
                                    @endif
                                    
                                </ul>
                            </nav>
                        </div>
                        <div class="header-right">
                            <ul class="header-action">
                                <li class="header-btn">
                                    @if (Auth::check())
                                    <a href="{{route('logout_user')}}" class="edu-btn btn-medium">Log Keluar</a>
                                    @else
                                    <a href="{{route('login_user')}}" class="edu-btn btn-medium">Log Masuk <i class="icon-4"></i></a>
                                    @endif
                                </li>
                                <li class="mobile-menu-bar d-block d-xl-none">
                                    <button class="hamberger-button">
                                        <i class="icon-54"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popup-mobile-menu">
                <div class="inner">
                    <div class="header-top">
                        <div class="logo">
                            <a href="{{route('login_admin')}}">
                                <img class="logo-light" style="width: 50px;" src="../../assets/images/logo/logo_sekolah.png" alt="Corporate Logo">
                                <img class="logo-dark" style="width: 50px;" src="../../assets/images/logo/logo_sekolah.png" alt="Corporate Logo">
                            </a>
                        </div>
                        <div class="close-menu">
                            <button class="close-button">
                                <i class="icon-73"></i>
                            </button>
                        </div>
                    </div>
                    <ul class="mainmenu">

                        <li>
                            <a href="{{route('index')}}">Utama</a>
                        </li>

                        <li>
                            <a href="{{route('tabung')}}">Tabung</a>
                        </li>

                        @if (Auth::check())
                        <li>
                            <a href="{{route('pibg')}}">PIBG</a>
                        </li>
                        <li>
                            <a href="{{route('akaun')}}">Akaun Saya</a>
                        </li>
                        @endif
                        <li class="header-btn">
                            @if (Auth::check())
                            <a href="{{route('logout_user')}}" class="edu-btn btn-medium">Log Keluar</a>
                            @else
                            <a href="{{route('login_user')}}" class="edu-btn btn-medium">Log Masuk <i class="icon-4"></i></a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </header>

@yield('content')

        <!-- End Course Area -->
        <!--=====================================-->
        <!--=        Footer Area Start       	=-->
        <!--=====================================-->
        <!-- Start Footer Area  -->
        <footer class="edu-footer footer-darken bg-image footer-style-2 ">
            <div class="footer-top">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-3 col-md-6">
                            <div class="edu-footer-widget">
                                <div class="logo">
                                    <a href="index.html">
                                        <img class="logo w-25" src="../../assets/images/logo/logo_sekolah.png" alt="Corporate Logo">
                                    </a>
                                </div>
                                <h4 class="widget-title">Sekolah Kebangsaan Tun Dr. Ismail (2)</h4>
                                <p class="description">Jalan Abang Hj. Openg, Taman Tun Dr. Ismail , Kuala Lumpur, Malaysia</p>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="edu-footer-widget explore-widget">
                                <h4 class="widget-title">Pautan</h4>
                                <div class="inner">
                                    <ul class="footer-link link-hover">
                                        <li>
                                            <a href="{{route('index')}}">Utama</a>
                                        </li>
    
                                        <li>
                                            <a href="{{route('tabung')}}">Tabung</a>
                                        </li>
    
                                        @if (Auth::check())
                                        <li>
                                            <a href="{{route('pibg')}}">PIBG</a>
                                        </li>
                                        <li>
                                            <a href="{{route('akaun')}}">Akaun Saya</a>
                                        </li>
                                        @endif
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="edu-footer-widget">
                                <h4 class="widget-title">Hubungi Kami</h4>
                                <div class="widget-information">
                                    <ul class="information-list">
                                        <li><span>Faks:</span>+60 3-91732272</li>
                                        <li><span>Telefon (Pejabat):</span> 03 - 77288441</a></li>
                                        <li><span>Emel:</span><a href="mailto:wba0057@moe.edu.my" target="_blank">wba0057@moe.edu.my</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="edu-footer-widget quick-link-widget">
                                <h4 class="widget-title">Sokongan</h4>
                                <div class="inner">
                                    <ul class="footer-link link-hover">
                                        <li><a href="">FAQ</a></li>
                                        <li><a href="">Terma & Syarat</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer Area  -->
        <div class="rn-progress-parent">
            <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
    
        <!-- JS
        ============================================ -->
        <!-- Modernizer JS -->
        <script src="../../assets/js/vendor/modernizr.min.js"></script>
        <!-- Jquery Js -->
        <script src="../../assets/js/vendor/jquery.min.js"></script>
        <script src="../../assets/js/vendor/bootstrap.min.js"></script>
        <script src="../../assets/js/vendor/sal.min.js"></script>
        <script src="../../assets/js/vendor/backtotop.min.js"></script>
        <script src="../../assets/js/vendor/magnifypopup.min.js"></script>
        <script src="../../assets/js/vendor/jquery.countdown.min.js"></script>
        <script src="../../assets/js/vendor/odometer.min.js"></script>
        <script src="../../assets/js/vendor/isotop.min.js"></script>
        <script src="../../assets/js/vendor/imageloaded.min.js"></script>
        <script src="../../assets/js/vendor/lightbox.min.js"></script>
        <script src="../../assets/js/vendor/paralax.min.js"></script>
        <script src="../../assets/js/vendor/paralax-scroll.min.js"></script>
        <script src="../../assets/js/vendor/jquery-ui.min.js"></script>
        <script src="../../assets/js/vendor/swiper-bundle.min.js"></script>
        <script src="../../assets/js/vendor/svg-inject.min.js"></script>
        <script src="../../assets/js/vendor/vivus.min.js"></script>
        <script src="../../assets/js/vendor/tipped.min.js"></script>
        <script src="../../assets/js/vendor/smooth-scroll.min.js"></script>
        <script src="../../assets/js/vendor/isInViewport.jquery.min.js"></script>
        
        <!-- Site Scripts -->
        <script src="../../assets/js/app.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('message'))
                    Swal.fire({
                        icon: '{{ session('status') }}', // 'success', 'error', or 'info'
                        title: '{{ session('title') }}',
                        text: '{{ session('message') }}',
                    });
                @endif
            });
        </script>
</body>

</html>