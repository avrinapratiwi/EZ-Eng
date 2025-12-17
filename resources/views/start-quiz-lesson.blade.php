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
</div><section class="quiz-ans-wrap pt-80px pb-80px">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="section__title">{{ $quiz->title }}</h2>
            <!-- WARNING TEXT -->
            <p class="mt-2 text-muted" style="font-size:14px;">
                If you are confident and ready, you may proceed. Please note that this quiz can only be taken once.
            </p>
        </div>

        <div class="row pt-50px">
            <div class="col">
                <div class="quiz-result-content text-center mb-4">
                    <!-- TOTAL QUESTIONS -->
                    <h2 class="section__title">{{ $quiz->questions_count }}</h2>

                    <p class="section__desc text-black font-weight-semi-bold pt-2">
                        Questions
                    </p>

                </div>
            </div>

            <div class="col-12">
                <div class="click-to-start-btn-box text-center pt-3">
                    <a href="{{ route('quiz.question', [$quiz->id, 1]) }}"
                        class="btn btn-primary">
                         Click to Start Test
                     </a>                     
                </div>
            </div>
        </div>
    </div>
</section>

</section><!-- end footer-area -->
<!-- ================================
          END FOOTER AREA
================================= -->

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