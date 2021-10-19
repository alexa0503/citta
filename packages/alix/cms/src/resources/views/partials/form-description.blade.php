@php
$form_name = !isset($form_name) ? 'descr' : $form_name;
$label_name = $label_name ?? 'body';
@endphp
<div class="form-group row">
    <label class="col-12 col-sm-2 col-form-label text-sm-right">{{ __($label_name) }}</label>
    <div class="col-12 col-sm-10">
        <div class="row">
            <div class="col-12">
                <div class="{{ 'btn-languages-'.$form_name }} btn-group btn-group-justified btn-space" role="group">
                    @foreach(config('languages') as $key=>$languages)
                    <a data-id="row-{{$form_name.'_'.$key}}" class="btn {{$key == 'zh-CN' ? 'btn-primary' : 'btn-dark'}}"
                        href="javascript:;">{{$languages}}</a>
                    @endforeach
                </div>
            </div>
            @foreach(config('languages') as $key=>$languages)
            <div id="row-{{$form_name.'_'.$key}}" class="row-{{ $form_name }} col-12" {{ $key != 'zh-CN' ? 'style=display:none; ':'' }}>
                <textarea class="form-control" name="{{$form_name}}[{{$key}}]" id="{{ $form_name.'_'.$key }}">{{ $value[$key] ?? ($value[strtolower($key)] ?? '') }}</textarea>
                <div class="invalid-feedback" id="{{$form_name}}-feedback"></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@section('scripts')
<script>
    @foreach(config('languages') as $key=>$languages)
    ClassicEditor
        .create(document.querySelector('#{{ $form_name."_".$key }}'), ckeditor_option)
        .then(editor => {
            //console.log( 'Editor was initialized', editor );
        })
        .catch(error => {
            console.error(error.stack);
        });
    @endforeach
    $(".{{ 'btn-languages-'.$form_name }} a").click(function() {
        var d = $(this).data('id');
        $(".{{ 'btn-languages-'.$form_name }} a").removeClass("btn-primary").addClass("btn-dark");
        $(this).removeClass("btn-dark").addClass("btn-primary");
        $(".row-{{ $form_name }}").hide();
        $("#" + d).show();
    });
</script>
@append
