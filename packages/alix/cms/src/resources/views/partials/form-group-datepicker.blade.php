<div class="form-group row">
    <label class="col-12 col-sm-2 col-form-label text-sm-right">{{ __($label_name) }}</label>
    <div class="col-12 col-sm-10">
        <input required="" value="{{ $value }}" class="form-control datepicker" id="{{ $form_name }}" name="{{ $form_name }}" type="text" placeholder="{{ __('Please Select').' '.__($label_name) }}" autocomplete="off">
        <div class="invalid-feedback" id="{{ $form_name }}-feedback"></div>
    </div>
</div>
