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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="images/favicon.png">

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
            <div class="breadcrumb-content pt-40px">
                <div class="section-heading">
                    <h2 class="section__title text-white fs-30 pb-2">
                        Question {{ $number }} of {{ $totalQuestions }}
                    </h2>
                </div>
            </div>
        </div><!-- end container -->
    </div>
    <div class="quiz-action-nav bg-white py-3 shadow-sm">
        <div class="container">
            <div class="quiz-action-content d-flex flex-wrap align-items-center justify-content-between">
                <ul class="quiz-nav d-flex align-items-center">
                    <li><i class="la la-sliders fs-17 mr-2"></i>Choose the correct answer below</li>
                </ul>
                
            </div>
        </div><!-- end container -->
    </div><!-- end quiz-action-nav -->
</section>
<section class="quiz-ans-wrap pt-60px pb-60px">
    <div class="container">
        <div class="quiz-ans-content">
            <div style="display:grid;grid-template-columns:repeat(5,min-content);gap:8px;margin-bottom:20px;">
                @foreach($questions as $index => $q)
                @php
                    $isAnswered = in_array($q->id, $answeredQuestionIds);
                    $isActive = ($number == $index + 1);
                @endphp
            
                <a href="{{ route('quiz.question', [$quiz->id, $index + 1]) }}"
                   style="padding:12px 18px;display:inline-flex;align-items:center;justify-content:center;border-radius:6px;font-size:13px;font-weight:600;text-decoration:none;border:1px solid {{ $isAnswered ? '#0d6efd' : '#dee2e6' }};background:{{ $isAnswered ? '#0d6efd' : '#fff' }};color:{{ $isAnswered ? '#fff' : '#212529' }};{{ $isActive ? 'box-shadow:0 0 0 2px rgba(13,110,253,.3);' : '' }}">
                    {{ $index + 1 }}
                </a>
                @endforeach
            </div>                         
            <p class="fs-22 font-weight-semi-bold">
                {!! $question->question_text !!}
            </p>
            <form action="{{ route('quiz.answer', [$quiz->id, $question->id]) }}" method="POST">
                @csrf
                <div class="quiz-ans-list py-3">
                    @foreach(['a','b','c','d'] as $opt)
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" name="answer" value="{{ strtoupper($opt) }}" class="custom-control-input" id="{{ $opt }}" required>
                        <label class="custom-control-label" for="{{ $opt }}">
                            {{ $question->{'option_'.$opt} }}
                        </label>
                    </div>
                    @endforeach
                </div>
            
                <div class="quiz-nav-btns mt-5">
                    @if ($number > 1)
                        <a href="{{ route('quiz.question', [$quiz->id, $number - 1]) }}" class="btn btn-primary">
                            <i class="la la-angle-left"></i> Back
                        </a>
                    @endif
            
                    <button type="submit" class="btn btn-primary">
                        @if($number < $totalQuestions)
                            Next <i class="la la-angle-right"></i>
                        @else
                            Finish Quiz
                        @endif
                    </button>
                </div>
            </form>
            
            </div><!-- end quiz-ans-list -->
        </div>
    </div><!-- end container -->
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