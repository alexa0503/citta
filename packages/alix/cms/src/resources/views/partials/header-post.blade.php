<div class="row mai-datatable-header">
    <div class="col-sm-4">
        <div class="dataTables_length">
            <label>{{ __('显示') }}
                <select name="page-select" id="page-select"
                    class="form-control form-control-sm">
                    @foreach ([10,25,50,100] as $v)
                    <option
                        data-url="{{ route(Route::currentRouteName(),array_merge(Route::current()->parameters,['perPage'=>$v],request()->except(['page','_token','perPage']))) }}"
                        value="{{ $v }}">{{ $v }}</option>
                    @endforeach
                </select> {{ __('项') }}
            </label>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="dataTables_filter">
            <form class="form-inline" id="form-search"
                action="{{ route(Route::currentRouteName(),Route::current()->parameters) }}"
                style="justify-content:flex-end;">
                <div class="form-group ">
                    <input name="keywords" class="form-control" value="{{Request::input('keywords')}}"
                        placeholder="输入关键词" />
                </div>
                <div class="form-group ">
                    <select name="city_id" class="form-control">
                        <option value="">所有</option>
                        @foreach(App\City::all() as $city)
                        <option value="{{$city->id}}" {{$city->id == Request::input('city_id')?'selected':''}}>{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group ">
                    <select name="hidden" class="form-control">
                        <option value="">所有状态/所有</option>
                        <option value="1" {{Request::input('hidden') === '1'?'selected':''}}>隐藏信息</option>
                        <option value="0" {{Request::input('hidden') === '0'?'selected':''}}>正常信息</option>
                    </select>
                </div>
                <div class="form-group ">
                    <button type="submit" class="btn btn-space btn-primary ml-2">确认</button>
                    {{-- <a class="btn btn-space btn-secondary btn-export ml-2" href="#">导出CSV</a> --}}
                </div>
            </form>
        </div>
    </div>
    <div class="col-12">
        <a class="btn btn-space btn-primary " href="{{ route(Str::replaceLast('index','create',Route::currentRouteName()),Route::current()->parameters) }}">新建文章</a>
    </div>
</div>
@section('scripts')
<script>
    $(".btn-export").on("click",function(){
    let url = $("#form-search").attr('action') + '?' + $("#form-search").serialize();
    window.location.href=url+'&export=1';
    // console.log(url);
});
</script>
@append
