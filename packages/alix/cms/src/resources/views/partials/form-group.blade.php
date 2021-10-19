@php
if(!isset($value)){
    $value = '';
}
$row_class = isset($row_class)?$row_class:"";
@endphp
<div class="form-group row  {{$row_class}}">
    <label class="col-12 col-sm-2 col-form-label text-sm-right">{{ __($label_name) }}</label>
    <div class="col-12 col-sm-10">
        @if(isset($multiple_locales) && $multiple_locales = true)
        @include('cms::partials.input-group')
        @else
        <input {{isset($disabled)&&$disabled?'disabled':''}}  required="" value="{{ $value }}" class="form-control" id="{{ $form_name }}" name="{{ $form_name }}" type="text" placeholder="{{ __($label_name) }}" autocomplete="off">
        @endif
        <div class="invalid-feedback" id="{{ $form_name }}-feedback"></div>
    </div>
</div>
