<!DOCTYPE html>
<html>

<head>
    <meta name="robots" content="all" />
    <meta name="sogou_site_verification" content="" />
    <meta name="yandex-verification" content="" />
    <meta name="360-site-verification" content="" />
    <meta property="google-site-verification" content="" />
    <meta charset="utf-8" />
    <title>{{env("APP_NAME")}}</title>
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
    <script src="{{mix('js/app.js')}}"></script>
</head>

<body>
    <div id="container">
        <div class="page" style="top:0;left:0;right:0;bottom:0;position:fixed;background-image: url({{url('/images/pages/23.jpg')}})"></div>
    </div>
    <div id="header">
        <div id="logo">
            <img src="{{asset('images/logo.png')}}" alt="{{env('APP_NAME')}}" />
        </div>
        <div id="nav">
            <img src="{{asset('images/icon-menu.png')}}" alt="menu" />
        </div>
    </div>
    @include('components.menu',['page'=>'projects'])
    <div id="menuWrapper" class="hidden"></div>
    {{-- <div class="arrowBottom">
        <img id="arrowDown" src="{{asset('images/icon-arrow-down.png')}}" alt="next" />
        <img id="arrowUp" src="{{asset('images/icon-arrow-up.png')}}" alt="prev" class="hidden" />
    </div> --}}
    <script>
        @if(env('APP_ENV') === 'production')
        window.oncontextmenu = function(e) {
            e.preventDefault();
        }
        @endif

        function resizePage() {
            // const height = $(".fp-tableCell").height();
            // const width = $(".fp-tableCell").width();
            // let left = 0;
            // let width1 = 0;
            // if (width / height > 1920 / 1080) {
            //     width1 = height * (1920 / 1080);
            //     left = ($("#container").width() - width1) / 2;
            //     // $(".page").width(height * (1920 / 1080));
            // } else {
            //     width1 = width;
            //     left = 0;
            // }
            // $("#header").css({
            //     left: left + "px"
            // });
            // $("#header").width(width1);
            // $("#menuWrapper").width(width1);
            // $("#menuWrapper").css({
            //     left: left + "px"
            // });
            // $("#menu").css({
            //     right: left + "px"
            // });
            // $(".fp-controlArrow.fp-next").css({
            //     right: (left + 140) + "px"
            // });
            // $(".fp-controlArrow.fp-prev").css({
            //     left: (left + 140) + "px"
            // });
            // $(".arrowBottom").css({
            //     left: (left + 140) + "px"
            // });
        }
        $().ready(function() {
            // resizePage();
            $("#menu .close").click(() => {
                $("#menu").addClass("hidden");
                $("#menuWrapper").addClass("hidden");
                $("#nav").css({
                    opacity: 1
                });
            });
            $("#nav").click(() => {
                $("#menu").removeClass("hidden");
                $("#menuWrapper").removeClass("hidden");
                $("#nav").css({
                    opacity: 0
                });
            });

            $('#menus li a').click(function() {
                $("#menu").addClass("hidden");
                $("#menuWrapper").addClass("hidden");
                $("#nav").css({
                    opacity: 1
                });
                // const section = fullpage_api.getActiveSection();
                // $('#menus .item').removeClass("active");
                // $(this).addClass("active");
                // $("#menus").find(".item").get(section.index).addClass(".active");
            });
        });

    </script>
</body>

</html>
