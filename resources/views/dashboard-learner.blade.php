<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>EZ-Eng - Eazy English</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="50x50" href="img/logo_ez-eng.png">


    <!-- inject:css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/line-awesome.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/fancybox.css">
    <link rel="stylesheet" href="css/style.css">
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
                                                        src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"
                                                        alt="Student thumbnail image"
                                                        style="width:100%; height:100%; object-fit:cover;">                                                    </div>
                                                        <span class="dot-status bg-success"></span>
                                                    </div>
                                                <ul class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                    <li class="menu-heading-block d-flex align-items-center">
                                                        <a href="{{ route('profile-learner') }}" class="avatar-sm flex-shrink-0 d-block">
                                                            <img class="rounded-full"
                                                            src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"
                                                            alt="Student thumbnail image"
                                                            style="width:100%; height:100%; object-fit:cover;">                                                        </a>
                                                        <div class="ml-2">
                                                            <p class="text-black">{{ ($user->first_name ?? '') . ' ' . ($user->last_name ?? '') }}</p>
                                                            <span class="d-block fs-14 lh-20">{{ $user->email ?? '' }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <ul class="generic-list-item">
                                                            <li>
                                                                <a href="#" data-toggle="modal" data-target="#logoutModal">
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
            <img src="img/logo_ez-eng2.png" alt="logo" style="width: 150px;">
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
                    <i class="fas fa-envelope mr-2"></i> Messages
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
                        style="border: 2px solid #d1d1d1; padding: 3px;">
                        <img class="rounded-full"
                        src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"
                        alt="Student thumbnail image"
                        style="width:100%; height:100%; object-fit:cover;">                    </div>
                    <div class="media-body">
                        <h1>Hi! Welcome</h1>
                        <h2 class="section__title fs-30">{{ ($user->first_name ?? '') . ' ' . ($user->last_name ?? '') }}
                        </h2>
                    </div><!-- end media-body -->
                </div><!-- end media -->
            </div><!-- end breadcrumb-content -->
            <div class="section-block mb-5" style="height:4px; background-color:#e5e5e5;"></div>
            <div class="dashboard-heading mb-5">
                <h3 class="fs-22 font-weight-semi-bold">Dashboard</h3>
            </div>
            
            <div class="row mt-2">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card card-item p-3 d-flex align-items-center">
                        <div class="icon-element flex-shrink-0 bg-1 text-white">
                            <i class="fas fa-book" style="font-size: 36px;"></i>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 ml-3">
                            <p class="card-text fs-18 mb-1">Lessons</p>
                            <h5 class="card-title fs-26 mb-0">{{ $totalModules }}</h5>
                        </div>
                    </div>
                </div>
            
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card card-item p-3 d-flex align-items-center">
                        <div class="icon-element flex-shrink-0 bg-2 text-white">
                            <i class="fas fa-question-circle" style="font-size: 36px;"></i>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 ml-3">
                            <p class="card-text fs-18 mb-1">Quizzes</p>
                            <h5 class="card-title fs-26 mb-0">{{ $totalQuizzes }}</h5>
                        </div>
                    </div>
                </div>
            
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card card-item p-3 d-flex align-items-center">
                        <div class="icon-element flex-shrink-0 bg-3 text-white">
                            <i class="fas fa-calendar-alt" style="font-size: 36px;"></i>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 ml-3">
                            <p class="card-text fs-18 mb-1">Upcoming Schedules</p>
                            <h5 class="card-title fs-26 mb-0">{{ $upcomingSchedules }}</h5>
                        </div>
                    </div>
                </div>
            
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card card-item p-3 d-flex align-items-center">
                        <div class="icon-element flex-shrink-0 bg-4 text-white">
                            <i class="fas fa-check-circle" style="font-size: 36px;"></i>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 ml-3">
                            <p class="card-text fs-18 mb-1">Completed Courses</p>
                            <h5 class="card-title fs-26 mb-0">{{ $completedCourses }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            <!-- Row: Progress Chart & Leaderboard -->
            <div class="row mt-2">
                <!-- Progress Chart -->
                <div class="col-lg-4 responsive-column-half mb-4">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="fs-18 font-weight-semi-bold pb-4">Progress</h3>
                            <canvas id="doughnut-chart"></canvas>
                            <div id="legend" class="mt-40px text-center"></div>
                        </div>
                    </div>
                </div>

                <!-- Leaderboard -->
                <div class="col-lg-8 responsive-column-half mb-4">
                    <div class="card card-item p-3">
                        <h3 class="fs-22 font-weight-semi-bold mb-4">Leaderboard</h3>
                        <div style="max-height: 300px; overflow-y: auto;">
                            <table class="table" style="border-collapse: separate; border-spacing: 0 10px;">
                                <thead>
                                    <tr>
                                        <th style="text-align:left;"></th>
                                        <th style="text-align:left;"></th>
                                        <th style="text-align:left;"></th>
                                        <th style="text-align:left;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leaderboard as $index => $item)
                                    @php
                                        $bgColor = 'transparent';
                                        $medalIcon = '';
                                        if($index == 0){
                                            $bgColor = 'rgba(255, 193, 7, 0.3)'; // emas sedikit gelap
                                            $medalIcon = '<i class="fas fa-medal" style="color: #FFD700;"></i>'; // medali emas
                                        } elseif($index == 1){
                                            $bgColor = 'rgba(192, 192, 192, 0.3)'; // perak sedikit gelap
                                            $medalIcon = '<i class="fas fa-medal" style="color: #C0C0C0;"></i>'; // medali perak
                                        } elseif($index == 2){
                                            $bgColor = 'rgba(205, 127, 50, 0.3)'; // perunggu sedikit gelap
                                            $medalIcon = '<i class="fas fa-medal" style="color: #CD7F32;"></i>'; // medali perunggu
                                        }
                                    @endphp
                                    <tr style="background-color: {{ $bgColor }}; border-radius: 10px; overflow: hidden;">
                                        <td style="width:50px; text-align:center;">
                                            @if($index <= 2)
                                                {!! $medalIcon !!}
                                            @else
                                                #{{ $index + 1 }}
                                            @endif
                                        </td>
                                        <td style="width:50px;">
                                            <img src="{{ $item['learner']->photo ? asset($item['learner']->photo) : asset('images/user.png') }}"
                                                alt="Learner Photo"
                                                style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
                                        </td>
                                        <td>{{ $item['learner']->first_name }} {{ $item['learner']->last_name }}</td>
                                        <td>{{ $item['progressPercentage'] }}%</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>


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

<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/isotope.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/fancybox.js"></script>
<script src="js/chart.js"></script>
<script src="js/doughnut-chart.js"></script>
<script src="js/bar-chart.js"></script>
<script src="js/line-chart.js"></script>
<script src="js/datedropper.min.js"></script>
<script src="js/emojionearea.min.js"></script>
<script src="js/animated-skills.js"></script>
<script src="js/jquery.MultiFile.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>