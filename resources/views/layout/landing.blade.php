<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sistem Pakar Diagnosis Mental Illness Metode Naive Bayes</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description" />
    <meta content="" name="Salwa Uwu" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('css/fontsbody.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing/plugins/socicon/socicon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/landing/plugins/bootstrap-social/bootstrap-social.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/landing/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/landing/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/landing/plugins/animate/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/landing/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN: BASE PLUGINS  -->
    <link href="{{ asset('assets/landing/plugins/revo-slider/css/settings.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/landing/plugins/revo-slider/css/layers.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/landing/plugins/revo-slider/css/navigation.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/landing/plugins/cubeportfolio/css/cubeportfolio.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/landing/plugins/owl-carousel/assets/owl.carousel.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/landing/plugins/fancybox/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/landing/plugins/slider-for-bootstrap/css/slider.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END: BASE PLUGINS -->

    <!-- BEGIN: PAGE STYLES -->
    <link href="{{ asset('assets/landing/plugins/ilightbox/css/ilightbox.css') }}" rel="stylesheet" type="text/css" />
    <!-- END: PAGE STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="{{ asset('assets/landing/demos/corporate_1/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/landing/demos/corporate_1/css/components.css') }}" id="style_components"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/landing/demos/corporate_1/css/themes/default.css') }}" rel="stylesheet"
        id="style_theme" type="text/css" />
    <link href="{{ asset('assets/landing/demos/corporate_1/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME STYLES -->

    <link rel="shortcut icon" href="favicon.ico" />

    @yield('cutomcss')
</head>

<body class="c-layout-header-fixed c-layout-header-mobile-fixed c-layout-header-fullscreen">

    <!-- BEGIN: LAYOUT/HEADERS/HEADER-3 -->
    <!-- BEGIN: HEADER -->
    <header id="header-3"
        class="c-layout-header c-layout-header-7 c-layout-header-dark-mobile c-header-transparent-warning"
        data-minimize-offset="80">
        <div class="c-navbar">
            <div class="container">
                <!-- BEGIN: BRAND -->
                {{-- Ini untuk membuat logonya --}}
                <div class="c-navbar-wrapper clearfix">
                    <div class="c-brand c-pull-left">
                        <a href="index.html" class="c-logo">
                            <img src="{{ asset('assets/media/logos/logo.svg')}}" width="150px" alt="Sipdiment"
                                class="c-desktop-logo">
                            <img src="{{ asset('assets/media/logos/logo.svg')}}" width="150px" alt="Sipdiment"
                                class="c-desktop-logo-inverse">
                            <img src="{{ asset('assets/media/logos/logo.svg')}}" width="150px" alt="Sipdiment"
                                class="c-mobile-logo">
                        </a>
                        <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                            <span class="c-line"></span>
                            <span class="c-line"></span>
                            <span class="c-line"></span>
                        </button>
                        <button class="c-search-toggler" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <!-- END: BRAND -->
                    <!-- BEGIN: QUICK SEARCH -->
                    <form class="c-quick-search" action="#">
                        <input type="text" name="query" placeholder="Type to search..." value="" class="form-control"
                            autocomplete="off">
                        <span class="c-theme-link">&times;</span>
                    </form>
                    <!-- END: QUICK SEARCH -->
                    <!-- BEGIN: HOR NAV -->
                    <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
                    <!-- BEGIN: MEGA MENU -->
                    <!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
                    <nav class="c-mega-menu c-mega-menu-mobile c-fonts-uppercase c-fonts-sbold">
                        <ul class="nav navbar-nav c-theme-nav-right">
                            <li class="c-active c-menu-type-classic">
                                <a href="#home" class="c-link dropdown-toggle c-toggler">Home<span
                                        class="c-arrow c-toggler"></span></a>

{{--
                                <ul class="dropdown-menu c-menu-type-classic c-pull-left">
                                    <li class="c-active">
                                        <a href="index.html">Home Version 1</a>
                                    </li>
                                    <li>
                                        <a href="../corporate_1/onepage-1.html" target="_blank">Onepage Version 1</a>
                                    </li>
                                </ul> --}}

                            </li>
                            <li>
                                <a href="#about" class="c-link">About Us</a>

                            </li>

                            {{-- Menghubungkannya dengan cara routes ke halaman signin --}}
                            <li>
                                <a href="{{route('signin')}}" class="c-link">Sign in</a>

                            </li>
                        </ul>
                        <ul class="nav navbar-nav c-theme-nav-right">

                            {{-- <li class="c-search-toggler-wrapper">
                                <a href="#" class="c-btn-icon c-search-toggler"><i class="fa fa-search"></i></a>
                            </li> --}}



                            {{-- <li class="c-quick-sidebar-toggler-wrapper">
                                <a href="#" class="c-quick-sidebar-toggler">
                                    <span class="c-line"></span>
                                    <span class="c-line"></span>
                                    <span class="c-line"></span>
                                </a>
                            </li> --}}


                        </ul>
                    </nav>
                    <!-- END: MEGA MENU -->
                    <!-- END: LAYOUT/HEADERS/MEGA-MENU -->
                    <!-- END: HOR NAV -->
                </div>
            </div>
        </div>
    </header>
    <!-- END: HEADER -->
    <!-- END: LAYOUT/HEADERS/HEADER-3 -->


    <!-- BEGIN: PAGE CONTAINER -->
    <div class="c-layout-page">
        <!-- BEGIN: PAGE CONTENT -->

        @yield('content')

        <!-- END: PAGE CONTENT -->


    </div>
    <!-- END: PAGE CONTAINER -->

    <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-10 -->
    <a name="footer"></a>
    {{-- <footer class="c-layout-footer c-layout-footer-10 c-bg-white">
        <div class="c-footer">
            <div class="c-layout-footer-10-content container">
                <div class="row"> --}}
                    {{-- <div class="col-md-12">
                        <div class="c-layout-footer-10-title-container">
                            <h3 class="c-layout-footer-10-title">Company Overview</h3>
                            <div class="c-layout-footer-10-title-line"><span class="c-theme-bg"></span></div>
                        </div>
                        <p class="c-layout-footer-10-desc">
                            Lorem ipsum dolor amet adipicing noummy eit seat dias estudiat elit dolore et isum siady et
                            dolor amet adipicing noummy set dias set estudat eliat dolore isum siad set dias noummy
                        </p>
                    </div> --}}
                    {{-- <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="c-layout-footer-10-title-container">
                                    <h3 class="c-layout-footer-10-title">About Us</h3>
                                    <div class="c-layout-footer-10-title-line"><span class="c-theme-bg"> </span>
                                    </div>
                                </div>
                                <ul class="c-layout-footer-10-list">
                                    <li class="c-layout-footer-10-list-item"><a href="#">Contact Us</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Branches</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Our Blog</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Careers</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <div class="c-layout-footer-10-title-container">
                                    <h3 class="c-layout-footer-10-title">Services</h3>
                                    <div class="c-layout-footer-10-title-line"><span class="c-theme-bg"> </span>
                                    </div>
                                </div>
                                <ul class="c-layout-footer-10-list">
                                    <li class="c-layout-footer-10-list-item"><a href="#">Advisory</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Institute</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Strategy</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Alliances</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <div class="c-layout-footer-10-title-container">
                                    <h3 class="c-layout-footer-10-title">Partners</h3>
                                    <div class="c-layout-footer-10-title-line"><span class="c-theme-bg"></span>
                                    </div>
                                </div>
                                <ul class="c-layout-footer-10-list">
                                    <li class="c-layout-footer-10-list-item"><a href="#">Clients</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Suppliers</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Investors</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Groups</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <div class="c-layout-footer-10-title-container">
                                    <h3 class="c-layout-footer-10-title">Achievements</h3>
                                    <div class="c-layout-footer-10-title-line"><span class="c-theme-bg"></span>
                                    </div>
                                </div>
                                <ul class="c-layout-footer-10-list">
                                    <li class="c-layout-footer-10-list-item"><a href="#">Awards</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Trophies</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Our Patents</a></li>
                                    <li class="c-layout-footer-10-list-item"><a href="#">Key People</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                {{-- </div>
            </div> --}}
            <div class="c-layout-footer-10-subfooter-container c-bg-grey">
                <div class="c-layout-footer-10-subfooter container">
                    <div class="c-layout-footer-10-subfooter-content">
                        Copyright © 2022 | Sistem Pakar Diagnosis Mental Illness Metode Naive Bayes
                    </div>
                    {{-- <div class="c-layout-footer-10-subfooter-social">
                        <ul>
                            <li><a href="#" class="socicon-btn socicon-twitter tooltips"
                                    data-original-title="Twitter"></a></li>
                            <li><a href="#" class="socicon-btn socicon-facebook tooltips"
                                    data-original-title="Facebook"></a></li>
                            <li><a href="#" class="socicon-btn socicon-google tooltips"
                                    data-original-title="Google"></a></li>
                            <li><a href="#" class="socicon-btn socicon-yahoo tooltips" data-original-title="Yahoo"></a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </footer><!-- END: LAYOUT/FOOTERS/FOOTER-10 -->

    <!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
    <div class="c-layout-go2top">
        <i class="icon-arrow-up"></i>
    </div><!-- END: LAYOUT/FOOTERS/GO2TOP -->

    <!-- BEGIN: LAYOUT/BASE/BOTTOM -->
    <!-- BEGIN: CORE PLUGINS -->
    <!--[if lt IE 9]>
	<script src="../../assets/global/plugins/excanvas.min.js"></script>
	<![endif]-->
    <script src="{{ asset('assets/landing/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/jquery.easing.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/reveal-animate/wow.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/landing/demos/corporate_1/js/scripts/reveal-animate/reveal-animate.js') }}"
        type="text/javascript"></script>

    <!-- END: CORE PLUGINS -->

    <!-- BEGIN: LAYOUT PLUGINS -->
    <script src="{{ asset('assets/landing/plugins/revo-slider/js/jquery.themepunch.tools.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/revo-slider/js/jquery.themepunch.revolution.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/revo-slider/js/extensions/revolution.extension.slideanims.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('assets/landing/plugins/revo-slider/js/extensions/revolution.extension.layeranimation.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/revo-slider/js/extensions/revolution.extension.navigation.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/revo-slider/js/extensions/revolution.extension.video.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/revo-slider/js/extensions/revolution.extension.parallax.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/owl-carousel/owl.carousel.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/landing/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/landing/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/landing/plugins/fancybox/jquery.fancybox.pack.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/landing/plugins/smooth-scroll/jquery.smooth-scroll.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/landing/plugins/typed/typed.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/slider-for-bootstrap/js/bootstrap-slider.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/js-cookie/js.cookie.js') }}" type="text/javascript"></script>
    <!-- END: LAYOUT PLUGINS -->

    <!-- BEGIN: THEME SCRIPTS -->
    <script src="{{ asset('assets/landing/base/js/components.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/landing/base/js/components-shop.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/landing/base/js/app.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            App.init(); // init core
        });

    </script>
    <!-- END: THEME SCRIPTS -->

    <!-- BEGIN: PAGE SCRIPTS -->
    <script src="{{ asset('assets/landing/demos/corporate_1/js/scripts/revo-slider/slider-15.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/isotope/isotope.pkgd.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/isotope/imagesloaded.pkgd.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/landing/plugins/isotope/packery-mode.pkgd.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/landing/plugins/ilightbox/js/jquery.requestAnimationFrame.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/ilightbox/js/jquery.mousewheel.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/landing/plugins/ilightbox/js/ilightbox.packed.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/landing/demos/default/js/scripts/pages/isotope-gallery.js') }}"
        type="text/javascript">
    </script>
    <script src="{{ asset('assets/landing/plugins/revo-slider/js/extensions/revolution.extension.parallax.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/landing/plugins/revo-slider/js/extensions/revolution.extension.kenburn.min.js') }}"
        type="text/javascript"></script>
    <!-- END: PAGE SCRIPTS -->
    <!-- END: LAYOUT/BASE/BOTTOM -->

    @yield('customjs')
</body>

</html>
