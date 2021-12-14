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
    <div id="container" class="{{app()->getLocale()}}">
        <div class="fullwidth projects">
            <img class="xs-hidden" src="{{asset("images/projects/header-01.png")}}" alt="" />
            <img class="md-hidden" src="{{asset("images/projects/mobile/header-01.png")}}" alt="" />
            <div class="descr">
                <img src="{{asset("images/projects/".app()->getLocale()."/slogan.png")}}" alt="" />
            </div>
            <div class="reserve"><a href="http://booking.stanfordresidences.com/" target="_blank">{!!__("预定")!!}</a></div>
        </div>
        <div class="fullwidth projects-row xs-hidden" style="margin-top: 60px;margin-bottom:60px;">
            <div style="padding:0 100px 0 300px;"><img alt="" src="{{asset("images/projects/1.png")}}" /></div>
            <div style="padding: 0 100px 0 0;"><img alt="{{__('秉持“臻品尚居，逸安于斯”的经营理念，臻逸恒丰从住户身心深层的需求出发，提供安全、舒适、便利的智慧化生活空间，将绿色环保的生态注入时尚设计，多种户型满足不同居住需求。更有内容丰富的共享社交活动，集结志趣相投的伙伴，带来空间品质的提升和更为开放的生活方式体验。')}}" src="{{asset("images/projects/".app()->getLocale()."/2.png")}}" /></div>
        </div>
        <div class="fullwidth projects md-hidden">
            <div style="width:70%;margin:40px auto 0;"><img alt="" src="{{asset("images/projects/1.png")}}" /></div>
            <div style="width:80%;margin:10px 10% 40px;">{{__('秉持“臻品尚居，逸安于斯”的经营理念，臻逸恒丰从住户身心深层的需求出发，提供安全、舒适、便利的智慧化生活空间，将绿色环保的生态注入时尚设计，多种户型满足不同居住需求。更有内容丰富的共享社交活动，集结志趣相投的伙伴，带来空间品质的提升和更为开放的生活方式体验。')}}</div>
        </div>
        <div class="fullwidth projects">
            <img class="xs-hidden" src="{{asset("images/projects/header-02.png")}}" alt="" />
            <img class="md-hidden" src="{{asset("images/projects/mobile/header-02.png")}}" alt="" />
            <div class="descr xs-hidden" style="bottom: 100px;left:10vw;width:40vw;">
                <img class="xs-hidden" src="{{asset("images/projects/".app()->getLocale()."/3.png")}}" alt="" />
                <img class="md-hidden" src="{{asset("images/projects/".app()->getLocale()."/mobile/3.png")}}" alt="" />
            </div>
            <div class="header-02-descr md-hidden">
                <h1>{!! __('卓效通达，出行体验尽从容') !!}</h1>
                <p>{{__('项目位于上海市静安区恒丰路18号，地处新静安区新客站不夜城商圈，毗邻凯德星贸中心，临近苏州河与上海火车站，更有地铁1、12、13号交汇于此，城域和国内外交通皆可便捷畅达。以更为卓效的城际生活方式，方便每一次出行。')}}</p>
            </div>
        </div>
        <div class="fullwidth projects-row xs-hidden" style="margin-top: 30px;margin-bottom:30px;">
            <div style="padding:0 40px 0 0;"><img alt="" src="{{asset("images/projects/map.png")}}" /></div>
            <div style="padding: 0 100px 0 40px;"><img alt="" src="{{asset("images/projects/".app()->getLocale()."/4.png")}}" /></div>
        </div>
        <div class="fullwidth projects md-hidden">
            <div><img alt="" src="{{asset("images/projects/map.png")}}" /></div>
            <div class="projects-row">
                <div class="projects-map-descr">
                    <h1>{{__('交通')}}：</h1>
                    <h2>{{__('北横通道')}}</h2>
                    <h2>{{__('南北高架')}}</h2>
                    <h2>{{__('上海火车站')}}</h2>
                    <h2>{{__('上海长途客运总站')}}</h2>
                    <h2>{{__('地铁：汉中路、上海站、新闸路、自然博物馆、曲阜路')}}</h2>
                    <h1>{{__('公园')}}：</h1>
                    <h2>{{__('蝴蝶湾绿地')}}</h2>
                    <h2>{{__('静安雕塑公园')}}</h2>
                    <h2>{{__('九子公园')}}</h2>
                </div>
                <div class="projects-map-descr">
                    <h1>{{__('生活配套')}}:</h1>
                    <h2>{{__('蝴蝶湾市民篮球场')}}</h2>
                    <h2>{{__('蝴蝶湾公共运动场')}}</h2>
                    <h2>{{__('静安少年图书馆')}}</h2>
                    <h2>{{__('静安区运动中心')}}</h2>
                    <h2>{{__('江宁路街道社区卫生服务中心')}}</h2>
                    <h2>{{__('上海市北站医院')}}</h2>
                    <h2>{{__('大悦城')}}</h2>
                    <h2>{{__('盈凯文创广场')}}</h2>
                    <h2>{{__('UCCA尤伦斯美术馆')}}</h2>
                    <h2>{{__('太阳City广场')}}</h2>
                    <h2>{{__('嘉里不夜城')}}</h2>
                    <h2>{{__('静安国际中心')}}</h2>
                    <h2>{{__('泰禾大厦')}}</h2>
                    <h2>{{__('凯德星贸大厦')}}</h2>
                    <h2>{{__('星巴克')}}</h2>
                    <h2>{{__('屈臣氏')}}</h2>
                </div>
            </div>
        </div>
        <div class="fullwidth projects-row xs-hidden" style="margin-top: 0;margin-bottom:30px;">
            <div style="padding:0 20px 0 100px;display:flex;align-items:center;">
                <div style="max-width:400px"><img alt="" src="{{asset("images/projects/".app()->getLocale()."/5.png")}}" /></div>
            </div>
            <div style="width:65vw;"><img alt="" src="{{asset("images/projects/header-04.png")}}" /></div>
        </div>
        <div class="fullwidth projects md-hidden">
            <div><img alt="" src="{{asset("images/projects/mobile/header-04.png")}}" /></div>
            <div class="projects-descr">
                <h1>{{__('迭新活力，筑尚设计显风范')}}</h1>
                <p>{{__('在极具设计感的社区式居住空间里，从整体建筑风格到家居细节，每一处都融合了时代潮流与实用功能的氛围营造，让自由及个性化的年轻活力得到释放，在提供便利生活服务的同时，为住户打造开放共享的筑尚空间。在大城市的喧嚣中放松身心，注入新能量。')}}</p>
            </div>
        </div>

        <div class="fullwidth projects-row xs-hidden" style="margin-top: 30px;margin-bottom:30px;">
            <div style="width:65vw;"><img alt="" src="{{asset("images/projects/header-05.png")}}" /></div>
            <div style="padding: 0 100px 0 40px;display:flex;align-items:center;">
                <div style="max-width:400px"><img alt="" src="{{asset("images/projects/".app()->getLocale()."/6.png")}}" /></div>
            </div>
        </div>

        <div class="fullwidth projects md-hidden">
            <div><img alt="" src="{{asset("images/projects/mobile/header-05.png")}}" /></div>
            <div class="projects-descr">
                <h1>{{__('匠心营造，品智宜居新高度')}}</h1>
                <p>{{__('以家居及设计的场景化着力，创享真正安全、舒适、便利的智慧化生活空间，实现对宜居智慧社区的全新定义。臻逸恒丰将便捷融于日常生活中，打造多样的理想生活方式。让居住更简单，体验更美好。')}}</p>
            </div>
        </div>

        <div class="fullwidth projects-row xs-hidden" style="margin-top: 0;margin-bottom:30px;">
            <div style="padding:0 20px 0 80px;display:flex;align-items:center;">
                <div style="max-width:400px"><img alt="" src="{{asset("images/projects/".app()->getLocale()."/7.png")}}" /></div>
            </div>
            <div style="width:65vw;"><img alt="" src="{{asset("images/projects/header-06.png")}}" /></div>
        </div>

        <div class="fullwidth projects md-hidden">
            <div><img alt="" src="{{asset("images/projects/mobile/header-06.png")}}" /></div>
            <div class="projects-descr">
                <h1>{{__('质尚逸居，臻美生活称心选')}}</h1>
                <p>{{__('臻逸恒丰共有136间房间及多样租赁模式选择，适合住户的不同生活场景需求。')}}</p>
                <p>{{__('我们倡导更健康和积极的质尚生活方式，致力于盈领开放美好的城市社交场域和生活品质空间。在这里，我们更为看重住户的居住环境营造，采用自然环保的建造物料，结合绿植点缀出简约、生动的生活氛围，舒适宜居却不失现代美感。')}}</p>
            </div>
        </div>
        <div class="fullwidth projects xs-hidden">
            <img src="{{asset("images/projects/header-07.png")}}" alt="" />
            <div class="descr" style="bottom:100px;right:10vw;width:40vw;">
                <img src="{{asset("images/projects/".app()->getLocale()."/8.png")}}" alt="" />
            </div>
        </div>

        <div class="fullwidth projects md-hidden">
            <div><img alt="" src="{{asset("images/projects/mobile/header-07.png")}}" /></div>
            <div class="projects-descr">
                <h1>{!!__('丰盛配套，荟悦新都市生活')!!}</h1>
                <p>{{__('臻逸恒丰致力于为住户创造舒悦身心体验的共享生活与社交空间，在喧闹城市之中营造出一片舒适的休憩处所，找回工作与生活的平衡。在这里，不仅是空间功能的汇聚, 更是生活方式被无限放大的可能。定制化服务、健身中心、水吧、咖啡阅览休息区、会议室、洗衣房等共享配套一应俱全，聚会、运动、文化交流的丰盛体验乐得其所。')}}</p>
            </div>
        </div>
        <div class="md-hidden" style="margin: 10px 40px">
            <div class="fullwidth projects">
                <div><img alt="" src="{{asset("images/projects/mobile/header-08.png")}}" /></div>
                <div class="projects-descr" style="margin: 20px 0;">
                    <h1>{{__('贴心物业，全方位臻享服务')}}</h1>
                    <p>{{__('凭借30多年丰富的酒店运营经验和丰富物业管理经验，传承国际精品酒店管理模式，将高档社区的舒适居住体验与细腻的酒店式物业服务相结合，为住户提供优越臻享的物业管家服务，令每一位住户均能享受私密安心、体贴舒适的优质居住体验，礼遇美好生活。')}}</p>
                </div>
            </div>
            <div class="fullwidth projects projects-service">
                <h1>{{__("服务项目")}}</h1>
                <div class="fullwidth projects-row">
                    <div>
                        <ul>
                            <li>{{__('24小时前台接待')}}</li>
                            <li>{{__('24小时保安及闭路监控系统')}}</li>
                            <li>{{__('礼宾服务')}}</li>
                            <li>{{__('住客迎新礼')}}</li>
                            <li>{{__('邮件包裹及讯息送递服务')}}</li>
                            <li>{{__('客户咨询服务')}}</li>
                            <li>{{__('快递服务')}}</li>
                            <li>{{__('紧急医疗')}}</li>
                            <li>{{__('花卉代订服务')}}</li>
                        </ul>
                    </div>
                    <div>
                        <ul>
                            <li>{{__('安排洗衣/干洗')}}</li>
                            <li>{{__('主题概念活动')}}</li>
                            <li>{{__('叫醒服务')}}</li>
                            <li>{{__('出租车代订服务')}}</li>
                            <li>{{__('代订阅报纸/杂志')}}</li>
                            <li>{{__('租户休闲区')}}</li>
                            <li>{{__('小型紧急维修服务')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="fullwidth news" style="margin-top: 30px;margin-bottom:230px;height:300px;">
                <div class="title">{{__('最新资讯')}}</div>
                <div class="content">
                    <ul>
                        <li></li>
                    </ul>
                </div>
                <div style="left:-40px;right:-40px;top:200px;position:absolute;z-index:-1">
                    <img class="image" src="{{asset('/images/projects/header-09.png')}}" alt="" />
                </div>
             </div>
        </div>
        <div style="margin: 100px 200px;" class="xs-hidden">
            <div class="fullwidth projects">
                <img src="{{asset("images/projects/header-08.png")}}" alt="" />
                <div class="descr" style="bottom:30%;right:30px;width:30vw;left:initial;">
                    {{-- <img src="{{asset("images/projects/".app()->getLocale()."/9.png")}}" alt="" /> --}}
                    <h1>{{__('贴心物业，全方位臻享服务')}}</h1>
                    <p>{{__('凭借30多年丰富的酒店运营经验和丰富物业管理经验，传承国际精品酒店管理模式，将高档社区的舒适居住体验与细腻的酒店式物业服务相结合，为住户提供优越臻享的物业管家服务，令每一位住户均能享受私密安心、体贴舒适的优质居住体验，礼遇美好生活。')}}</p>
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
            <p>{{__('租赁热线：（86-21）6317 7888')}}</p>
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
    @include('components.menu',['page'=>'hengfeng'])
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
