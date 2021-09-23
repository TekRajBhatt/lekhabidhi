<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap')}}" rel="stylesheet">
    <link rel="icon" type="" href="{{ asset('img/icon.png')}}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/line-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flaticon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('css/metisMenu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lightslider.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lightgallery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css')}}">
    <title>Home</title>
</head>
<body>

    <div class="wrapper">

        <!-- Top Header -->
        <div class="top-header">
            <div class="container">
                <ul>
                    <li>
                        <i class="flaticon-phone-call"></i>
                        <b>Call Now :</b>
                        <a href="#">+977 123 456 789</a>
                    </li>
                    <li>
                        <i class="flaticon-message"></i>
                        <b>Email Address :</b>
                        <a href="#">nectardigit@gmail.com</a>
                    </li>
                    <li>
                        <div class="social-media">
                            <ul>
                                <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                <li class="twitter"><a href="#"><i class="lab la-twitter"></i></a></li>
                                <li class="youtube"><a href="#"><i class="lab la-youtube"></i></a></li>
                                <li class="linkedin"><a href="#"><i class="lab la-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="search">
                            <div class="search-box">
                                <i class="flaticon-search"></i>
                            </div>
                            <div class="search-overlay">
                                <div class="d-table">
                                    <div class="d-table-cell">
                                        <div class="search-overlay-layer"></div>
                                        <div class="search-overlay-layer"></div>
                                        <div class="search-overlay-layer"></div>
                                        <div class="search-overlay-close">
                                            <span class="search-overlay-close-line"></span>
                                            <span class="search-overlay-close-line"></span>
                                        </div>
                                        <div class="search-overlay-form">
                                            <form>
                                                <input type="text" class="input-search" placeholder="Search here...">
                                                <button type="submit"><i class="flaticon-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Top Header End -->

        <!-- Header -->
        <header id="header" class="header">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo">
                        <a href="#"><img src="img/logo.png" alt="images"></a>
                    </div>
                    <div class="header-menu">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="#">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="">Software</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Services
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                            {{-- @foreach ($services as $service)
                                            <li><a href="#">{{ $service->title }}</a></li>
                                            @endforeach --}}
                                            <li><a class="dropdown-item" href="#">Stock Management</a></li>
                                            <li><a class="dropdown-item" href="#">Inventory Management</a></li>
                                            <li><a class="dropdown-item" href="#">Accounting Management</a></li>
                                            <li><a class="dropdown-item" href="#">Capital Management</a></li>
                                            <li><a class="dropdown-item" href="#">Goodwill Management</a></li>
                                            <li><a class="dropdown-item" href="#">System Management</a></li>
                                            <li><a class="dropdown-item" href="#">Market Management</a></li>

                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('singleteam')}}">Team</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">News</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="header-btn">
                        <div class="main-btn">
                            <a href="#">Get a Free Quote <i class="las la-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="toggle-btn">
                        <div class="toggle-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="toggle-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="toggle-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header End -->

        <!-- Mobile Menu -->
        <div id="mySidenav" class="sidenav">
            <div class="mobile-logo">
                <a href="index.html"><img src="img/logo.png" alt="logo"></a>
                <a href="javascript:void(0)" id="close-btn" class="closebtn">&times;</a>
            </div>
            <div class="no-bdr1">
                <ul id="menu1">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Software</a></li>
                    <li>
                        <a href="#" class="has-arrow">Services</a>
                        <ul>
                            <li>
                                <a href="#">General Members</a>
                            </li>
                            <li>
                                <a href="#">Associate Members</a>
                            </li>
                            <li>
                                <a href="#">Honorary Members</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Team</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <!-- Mobile Menu End -->



  
        {{-- dynamic content starts from here --}}
        {{-- dynamic content starts from here --}}
        {{-- dynamic content starts from here --}}
        {{-- dynamic content starts from here --}}
        {{-- dynamic content starts from here --}}
        {{-- dynamic content starts from here --}}
        @yield('content')


        {{-- footer section starts from here --}}
        {{-- footer section starts from here --}}
        {{-- footer section starts from here --}}
        {{-- footer section starts from here --}}
        {{-- footer section starts from here --}}
        {{-- footer section starts from here --}}
 


        <!-- Footer -->
        <footer id="footer" class="pt">
            <div class="footer-bg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <h3>Company</h3>
                        <ul class="footer-links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Software</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3>Social Media</h3>
                        <ul class="social-links">
                            <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i> Facebook</a></li>
                            <li class="youtube"><a href="#"><i class="lab la-youtube"></i> Youtube</a></li>
                            <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i> Whatsapp</a></li>
                            <li class="twitter"><a href="#"><i class="lab la-twitter"></i> Twitter</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3>Newsletter</h3>
                        <p>Quis autem veleum prehendet voluptate velit esse</p>
                        <form action="" method="get">
                            <input type="email" name="email" placeholder="Email Address" class="form-control">
                            <div class="main-btn">
                                <a href="#">Subscription <i class="las la-angle-double-right"></i></a>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <img src="img/logo.png" alt="images">
                        <ul class="footer-contact">
                            <li>
                                <i class="flaticon-signs"></i>
                                <span>256 Elizaberth Ave, Brooklyn, CA, 90025</span>
                            </li>
                            <li>
                                <i class="flaticon-message"></i>
                                <span>example@example.com</span>
                            </li>
                            <li>
                                <i class="flaticon-phone-call"></i>
                                <span>+977 123 456 789</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="copyright">
                    <p>
                        ©2021 Lekhabidhi Accounting Software. All Rights Reserved.
                    </p>
                </div>
            </div>
        </footer>
        <!-- Footer End -->
    </div>
    
    <script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/jquery-ui.js') }}"></script>
	<script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('js/lightslider.min.js') }}"></script>
	<script src="{{ asset('js/lightgallery-all.min.js') }}"></script>
	<script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
