<div id="menu" class="hidden">
    <div class="header">
        <div class="languages">
            @foreach(config('app.languages') as $key => $value)
            @if(isset($page) && $page === 'hengfeng')
            <a href="/hengfeng/?lang={{$key}}" {{App::currentLocale() === $key?'class=active':''}}>{{$value}}</a>
            @else
            <a href="/?lang={{$key}}" {{App::currentLocale() === $key?'class=active':''}}>{{$value}}</a>
            @endif
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
            <li data-menuanchor=""  @class(['active'=>isset($page) && $page === 'hengfeng'])><a href="javascript:void(0);">{{__("精彩项目")}}</a>
                <ul>
                    <li data-menuanchor=""><a href="{{ url('/hengfeng/?lang='.App::currentLocale()) }}">{{__("臻逸恒丰服务式公寓")}}</a></li>
                </ul>
            </li>
            <li data-menuanchor="aboutkwah1"><a href="{{ url('/?lang='.App::currentLocale()) }}#aboutkwah1">{{__("核心价值")}}</a></li>
            <li data-menuanchor="contactus"><a href="{{ url('/?lang='.App::currentLocale()) }}#contactus">{{__("联系我们")}}</a></li>
        </ul>
    </div>
    <div class="footer">
        <a href="{{asset('/citta.pdf')}}" download="{{asset('/citta.pdf')}}"><img src="{{asset('images/'.app()->currentLocale().'/icon-download.png')}}" alt="download" /></a>
    </div>
</div>
