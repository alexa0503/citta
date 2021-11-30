<div id="menu" class="hidden">
    <div class="header">
        <div class="languages">
            @foreach(config('app.languages') as $key => $value)
            <a href="{{url()->current()}}?lang={{$key}}" {{App::currentLocale() === $key?'class=active':''}}>{{$value}}</a>
            @endforeach
        </div>
        <div class="close">
            <img src="{{asset('images/icon-close.png')}}" alt="close" />
        </div>
    </div>
    <div class="menus">
        <ul id="menus">
            <li data-menuanchor="home"><a href="{{ url('/?lang='.App::currentLocale()) }}#home">{{__("首页")}}</a></li>
            <li data-menuanchor="aboutcitta1"><a href="{{ url('/?lang='.App::currentLocale()) }}#aboutcitta1">{{__("关于臻逸")}}</a></li>
            <li data-menuanchor="projects" {{isset($page) && $page === 'projects'?' class="active"':''}}><a href="{{ url('/prjects?lang='.App::currentLocale()) }}">{{__("精彩项目")}}</a>
                @if(isset($page) && $page === 'projects')
                <ul>
                    <li data-menuanchor=""><a href="#">{{__("臻逸恒丰精选式公寓")}}</a></li>
                </ul>
                @endif
            </li>
            <li data-menuanchor="contactus"><a href="{{ url('/?lang='.App::currentLocale()) }}#contactus">{{__("联系我们")}}</a></li>
            <li data-menuanchor="aboutkwah5"><a href="{{ url('/?lang='.App::currentLocale()) }}#aboutkwah5">{{__("关于嘉华")}}</a></li>
        </ul>
    </div>
    <div class="footer">
        <a href="{{asset('/citta.pdf')}}" download="{{asset('/citta.pdf')}}"><img src="{{asset('images/'.app()->currentLocale().'/icon-download.png')}}" alt="download" /></a>
    </div>
</div>