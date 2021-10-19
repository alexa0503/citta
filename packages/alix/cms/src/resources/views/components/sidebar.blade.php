<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cms.dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">面板</span>
            </a>
        </li>
        @foreach($menus as $menu)
            <li class="nav-item {{ $current_route==$menu['route_name']?'active':'' }}">
                @if($menu['has_children'])
                    <a class="nav-link {{ $current_route==$menu['route_name']?'show':'' }}" data-toggle="collapse" href="#{{ $menu['id'] }}" aria-expanded="false" aria-controls="{{ $menu['id'] }}">
                        <i class="mdi mdi-{{ $menu['icon']??'emoticon' }} menu-icon"></i>
                        <span class="menu-title">{{ $menu['title'] }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse {{ $current_route==$menu['route_name']?'show':'' }}" id="{{ $menu['id'] }}">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link {{ preg_match('/\.(index)$/',Route::currentRouteName()) && $current_route==$menu['route_name'] ?'active':'' }}" href="{{ route($menu['route_name'].'.index') }}">查看・一览</a></li>
                            <li class="nav-item"> <a class="nav-link  {{ preg_match('/\.create$/',Route::currentRouteName()) && $current_route==$menu['route_name'] ?'active':'' }}" href="{{ route($menu['route_name'].'.create') }}">新建</a></li>
                        </ul>
                    </div>
                @else
                    <a class="nav-link" href="{{ route($menu['route_name'].'.index') }}">
                        <i class="mdi mdi-{{ $menu['icon']??'emoticon' }} menu-icon"></i>
                        <span class="menu-title">{{ $menu['title'] }}</span>
                    </a>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
<!-- partial -->
