<!DOCTYPE html>
<html>

<head>
    <meta name="robots" content="all" />
    <meta name="sogou_site_verification" content="" />
    <meta name="yandex-verification" content="" />
    <meta name="360-site-verification" content="" />
    <meta property="google-site-verification" content="" />
    <meta charset="utf-8" />
    <title>{{__(env("APP_NAME"))}}</title>
    <meta name="keywords" content="" />
    <meta name="description" content="{{env('APP_NAME')}}" />
    <meta property="og:url" content="{{env('APP_URL')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{env('APP_NAME')}}" />
    <meta property="og:site_name" content="{{env('APP_NAME')}}" />
    <meta property="og:image" content="{{env('APP_IMAGE')}}" />
    <meta property="twitter:title" content="{{env('APP_NAME')}}" />
    <meta property="twitter:site" content="{{env('APP_NAME')}}" />
    <meta property="twitter:image" content="{{env('APP_IMAGE')}}" />
    <meta property="twitter:image:src" content="{{env('APP_IMAGE')}}" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1.0,initial-scale=1,user-scalable=no,viewport-fit=true" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" href="{{asset('css/fullpage.min.css')}}">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <script src="{{asset('js/easings.min.js')}}"></script>
    <script src="{{asset('js/scrolloverflow.min.js')}}"></script>
    <script src="{{asset('js/fullpage.min.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    {{-- <script src="{{mix('js/app.js')}}"></script> --}}
</head>

<body>
    <div id="container">
        @foreach($pages as $key => $items)
        <div class="section @class(['active'=>$key===0]) data-anchor="{{$key}}">
            @foreach($items as $k => $item)
            @if(count($items) > 1)
            <div class="slide">
            @endif
                <div class="page {{"page-{$key}-{$k}"}}">
                    @if(isset($item['title']))
                    <div class="title xs-hidden"><img src="{{$item['title']['image']??''}}" alt="" /></div>
                    <div class="title md-hidden"><img src="{{$item['title']['mobileImage']??''}}" alt="" /></div>
                    @endif
                    @if(isset($item['footer']))
                    <div class="footer md-hidden"><img src="{{$item['footer']['mobileImage']??''}}" alt="" /></div>
                    <div class="footer xs-hidden"><img src="{{$item['footer']['image']??''}}" alt="" /></div>
                    @endif
                </div>
            @if(count($items) > 1)
            </div>
            @endif
            @endforeach
        </div>
        @endforeach
    </div>
    <div id="header">
        <div id="logo">
            <img src="{{asset('images/logo.png')}}" alt="{{env('APP_NAME')}}" />
        </div>
        <div id="nav">
            <img src="{{asset('images/icon-menu.png')}}" alt="menu" />
        </div>
    </div>
    @include('components.menu')
    <div id="menuWrapper" class="hidden"></div>
    <div class="arrowBottom">
        <img id="arrowDown" src="{{asset('images/icon-arrow-down.png')}}" alt="next" />
        <img id="arrowUp" src="{{asset('images/icon-arrow-up.png')}}" alt="prev" class="hidden" />
    </div>
    <div id="footer"><a href="https://beian.miit.gov.cn/" target="_blank">{{$record_number}}</a></div>
    <script>
        @if(env('APP_ENV') === 'production')
        window.oncontextmenu = function(e) {
            e.preventDefault();
        }
        @endif

        $().ready(function() {
            $("#menu .close").click(function(){

                $("#menu").addClass("hidden");
                $("#menuWrapper").addClass("hidden");
                $("#nav").css({
                    opacity: 1
                });
            });
            $("#nav").click(function(){
                $("#menu").removeClass("hidden");
                $("#menuWrapper").removeClass("hidden");
                $("#nav").css({
                    opacity: 0
                });
            });

            $('#menus li a').click(function() {
                if($(this).text()!=="{{__('精彩项目')}}"){
                    $("#menu").addClass("hidden");
                    $("#menuWrapper").addClass("hidden");
                    $("#nav").css({
                        opacity: 1
                    });
                }
            });
        });

        new fullpage('#container', {
            autoScrolling: true
            , scrollHorizontally: true
            , menu: "#menus"
            , navigation: false
            , navigationPosition: 'right'
            , showActiveTooltip: false
            , slidesNavigation: true
            , slidesNavPosition: 'bottom'
            , loopHorizontal: false
            // , scrollingSpeed: 1000
            // , easing: 'easeInQuart'
            , easingcss3: 'linear'
            // ,lazyLoading:true
            , afterLoad: function(origin, destination, direction) {
                if (destination.anchor == 'contactus') {
                    $("#arrowDown").addClass("hidden");
                    $("#arrowUp").removeClass("hidden");
                } else {
                    $("#arrowDown").removeClass("hidden");
                    $("#arrowUp").addClass("hidden");
                }
            },
            css3: true
        , });

        $("#arrowUp").click(function() {
            fullpage_api.moveSectionUp();
        });
        $("#arrowDown").click(function() {
            fullpage_api.moveSectionDown();
        });
    </script>
</body>

</html>
