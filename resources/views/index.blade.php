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
    <link rel="stylesheet" href="{{asset('css/fullpage.min.css')}}">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <script src="{{asset('js/easings.min.js')}}"></script>
    <script src="{{asset('js/scrolloverflow.min.js')}}"></script>
    <script src="{{asset('js/fullpage.min.js')}}"></script>
    <script src="{{mix('js/app.js')}}"></script>
</head>

<body>
    <div id="container">
        <div class="section active" data-anchor="home">
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/1-1.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/1-2.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/1-3.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/1-4.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/1-5.jpg')}})"></div>
            </div>
        </div>
        <div class="section" data-anchor="aboutcitta1">
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/2-1.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/2-2.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/2-3.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/2-4.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/2-5.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/2-6.jpg')}})"></div>
            </div>
        </div>
        <div class="section" data-anchor="aboutcitta2">
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/3-1.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/3-2.jpg')}})"></div>
            </div>
        </div>
        <div class="section" data-anchor="aboutkwah1">
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/4-1.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/4-2.jpg')}})"></div>
            </div>
            <div class="slide">
                <div class="page" style="background-image: url({{asset('/images/pages/4-3.jpg')}})"></div>
            </div>
        </div>
        <div class="section" data-anchor="aboutkwah2">
            <div class="page" style="background-image: url({{asset('/images/pages/5-1.jpg')}})"></div>
        </div>
        <div class="section" data-anchor="aboutkwah3">
            <div class="page" style="background-image: url({{asset('/images/pages/5-2.jpg')}})"></div>
        </div>
        <div class="section" data-anchor="aboutkwah4">
            <div class="page" style="background-image: url({{asset('/images/pages/5-3.jpg')}})"></div>
        </div>
        <div class="section" data-anchor="aboutkwah5">
            <div class="page" style="background-image: url({{asset('/images/pages/5-4.jpg')}})"></div>
        </div>
        <div class="section" data-anchor="contactus">
            <div class="page" style="background-image: url({{asset('/images/pages/6-1.jpg')}})"></div>
        </div>
    </div>
    <div id="header">
        <div id="logo">
            <img src="{{asset('images/logo.png')}}" alt="{{env('APP_NAME')}}" />
        </div>
        <div id="nav">
            <img src="{{asset('images/icon-menu.png')}}" alt="menu" />
        </div>
    </div>
    <div id="menu" class="hidden">
        <div class="header">
            <div class="languages">
                <span class="active">中</span><span>繁</span><span>Eng</span>
            </div>
            <div class="close">
                <img src="{{asset('images/icon-close.png')}}" alt="close" />
            </div>
        </div>
        <div class="menus">
            <ul id="menus">
                <li data-menuanchor="home" class="active"><a href="#home">{{__("首页")}}</a></li>
                <li><a href="#">{{__("关于臻逸")}}</a>
                    <ul>
                        <li data-menuanchor="aboutcitta1"><a href="#aboutcitta1">{{__("品牌概念")}}</a></li>
                        <li data-menuanchor="aboutcitta2"><a href="#aboutcitta2">{{__("品牌创建")}}</a></li>
                    </ul>
                </li>
                <li><a href="#">{{__("关于嘉华")}}</a>
                    <ul>
                        <li data-menuanchor="aboutkwah1"><a href="#aboutkwah1">{{__("核心价值")}}</a></li>
                        <li data-menuanchor="aboutkwah2"><a href="#aboutkwah2">{{__("品牌愿景")}}</a></li>
                        <li data-menuanchor="aboutkwah3"><a href="#aboutkwah3">{{__("品牌定位")}}</a></li>
                        <li data-menuanchor="aboutkwah4"><a href="#aboutkwah4">{{__("物业服务")}}</a></li>
                        <li data-menuanchor="aboutkwah5"><a href="#aboutkwah5">{{__("关于我们")}}</a></li>
                    </ul>
                </li>
                <li data-menuanchor="contactus"><a href="#contactus">{{__("联系我们")}}</a></li>
            </ul>
        </div>
        <div class="footer">
            <a href="" download=""><img src="{{asset('images/icon-download.png')}}" alt="download" /></a>
        </div>
    </div>
    <div id="menuWrapper" class="hidden"></div>
    <div class="arrowBottom">
        <img src="{{asset('images/icon-arrow-down.png')}}" alt="next" />
    </div>
    <script>
        window.oncontextmenu = function(e) {
            e.preventDefault();
        }
        function resizePage() {
            const height = $(".fp-tableCell").height();
            const width = $(".fp-tableCell").width();
            let left = 0;
            let width1 = 0;
            if (width / height > 1920 / 1080) {
                width1 = height * (1920 / 1080);
                left = ($("#container").width() - width1) / 2;
                // $(".page").width(height * (1920 / 1080));
            } else {
                width1 = width;
                left = 0;
            }
            $("#header").css({
                left: left + "px"
            });
            $("#header").width(width1);
            $("#menuWrapper").width(width1);
            $("#menuWrapper").css({
                left: left + "px"
            });
            $("#menu").css({
                right: left + "px"
            });
            $(".fp-controlArrow.fp-next").css({
                right: (left + 140) + "px"
            });
            $(".fp-controlArrow.fp-prev").css({
                left: (left + 140) + "px"
            });
            $(".arrowBottom").css({
                left: (left + 140) + "px"
            });
        }
        $().ready(function() {
            resizePage();
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

        new fullpage('#container', {
            //options here
            autoScrolling: true
            , scrollHorizontally: true
                // , anchors: ['home', 'aboutcitta', 'aboutkwah', 'projects', 'contactus']
            , menu: "#menus"
            , navigation: false
            , navigationPosition: 'right'
                // , navigationTooltips: ['firstSlide', 'secondSlide']
            , showActiveTooltip: false
            , slidesNavigation: true
            , slidesNavPosition: 'bottom'
            , afterResize: function(width, height) {
                resizePage();
            },
            //Scrolling
            css3: true
        , });
        //methods
        // fullpage_api.setAllowScrolling(false);

    </script>
</body>

</html>
