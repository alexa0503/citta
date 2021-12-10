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
    <script src="{{mix('js/app.js')}}"></script>
</head>

<body>
    <div id="container">
        <div class="fullwidth projects">
            <img src="{{asset("images/projects/header-01.png")}}" alt="" />
            <div class="descr" style="left: 100px;top: 40%;width:30vw;">
                <img src="{{asset("images/projects/".app()->getLocale()."/slogan.png")}}" alt="" />
            </div>
            <div class="reserve"><a href="http://booking.stanfordresidences.com/" target="_blank"><img src="{{asset('images/projects/icon-reserve.png')}}" alt="" /></a></div>
        </div>
        <div class="fullwidth projects-row" style="margin-top: 60px;margin-bottom:60px;">
            <div style="padding:0 100px 0 300px;"><img alt="" src="{{asset("images/projects/1.png")}}" /></div>
            <div style="padding: 0 100px 0 0;"><img alt="" src="{{asset("images/projects/".app()->getLocale()."/2.png")}}" /></div>
        </div>
        <div class="fullwidth projects">
            <img src="{{asset("images/projects/header-02.png")}}" alt="" />
            <div class="descr" style="bottom: 100px;left:10vw;width:40vw;">
                <img src="{{asset("images/projects/".app()->getLocale()."/3.png")}}" alt="" />
            </div>
        </div>
        <div class="fullwidth projects-row" style="margin-top: 30px;margin-bottom:30px;">
            <div style="padding:0 40px 0 0;"><img alt="" src="{{asset("images/projects/map.png")}}" /></div>
            <div style="padding: 0 100px 0 40px;"><img alt="" src="{{asset("images/projects/".app()->getLocale()."/4.png")}}" /></div>
        </div>
        <div class="fullwidth projects-row" style="margin-top: 0;margin-bottom:30px;">
            <div style="padding:0 20px 0 100px;display:flex;align-items:center;">
                <div style="max-width:400px"><img alt="" src="{{asset("images/projects/".app()->getLocale()."/5.png")}}" /></div>
            </div>
            <div style="width:65vw;"><img alt="" src="{{asset("images/projects/header-04.png")}}" /></div>
        </div>

        <div class="fullwidth projects-row" style="margin-top: 30px;margin-bottom:30px;">
            <div style="width:65vw;"><img alt="" src="{{asset("images/projects/header-05.png")}}" /></div>
            <div style="padding: 0 100px 0 40px;display:flex;align-items:center;">
                <div style="max-width:400px"><img alt="" src="{{asset("images/projects/".app()->getLocale()."/6.png")}}" /></div>
            </div>
        </div>

        <div class="fullwidth projects-row" style="margin-top: 0;margin-bottom:30px;">
            <div style="padding:0 20px 0 80px;display:flex;align-items:center;">
                <div style="max-width:400px"><img alt="" src="{{asset("images/projects/".app()->getLocale()."/7.png")}}" /></div>
            </div>
            <div style="width:65vw;"><img alt="" src="{{asset("images/projects/header-06.png")}}" /></div>
        </div>
        <div class="fullwidth projects">
            <img src="{{asset("images/projects/header-07.png")}}" alt="" />
            <div class="descr" style="bottom:100px;right:10vw;width:40vw;">
                <img src="{{asset("images/projects/".app()->getLocale()."/8.png")}}" alt="" />
            </div>
        </div>
        <div style="margin: 100px 200px;">
            <div class="fullwidth projects">
                <img src="{{asset("images/projects/header-08.png")}}" alt="" />
                <div class="descr" style="bottom:30%;right:10px;width:30vw;">
                    <img src="{{asset("images/projects/".app()->getLocale()."/9.png")}}" alt="" />
                </div>
            </div>
            <div style="width: 60%;margin:20px 20% 0;">
                <img class="image" alt="" src="{{asset("images/projects/".app()->getLocale()."/10.png")}}" />
            </div>
            <div class="fullwidth news" style="margin-top: 130px;margin-bottom:30px;height:300px;">
               <div class="title">{{__('最新资讯')}}</div>
               <div class="content">
                   <ul>
                       <li></li>
                   </ul>
               </div>
               <div style="width:30vw;right:0;top:0;position:absolute;z-index:-1">
                   <img class="image" src="{{asset('/images/projects/header-09.png')}}" alt="" />
               </div>
            </div>
        </div>
        <div class="footer">
            <p>{{__('上海市静安区恒丰路18号 邮编：200070')}}</p>
            <p>{{__('租赁热线：（86-21）6317 6888')}}</p>
            <p>info@cittaresidences.com</p>
        </div>
        <div class="footer-more">{{__('更多房源信息请点击右侧预订页面')}}</div>
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
    <div id="footer"><a href="https://beian.miit.gov.cn/" target="_blank">{{$record_number}}</a></div>
    <script>
        @if(env('APP_ENV') === 'production')
        window.oncontextmenu = function(e) {
            e.preventDefault();
        }
        @endif

        function resizePage() {}
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
            });
        });

    </script>
</body>

</html>
