<div class="form-group row">
    <label class="col-12 col-sm-2 col-form-label text-sm-right">{{ __($label_name) }}</label>
    <div class="col-12 col-sm-10">
        <textarea class="form-control ckeditor" id="{{ $form_name }}" name="{{ $form_name }}">{!! isset($value)?$value:'' !!}</textarea>
        <div class="invalid-feedback" id="{{ $form_name }}-feedback"></div>
    </div>
</div>
@section('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#{{ $form_name }}'), ckeditor_option)
        .then(editor => {
            //console.log( 'Editor was initialized', editor );
        })
        .catch(error => {
            console.error(error.stack);
        });
</script>
@append
