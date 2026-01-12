<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>EZ-Eng - Eazy English</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" sizes="50x50" href="{{ asset('img/logo_ez-eng.png') }}">
    
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- end inject -->
</head>
<body>

<!-- start cssload-loader -->
<div class="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<!-- end cssload-loader -->

<!--======================================
        START HEADER AREA
    ======================================-->
<header class="header-menu-area">
    <div class="header-menu-content dashboard-menu-content pr-30px pl-30px bg-white shadow-sm">
        <div class="container-fluid">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="logo-box logo--box">
                            <div class="user-btn-action">
                                <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2" data-toggle="tooltip" data-placement="top" title="Search">
                                    <i class="la la-search"></i>
                                </div>
                            </div>
                        </div><!-- end logo-box -->
                        <div class="menu-wrapper">

                            <div class="nav-right-button d-flex align-items-center">
                                <div class="user-action-wrap d-flex align-items-center">
                                    <div class="shop-cart user-profile-cart">
                                        <ul>
                                            <li>
                                                <div class="shop-cart-btn">
                                                    <div class="avatar-xs">
                                                        <img class="rounded-full"
                                                        src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"                                                            alt="Student thumbnail image"
                                                            style="width:100%; height:100%; object-fit:cover;">
                                                    </div>
                                                    <span class="dot-status bg-success"></span>
                                                </div>
                                                <ul class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                    <li class="menu-heading-block d-flex align-items-center">
                                                        <a href="" class="avatar-sm flex-shrink-0 d-block">
                                                            <img class="rounded-full"
                                                            src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"                                                            alt="Student thumbnail image"
                                                            style="width:100%; height:100%; object-fit:cover;">
                                                        </a>
                                                        <div class="ml-2">
                                                            <p class="text-black">{{ ($user->first_name ?? '') . ' ' . ($user->last_name ?? '') }}</p>
                                                            <span class="d-block fs-14 lh-20">{{ $user->email ?? '' }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <ul class="generic-list-item">
                                                            <li>
                                                                <a href="" data-toggle="modal" data-target="#logoutModal">
                                                                    <i class="la la-power-off mr-1"></i> Logout
                                                                </a>                                                                
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->
                                </div>
                            </div><!-- end nav-right-button -->
                        </div><!-- end menu-wrapper -->
                    </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->
    <div class="mobile-search-form">
        <div class="d-flex align-items-center">
            <form method="post" class="flex-grow-1 mr-3">
                <div class="form-group mb-0">
                    <input class="form-control form--control pl-3" type="text" name="search" placeholder="Search for anything">
                    <span class="la la-search search-icon"></span>
                </div>
            </form>
            <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
        </div>
    </div><!-- end mobile-search-form -->
    <div class="body-overlay"></div>
</header><!-- end header-menu-area -->
<!--======================================
        END HEADER AREA
======================================-->

<!-- ================================
    START DASHBOARD AREA
================================= -->
<section class="dashboard-area">
    <div class="off-canvas-menu dashboard-off-canvas-menu off--canvas-menu custom-scrollbar-styled pt-20px">
        <div class="off-canvas-menu-close dashboard-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div><!-- end off-canvas-menu-close -->
        <div style="text-align: center;">
            <img src="{{ asset('img/logo_ez-eng2.png') }}" alt="logo" style="width: 150px;">
        </div>
        <ul class="generic-list-item off-canvas-menu-list off--canvas-menu-list pt-35px">
            <li class="{{ request()->routeIs('dashboard-learner') ? 'page-active' : '' }}">
                <a href="{{ route('dashboard-learner') }}"><i class="fas fa-home mr-2"></i> Dashboard</a>
            </li>
        
            <li class="{{ request()->routeIs('profile-learner') ? 'page-active' : '' }}">
                <a href="{{ route('profile-learner') }}"><i class="fas fa-user mr-2"></i> My Profile</a>
            </li>
        
            <li class="{{ request()->routeIs('modules-learner') ? 'page-active' : '' }}">
                <a href="{{ route('modules-learner') }}"><i class="fas fa-book mr-2"></i> My Courses</a>
            </li>
        
            <li class="{{ request()->routeIs('schedule-learner') ? 'page-active' : '' }}">
                <a href="{{ route('schedule-learner') }}">
                    <i class="fas fa-calendar-alt mr-2"></i> Schedule
                </a>
            </li>                       
        
            <li class="{{ request()->routeIs('reviews-learner') ? 'page-active' : '' }}">
                <a href="{{ route('reviews-learner') }}">
                    <i class="fas fa-star mr-2"></i> Reviews
                </a>
            </li>             
            
            <li class="{{ request()->routeIs('messages-learner') ? 'page-active' : '' }}"> 
                <a href="{{ route('messages-learner') }}">
                    <i class="fas fa-comments mr-2"></i> Discussion
                </a>
            </li>     
        
            <li>
                <a href="" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-power-off mr-2"></i> Logout
                </a>
            </li>
        </ul>
        
    </div><!-- end off-canvas-menu -->
    <div class="dashboard-content-wrap">
        <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3">
            <i class="la la-bars mr-1"></i> Dashboard Nav
        </div>
        <div class="container-fluid">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
                <div class="media media-card align-items-center">
                    <div class="media-img media--img media-img-md rounded-full"
                        style="border: 2px solid #d1d1d1; padding: 3px; width:80px; height:80px; overflow:hidden;">
                        <img class="rounded-full"
                            src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"
                            alt="Student thumbnail image"
                            style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div class="media-body">
                        <h1>Hi! Welcome</h1>
                        <h2 class="section__title fs-30">{{ ($user->first_name ?? '') . ' ' . ($user->last_name ?? '') }}
                        </h2>
                    </div><!-- end media-body -->
                </div><!-- end media -->
            </div>
            
            <div class="section-block mb-5"></div>
            <div class="dashboard-heading mb-5">
                <h3 class="fs-22 font-weight-semi-bold">Reviews</h3>
            </div>

            </div>
            <div class="tab-content" id="myTabContent">
                
                <div class="table-responsive pb-4">
                    <table class="table generic-table">
                        <thead>
                            <tr>
                                <th scope="col">Course Title</th>
                                <th scope="col">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($reviews as $review)     
                        <tr>
                            <th scope="row">
                                <ul class="generic-list-item">
                                    <li>
                                        @if($review['finished_at'])
                                            <span class="badge {{ $review['passed'] ? 'bg-success' : 'bg-danger' }} text-white p-1">
                                                {{ $review['passed'] ? 'Passed' : 'Not Passed' }}
                                            </span>
                                            <span>{{ \Carbon\Carbon::parse($review['finished_at'])->format('d M Y H:i') }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark p-1">Not Attempted</span>
                                        @endif
                                    </li>
                                    <li>
                                        @if($review['review_link'])
                                            <a href="{{ $review['review_link'] }}" class="text-black">
                                                {{ $review['module_title'] }}
                                            </a>
                                        @else
                                            <span class="text-black">{{ $review['module_title'] }}</span>
                                        @endif
                                    </li>
                                </ul>
                            </th>
                        
                            <td>
                                <ul class="generic-list-item">
                                    <li>{{ $review['score'] ?? '-' }}</li>
                                </ul>
                            </td>
                        
                            <td>
                                @if($review['passed'])
                                    <a href=""
                                       class="btn btn-sm btn-success">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                @else
                                    <span class="text-muted">Not Available</span>
                                @endif
                            </td>
                        </tr>      
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- end tab-content -->
            <div class="row align-items-center dashboard-copyright-content pb-4">
                <div class="col-lg-6">
                    <p class="copy-desc">&copy; 2025 EZ-Eng. All Rights Reserved. by 232302 Avrina Pratiwi</p>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 justify-content-end">
                        <li class="mr-3"><a href="terms-and-conditions.html">Terms & Conditions</a></li>
                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                    </ul>
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
</section><!-- end dashboard-area -->
<!-- ================================
    END DASHBOARD AREA
================================= -->

<!-- start scroll top -->
<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>
<!-- end scroll top -->

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Confirm Logout</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                Are you sure you want to log out?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ route('logout') }}" class="btn btn-danger">Yes, Logout</a>
            </div>

        </div>
    </div>
</div>


<!-- template js files -->
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/isotope.js') }}"></script>
<script src="{{ asset('js/waypoint.min.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('js/fancybox.js') }}"></script>
<script src="{{ asset('js/plyr.js') }}"></script>
<script src="{{ asset('js/datedropper.min.js') }}"></script>
<script src="{{ asset('js/emojionearea.min.js') }}"></script>
<script src="{{ asset('js/jquery-te-1.4.0.min.js') }}"></script>
<script src="{{ asset('js/jquery.MultiFile.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>