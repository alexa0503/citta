<div class="form-group row">
    <label class="col-12 col-sm-2 col-form-label text-sm-right">{!! $label_name !!}</label>
    <div class="col-12 col-sm-10">
        @if(isset($multiple_locales) && $multiple_locales )
            <div class="">
                <div class="{{ 'btn-languages-'.$form_name }} btn-group btn-group-justified btn-space" role="group">
                    @foreach(config('languages') as $key=>$languages)
                    <a data-id="row-{{$form_name.'_'.$key}}" class="btn {{$key == 'zh-CN' ? 'btn-primary' : 'btn-dark'}}"
                        href="javascript:;">{{$languages}}</a>
                    @endforeach
                </div>
            </div>
            @foreach(config('languages') as $key=>$languages)
            <div id="row-{{$form_name.'_'.$key}}" class="row-{{ $form_name }}" {{ $key != 'zh-CN' ? 'style=display:none; ':'' }}>
                <textarea rows="10" class="form-control" placeholder="{{ __('Please Input').' '.__($label_name) }}" name="{{$form_name}}[{{$key}}]" id="{{ $form_name.'_'.$key }}">{{ $value[$key] ?? ($value[strtolower($key)] ?? '') }}</textarea>
                <div class="invalid-feedback" id="{{$form_name}}-feedback"></div>
            </div>
            @endforeach
        @else
        <textarea rows="10" required="" class="form-control" id="{{ $form_name }}" name="{{ $form_name }}" placeholder="{{ __('Please Input').' '.__($label_name) }}" autocomplete="off">{!! isset($value)?$value:'' !!}</textarea>
        @endif

        <div class="invalid-feedback" id="{{ $form_name }}-feedback"></div>
    </div>
</div>

@section('scripts')
<script>
    $(".{{ 'btn-languages-'.$form_name }} a").click(function() {
        var d = $(this).data('id');
        $(".{{ 'btn-languages-'.$form_name }} a").removeClass("btn-primary").addClass("btn-dark");
        $(this).removeClass("btn-dark").addClass("btn-primary");
        $(".row-{{ $form_name }}").hide();
        $("#" + d).show();
    });
</script>
@append
