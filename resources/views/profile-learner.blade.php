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
                                                        src="{{ $user->photo ? asset('storage/'.$user->photo) : asset('images/user.png') }}"
                                                        alt="Student thumbnail image"
                                                            style="width:100%; height:100%; object-fit:cover;">
                                                    </div>
                                                    <span class="dot-status bg-success"></span>
                                                </div>
                                                <ul class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                    <li class="menu-heading-block d-flex align-items-center">
                                                        <a href="" class="avatar-sm flex-shrink-0 d-block">
                                                            <img class="rounded-full"
                                                            src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"
                                                            alt="Student thumbnail image"
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
                        src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"
                        alt="Student thumbnail image"
                            style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div class="media-body">
                        <h1>Hi! Welcome</h1>
                        <h2 class="section__title fs-30">{{ ($user->first_name ?? '') . ' ' . ($user->last_name ?? '') }}
                        </h2>
                    </div><!-- end media-body -->
                </div><!-- end media -->
            </div><!-- end breadcrumb-content -->
            <div class="section-block mb-5"></div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
                    <div class="setting-body">
                        <h3 class="fs-17 font-weight-semi-bold pb-4">Edit Profile</h3>
                        
                        <!-- FORM UPDATE PROFILE -->
                        <form method="POST" 
                              action="{{ route('update-profile-learner') }}"
                              enctype="multipart/form-data"
                              class="row pt-40px">
                            @csrf
                        
                            <!-- FOTO PROFILE -->
                            <div class="col-12 mb-4">
                                <div class="media media-card align-items-center">
                                    <div class="media-img media-img-lg mr-4 bg-gray" style="width:150px; height:150px; overflow:hidden;">
                                        <img class="mr-4"
                                            src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"
                                            alt="User Photo"
                                            style="width:100%; height:100%; object-fit:cover;">
                                    </div>
                                    <div class="media-body">
                                        <div class="file-upload-wrap file-upload-wrap-2">
                                            <input type="file" name="photo" class="multi file-upload-input with-preview">
                                            <span class="file-upload-text">
                                                <i class="la la-photo mr-2"></i> Upload a Photo
                                            </span>
                                        </div>
                                        @if($user->photo)
                                        <div class="mt-2">
                                            <label>
                                                <input type="checkbox" name="delete_photo" value="1"> Delete Photo
                                            </label>
                                        </div>
                                        @endif
                                        <p class="fs-14">Max file size 5MB – JPG/PNG</p>
                                    </div>
                                </div>
                            </div>
                          
                        
                            <!-- FIRST NAME -->
                            <div class="input-box col-lg-6 col-md-12 mb-3">
                                <label class="label-text">First Name</label>
                                <div class="form-group">
                                    <input class="form-control form--control"
                                           type="text"
                                           name="first_name"
                                           value="{{ $user->first_name }}">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div>
                        
                            <!-- LAST NAME -->
                            <div class="input-box col-lg-6 col-md-12 mb-3">
                                <label class="label-text">Last Name</label>
                                <div class="form-group">
                                    <input class="form-control form--control"
                                           type="text"
                                           name="last_name"
                                           value="{{ $user->last_name }}">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div>
                        
                            <!-- USERNAME -->
                            <div class="input-box col-lg-6 col-md-12 mb-3">
                                <label class="label-text">User Name</label>
                                <div class="form-group">
                                    <input class="form-control form--control"
                                           type="text"
                                           name="username"
                                           value="{{ $user->username }}">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div>
                        
                            <!-- EMAIL -->
                            <div class="input-box col-lg-6 col-md-12 mb-3">
                                <label class="label-text">Email Address</label>
                                <div class="form-group">
                                    <input class="form-control form--control"
                                           type="email"
                                           name="email"
                                           value="{{ $user->email }}">
                                    <span class="la la-envelope input-icon"></span>
                                </div>
                            </div>
                        
                            <!-- PHONE -->
                            <div class="input-box col-lg-6 col-md-12 mb-3">
                                <label class="label-text">Phone Number</label>
                                <div class="form-group">
                                    <input class="form-control form--control"
                                           type="text"
                                           name="phone_number"
                                           value="{{ $user->phone_number }}">
                                    <span class="la la-phone input-icon"></span>
                                </div>
                            </div>
                        
                            <!-- GENDER -->
                            <div class="input-box col-lg-6 col-md-12 mb-3">
                                <label class="label-text">Gender</label>
                                <div class="form-group">
                                    <select class="form-control form--control" name="gender">
                                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    <span class="la la-venus-mars input-icon"></span>
                                </div>
                            </div>
                        
                            <!-- ADDRESS -->
                            <div class="input-box col-12 mb-3">
                                <label class="label-text">Address</label>
                                <div class="form-group">
                                    <input class="form-control form--control"
                                           type="text"
                                           name="address"
                                           value="{{ $user->address }}">
                                    <span class="la la-map-marker input-icon"></span>
                                </div>
                            </div>
                        
                            <!-- BIO -->
                            <div class="input-box col-12 mb-3">
                                <label class="label-text">Bio</label>
                                <div class="form-group">
                                    <textarea class="form-control form--control user-text-editor pl-3"
                                              name="bio">{{ $user->bio }}</textarea>
                                </div>
                            </div>
                        
                            <!-- BUTTON SUBMIT -->
                            <div class="input-box col-12 py-2">
                                <button class="btn btn-primary w-100">Save Changes</button>
                            </div>
                        
                        </form>
                        
                    </div>
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
<script src="js/jquery-3.4.1.min.js"></script>
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