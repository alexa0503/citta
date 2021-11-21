@php
$selected = isset($selected)?$selected:"";
$row_class = isset($row_class)?$row_class:"";
$has_index = isset($has_index)&&$has_index?true:false;
@endphp
<div class="form-group row {{$row_class}}">
    <label class="col-12 col-sm-2 col-form-label text-sm-right">{{ __($label_name) }}</label>
    <div class="col-12 col-sm-10">
        <div class="mt-2">
            <select style="width:100%" {{ (isset($multiple) && $multiple) ? 'multiple':'' }} class="form-control select2" name="{{ $form_name }}" id="{{ str_replace('[]','',$form_name) }}">
                @foreach ($options as $k=> $v)
                @if(isset($v->id))
                <option value="{{ $v->id }}" {{ $selected && in_array($v->id,$selected) ? 'selected=selected':'' }}>
                    {{ $v->name }}
                </option>
                @else
                @if(!$has_index)
                <option value="{{ $v }}" {{ $v == $selected || (is_array($selected) && in_array($v,$selected)) ? 'selected=selected':'' }}>{{ $v }}</option>
                @else
                <option value="{{ $k }}" {{ $k == $selected  || (is_array($selected) && in_array($k,$selected)) ? 'selected=selected':'' }}>{{ $v }}</option>
                @endif
                @endif
                @endforeach
            </select>
        </div>
        <div class="invalid-feedback" id="{{ str_replace('[]','',$form_name) }}-feedback"></div>
    </div>
</div>
@section('plugin-css')
<link rel="stylesheet" href="{{ asset('vendor/cms/select2/css/select2.min.css') }}">
@append
@section('plugin-js')
<script type="text/javascript" src="{{ asset('vendor/cms/select2/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/cms/select2/js/i18n/zh-CN.js') }}"></script>
@append
@section('scripts')
<script>
    $(document).ready(function() {
        $("#{{ str_replace('[]','',$form_name) }}").select2({
            "placeholder":"{{(isset($tags)&&$tags?__('Please Select or Input'):__('Please Select')).' '.__($label_name) }}",
            "tags":{{isset($tags)&&$tags?'true':'false'}},
            createTag: function(params) {
                if (params.term.indexOf(' ') > 0) {
                    var str = params.term;
                    str = str.substr(0, str.length - 1);
                    return {
                        id: str,
                        text: str
                    }
                } else {
                    return null;
                }
            }
        });
    });
</script>
@append
