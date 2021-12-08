<div id="menu" class="hidden">
    <div class="header">
        <div class="languages">
            @foreach(config('app.languages') as $key => $value)
            <a href="/?lang={{$key}}" {{App::currentLocale() === $key?'class=active':''}}>{{$value}}</a>
            @endforeach
        </div>
        <div class="close">
            <img src="{{asset('images/icon-close.png')}}" alt="close" />
        </div>
    </div>
    <div class="menus">
        <ul id="menus" class="{{App::currentLocale()}}">
            <li data-menuanchor="home"><a href="{{ url('/?lang='.App::currentLocale()) }}#home">{{__("首页")}}</a></li>
            <li data-menuanchor="aboutcitta1"><a href="{{ url('/?lang='.App::currentLocale()) }}#aboutcitta1">{{__("关于臻逸")}}</a></li>
            <li data-menuanchor="" {{isset($page) && $page === 'projects'?' class=active':''}}><a href="javascript:;">{{__("精彩项目")}}</a>
                <ul>
                    <li data-menuanchor=""><a href="{{ url('/projects/?lang='.App::currentLocale()) }}#projects">{{__("臻逸恒丰服务式公寓")}}</a></li>
                </ul>
            </li>
            <li data-menuanchor="contactus"><a href="{{ url('/?lang='.App::currentLocale()) }}#contactus">{{__("联系我们")}}</a></li>
            <li data-menuanchor="aboutkwah5"><a href="{{ url('/?lang='.App::currentLocale()) }}#aboutkwah5">{{__("关于嘉华")}}</a></li>
        </ul>
    </div>
    <div class="footer">
        <a href="{{asset('/citta.pdf')}}" download="{{asset('/citta.pdf')}}"><img src="{{asset('images/'.app()->currentLocale().'/icon-download.png')}}" alt="download" /></a>
    </div>
</div>
