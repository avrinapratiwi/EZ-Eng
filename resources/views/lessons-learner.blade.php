<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>EZ-Eng - Eazy English</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
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
    <link rel="stylesheet" href="{{ asset('css/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plyr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-te-1.4.0.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- end inject -->
    
</head>
<body>

<div class="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<section class="header-menu-area">
    <div class="header-menu-content bg-dark">
        <div class="container-fluid">
            <div class="main-menu-content d-flex flex-column" >
                <div style="padding:16px; margin:10px;">
                    <a href="{{ route('modules-learner') }}"
                    style="
                        display:inline-flex;
                        align-items:center;
                        gap:6px;
                        color:#ffffff;
                        font-size:14px;
                        text-decoration:none;
                        border:1px solid rgba(255,255,255,0.4);
                        padding:6px 12px;
                        border-radius:6px;
                    ">
                        <i class="la la-arrow-left"></i>
                        Back to My Courses
                    </a>
                </div>
            
            </div>
        </div>
    </div>
</section>


<section class="course-dashboard">
    <div class="course-dashboard-wrap">
        <div class="course-dashboard-container d-flex">
            <div class="course-dashboard-column">
                <div class="lecture-video-detail">
                    
                <div class="lecture-tab-body bg-gray p-4">
                    <ul class="nav nav-tabs generic-tab mt-2" id="myTab" role="tablist">
                        <li class="nav-item mobile-menu-nav-item">
                            <span class="fs-15 font-weight-semi-bold text-dark">
                                {{ $module->title }}
                            </span>
                        </li>
                    </ul>
                
                </div>
                
                    <div class="lecture-video-detail-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                <div class="lecture-overview-wrap">
                                    <div class="lecture-overview-item">
                                        <h3 class="fs-24 font-weight-semi-bold pb-2">
                                            {{ $lesson->title }}
                                        </h3>
                                        <div class="lesson-content">
                                            {!! $lesson->konten_html !!}
                                        </div>          </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="course-dashboard-sidebar-column">
                <button class="sidebar-open" type="button">
                    <i class="la la-angle-left"></i> {{ $module->title }} List
                </button>
            
                <div class="course-dashboard-sidebar-wrap custom-scrollbar-styled">
                    <div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
                        <h3 class="fs-18 font-weight-semi-bold">{{ $module->title }} List</h3>
                        <button class="sidebar-close" type="button">
                            <i class="la la-times"></i>
                        </button>
                    </div>
            
                    <div class="course-dashboard-side-content">
                        <div class="accordion generic-accordion">
            
                            @foreach ($module->lessons as $item)
                            <div class="card">
                                <div class="card-header">
                                    @php
                                    // lesson pertama selalu boleh diakses
                                    $isUnlocked = $item->order == 1;
                                
                                    if ($item->order > 1) {
                                        $prevLesson = $module->lessons->firstWhere('order', $item->order - 1);
                                        $isUnlocked = $prevLesson && in_array($prevLesson->id, $completedLessons);
                                    }
                                    @endphp
                                    
                                    <a
                                        @if($isUnlocked)
                                            href="{{ route('learner.lesson', ['module' => $module->id, 'lesson' => $item->id]) }}"
                                        @endif
                                        class="btn btn-link d-flex align-items-center
                                            {{ $item->id == $lesson->id ? 'font-weight-bold text-primary' : '' }}
                                            {{ !$isUnlocked ? 'text-muted disabled' : '' }}"
                                        style="gap:6px; pointer-events: {{ $isUnlocked ? 'auto' : 'none' }};">
                                    
                            
                                        @if(in_array($item->id, $completedLessons))
                                            <i class="la la-check-circle text-primary"
                                               style="font-size:14px; display:inline-block;"></i>
                                        @endif
                            
                                        <span>{{ $item->order }}. {{ $item->title }}</span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            
                            @if ($module->quiz)
                            <div class="card mt-3">
                                <div class="card-header bg-light">
                                    <a
                                        @if($canAccessQuiz)
                                            href="{{ route('quiz.start', $module->quiz->id) }}"
                                            class="btn btn-link d-flex align-items-center gap-2
                                                {{ $quizCompleted ? 'text-success font-weight-bold' : 'text-danger font-weight-bold' }}"
                                        @else
                                            href="javascript:void(0)"
                                            class="btn btn-link text-muted d-flex align-items-center gap-2"
                                            style="cursor:not-allowed;"
                                        @endif
                                    >
                            
                                        @if($quizCompleted)
                                            <i class="la la-check-circle text-success"></i>
                                        @else
                                            <i class="la la-question-circle"></i>
                                        @endif
                            
                                        <span>Quiz: {{ $module->quiz->title }}</span>
                            
                                        @if(!$canAccessQuiz)
                                            <small></small>
                                        @endif
                                    </a>
                                </div>
                            </div>
                            @endif
                            


            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
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