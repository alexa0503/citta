<!-- 加载编辑器的容器 -->
<div class="form-group row">
    <label class="col-12 col-sm-2 col-form-label text-sm-right">{{ __($label_name) }}</label>
    <div class="col-12 col-sm-10">
        <script id="container" name="{{$form_name}}" type="text/plain">{!! isset($value)?$value:'' !!}</script>
        <div class="invalid-feedback" id="{{$form_name}}-feedback"></div>
    </div>
</div>

@section('plugin-css')
<link rel="stylesheet" href="{{ asset('ueditor/third-party/xiumi/xiumi-ue-v5.css') }}">
@append
<!-- 配置文件 -->
@section('scripts')
<script type="text/javascript" src="{{asset('ueditor/ueditor.config.js')}}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{asset('ueditor/ueditor.all.js')}}"></script>
<script type="text/javascript" src="{{asset('ueditor/third-party/xiumi/xiumi-ue-dialog-v5.js')}}"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>
@append
