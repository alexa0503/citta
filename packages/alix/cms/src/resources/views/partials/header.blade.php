<div class="row mai-datatable-header">
    <div class="col-sm-4">
        <div class="dataTables_length"><label>{{ __('显示') }} <select name="page-select" id="page-select"
                    class="form-control form-control-sm">
                    @foreach ([10,25,50,100] as $v)
                    <option
                        data-url="{{ route(Request::route()->getName(),array_merge(['perPage'=>$v],request()->except(['page','_token','perPage']))) }}"
                        value="{{ $v }}">{{ $v }}</option>
                    @endforeach
                </select> {{ __('项') }}</label></div>
    </div>
    <div class="col-sm-8">
        <div class="dataTables_filter">
            <form class="form-inline" id="form-search"
                action="{{ route(Request::route()->getName()) }}" style="justify-content:flex-end;">
                <div class="form-group ">
                    <input name="keywords" class="form-control" value="{{Request::input('keywords')}}"
                        placeholder="输入关键词" />
                </div>
                <div class="form-group ">
                    <button type="submit" class="btn btn-space btn-primary ml-2">确认</button>
                    {{-- <a class="btn btn-space btn-secondary btn-export ml-2" href="#">导出CSV</a> --}}
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
<script>
 $(".btn-export").on("click",function(){
    let url = $("#form-search").attr('action') + '?' + $("#form-search").serialize();
    window.location.href=url+'&export=1';
    // console.log(url);
});
$("select[name=state]").val("{{Request::input('state')}}");
$("select[name=platform]").val("{{Request::input('platform')}}");
</script>
@append
