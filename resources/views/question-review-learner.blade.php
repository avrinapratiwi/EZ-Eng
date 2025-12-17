<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>EZ-Eng - Eazy English</title>

    <!-- Google fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
    <link rel="stylesheet" href="{{ asset('css/tooltipster.bundle.css') }}">
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
<section class="breadcrumb-area">
    <div class="bg-dark pt-60px pb-60px">
        <div class="container">
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
            <div class="breadcrumb-content pt-40px">
                <div class="section-heading">
                    <h2 class="section__title text-white fs-30 pb-2">Review your answers</h2>
                </div>
            </div>
        </div><!-- end container -->
    </div>
</section>
<section class="quiz-ans-wrap pt-60px pb-60px">
    <div class="container">
        <div class="mb-4 p-3 border rounded bg-light">
            <h4>Your Score: {{ $score }} / 100</h4>
        </div>        

        @foreach($attempt->answers as $index => $answer)
        <div class="quiz-ans-content mb-4 p-3 border rounded">
            <p class="fs-18 font-weight-bold">
                Question {{ $index + 1 }}: {!! $answer->question->question_text !!}
            </p>
            <ul class="list-group">
                @foreach(['A','B','C','D'] as $option)
                    @php
                        $optionText = $answer->question->{'option_' . strtolower($option)};
                        $isUserAnswer = $answer->user_answer === $option;
                        $isCorrectAnswer = $answer->question->correct_answer === $option;
                        $icon = '';
                        if($isUserAnswer && $isCorrectAnswer) {
                            $icon = '<i class="fa fa-check text-white"></i>'; 
                        } elseif($isUserAnswer && !$isCorrectAnswer) {
                            $icon = '<i class="fa fa-times text-white"></i>'; 
                        } elseif(!$isUserAnswer && $isCorrectAnswer) {
                            $icon = '<i class="fa fa-check text-white"></i>'; 
                        }
                    @endphp
                    <li class="list-group-item
                        @if($isUserAnswer && $isCorrectAnswer) bg-success text-white
                        @elseif($isUserAnswer && !$isCorrectAnswer) bg-danger text-white
                        @elseif(!$isUserAnswer && $isCorrectAnswer) bg-success text-white
                        @endif
                    ">
                        {{ $option }}. {{ $optionText }} {!! $icon !!}
                    </li>

                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</section>




<!-- start scroll top -->
<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>
<!-- end scroll top -->

<!-- template js files -->
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/isotope.js') }}"></script>
<script src="{{ asset('js/waypoint.min.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('js/fancybox.js') }}"></script>
<script src="{{ asset('js/datedropper.min.js') }}"></script>
<script src="{{ asset('js/emojionearea.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>