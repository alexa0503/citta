@php
$hash = str_replace('.','_',$route_name);
$current =  preg_replace('/\.(create|index|edit)$/','',Route::currentRouteName());
@endphp
<li class="nav-item {{ $current==$route_name?'active':'' }}">
    @if(!isset($has_children) || $has_children)
    <a class="nav-link {{ $current==$route_name?'show':'' }}" data-toggle="collapse" href="#{{$hash}}" aria-expanded="false" aria-controls="{{$hash}}">
        <i class="mdi mdi-{{isset($icon)&&$icon?$icon:'emoticon'}} menu-icon"></i>
        <span class="menu-title">{{$title}}</span>
        <i class="menu-arrow"></i>
    </a>
    @else
    <a class="nav-link" href="{{route($route_name.'.index')}}">
        <i class="mdi mdi-{{isset($icon)&&$icon?$icon:'emoticon'}} menu-icon"></i>
        <span class="menu-title">{{$title}}</span>
    </a>
    @endif
    @if(!isset($has_children) || $has_children)
    <div class="collapse {{ $current==$route_name?'show':'' }}" id="{{$hash}}">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ preg_match('/\.(index)$/',Route::currentRouteName()) && $current==$route_name?'active':'' }}" href="{{route($route_name.'.index')}}">查看・一览</a></li>
            <li class="nav-item"> <a class="nav-link  {{ preg_match('/\.create$/',Route::currentRouteName()) && $current==$route_name?'active':'' }}" href="{{route($route_name.'.create')}}">新建</a></li>
        </ul>
    </div>
    @endif
</li>
