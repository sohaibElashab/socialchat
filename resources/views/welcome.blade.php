<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SocialV</title>
        <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" />
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/typography.css')}}" rel="stylesheet" >
        <link href="{{asset('css/style.css')}}" rel="stylesheet" >
        <link href="{{asset('css/responsive.css')}}" rel="stylesheet" > 
        <style>
            #loading { background-color: var(--iq-dark-bg); height: 100%; width: 100%;  position: fixed; margin-top: 0px; top: 0px; left: 0px; bottom: 0px; overflow: hidden !important; right: 0px; z-index: 999999;}
            #loading-center {background: url(../images/loader.png) no-repeat scroll center center;background-size: 10%; width: 100%; height: 100%; position: relative; }
            .loader { width: 3em; height: 3em; margin: auto; left: 0; right: 0; top: 0; bottom: 0; position: absolute; }
        </style>
    </head>
    <body >
        <div id="app">
            <div id="loading">
                <div id="loading-center">
                </div>
            </div>
            <router-view></router-view>
        </div>
        <!-- Optional JavaScript -->
        <script src="{{asset('js/app.js')}}" ></script>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <!-- Appear JavaScript -->
        <script src="{{asset('js/jquery.appear.js')}}"></script>
        <!-- Countdown JavaScript -->
        <script src="{{asset('js/countdown.min.js')}}"></script>
        <!-- Counterup JavaScript -->
        <script src="{{asset('js/waypoints.min.js')}}"></script>
        <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
        <!-- Wow JavaScript -->
        <script src="{{asset('js/wow.min.js')}}"></script>
        <!-- Apexcharts JavaScript -->
        <script src="{{asset('js/apexcharts.js')}}"></script>
        <!-- Slick JavaScript -->
        <script src="{{asset('js/slick.min.js')}}"></script>
        <!-- Select2 JavaScript -->
        <script src="{{asset('js/select2.min.js')}}"></script>
        <!-- Owl Carousel JavaScript -->
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <!-- Magnific Popup JavaScript -->
        <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
        <!-- Smooth Scrollbar JavaScript -->
        <script src="{{asset('js/smooth-scrollbar.js')}}"></script>
        <!-- lottie JavaScript -->
        <script src="{{asset('js/lottie.js')}}"></script>
        <!-- am core JavaScript -->
        <script src="{{asset('js/core.js')}}"></script>
        <!-- am charts JavaScript -->
        <script src="{{asset('js/charts.js')}}"></script>
        <!-- am animated JavaScript -->
        <script src="{{asset('js/animated.js')}}"></script>
        <!-- am kelly JavaScript -->
        <script src="{{asset('js/kelly.js')}}"></script>
        <!-- am maps JavaScript -->
        <script src="{{asset('js/maps.js')}}"></script>
        <!-- am worldLow JavaScript -->
        <script src="{{asset('js/worldLow.js')}}"></script>
        <!-- Chart Custom JavaScript -->
        <script src="{{asset('js/chart-custom.js')}}"></script>
        <!-- Custom JavaScript -->
        <script src="{{asset('js/custom.js')}}"></script>
    </body>
</html>