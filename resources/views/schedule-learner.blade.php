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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.css">
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
    <style>
        .schedule-card.active-highlight {
        
        border: 2px solid #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
        transition: all 0.3s ease;
        }
        .fc-event {
            cursor: pointer;
        }

    </style>

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
                                                            src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"                                                                alt="Student thumbnail image"
                                                                style="width:100%; height:100%; object-fit:cover;">
                                                        </div>
                                                        <span class="dot-status bg-success"></span>
                                                    </div>
                                                    <ul class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                        <li class="menu-heading-block d-flex align-items-center">
                                                            <a href="" class="avatar-sm flex-shrink-0 d-block">
                                                                <img class="rounded-full"
                                                                src="{{ $user->photo ? asset($user->photo) : asset('images/user.png') }}"                                                                alt="Student thumbnail image"
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
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Your Schedule</h1>
            </div>
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
                <h3 class="fs-22 font-weight-semi-bold">Schedule</h3>
            </div>

            @if(count($pastSchedules))
            <section class="past-schedule-area py-4">
                <div class="container-fluid px-30px">
                    <h5 class="fw-bold text-muted mb-3 d-flex align-items-center">
                        <i class="fas fa-history mr-2"></i> Past Schedules
                    </h5>
                    <div class="table-responsive">
                        <table class="table" style="border:1px solid #dee2e6; border-radius:8px; border-collapse: separate; border-spacing:0;">
                            <tbody>
                                @foreach($pastSchedules as $schedule)
                                @php
                                    $participant = $schedule->participants->firstWhere('learner_id', $user->id);
                                
                                    if ($participant && $participant->status === 'PRESENT') {
                                        $statusText = 'Present';
                                        $bgColor = 'rgba(40,167,69,.15)';
                                        $textColor = '#28a745';
                                    } else {
                                        $statusText = 'Absent';
                                        $bgColor = 'rgba(220,53,69,.15)';
                                        $textColor = '#dc3545';
                                    } 
                                @endphp
                            
                            
                                    <tr>
                                        <td style="padding:0.75rem;">
                                            {{ $schedule->title }}
                                            <p class="text-muted mb-0" style="font-size:12px;">
                                                Mentor: {{ $schedule->mentor->name }} • 
                                                {{ \Carbon\Carbon::parse($schedule->meeting_date)->format('d M Y') }} 
                                                {{ \Carbon\Carbon::parse($schedule->meeting_time)->format('H:i') }}
                                            </p>
                                        </td>
                                        <td style="padding:0.75rem; width:150px; text-align:center;">
                                            <span style="background:{{ $bgColor }}; color:{{ $textColor }}; padding:4px 10px; border-radius:4px; font-weight:500;font-size:12px;">
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            @endif
            
            
            <!-- ================================
                    MAIN COURSE AREA (UPCOMING SCHEDULE)
            ================================ -->
            <section class="course-area section--padding">
                <div class="container-fluid">
                    <div class="row">
                    
                        <!-- KIRI: CALENDAR -->
                        <div class="col-lg-8 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
            
                        <!-- KANAN: UPCOMING SCHEDULE LIST -->
                        <div class="col-lg-4">
                            <div class="row">
            
                                {{-- ================= UPCOMING SCHEDULES ================= --}}
                                @if(count($upcomingSchedules))
                                    <div class="col-12 mb-2">
                                        <h5 class="fw-bold">Upcoming Schedules</h5>
                                    </div>
                                    @foreach ($upcomingSchedules as $schedule)
                                        <div class="col-12 mb-4">
                                            <div class="card card-item card-preview card-item-list-layout schedule-card"
                                                data-schedule-id="{{ $schedule->id }}">
                                                <div class="card-body">
                                    
                                                    @php
                                                        // Untuk upcoming, selalu "On Schedule"
                                                        $statusText = 'On Schedule';
                                                        $bgColor = 'rgba(253, 224, 71, 0.2)'; // kuning muda transparan
                                                        $textColor = '#facc15'; // kuning gelap
                                                    @endphp
                                                
                                                    <span style="background:{{ $bgColor }};color:{{ $textColor }};
                                                        padding:4px 10px;border-radius:4px;font-size:13px;">
                                                        {{ $statusText }}
                                                    </span>
                                    
                                                    <h5 class="mt-3">{{ $schedule->title }}</h5>
                                                    <p class="text-muted mb-1">Mentor: {{ $schedule->mentor->name }}</p>
                                    
                                                    <span class="text-secondary">
                                                        {{ \Carbon\Carbon::parse($schedule->meeting_date)->format('d M Y') }}
                                                        •
                                                        {{ \Carbon\Carbon::parse($schedule->meeting_time)->format('H:i') }}
                                                    </span>
                                    
                                                    <div class="text-end mt-3">
                                                        <a href="{{ $schedule->meeting_link }}" target="_blank"
                                                        class="btn btn-primary btn-sm">
                                                            Join Now
                                                        </a>
                                                    </div>
                                    
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                
                                
                                @endif
            
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            
        </div>><!-- end container-fluid -->
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

<script>
    window.scheduleEvents = [
        @foreach(array_merge($upcomingSchedules, $pastSchedules) as $schedule)
        {
            id: "{{ $schedule['id'] }}",
            title: "{{ $schedule['title'] }}",
            start: "{{ $schedule['meeting_date'] }}"
        },
        @endforeach
    ];
</script>


<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.2.0/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.2.0/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
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
<script src="js/calender-learner.js"></script>
</body>
</html>