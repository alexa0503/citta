<div class="form-group row">
    <label class="col-12 col-sm-2 col-form-label text-sm-right">{{ __($label_name??'') }}</label>
    <div class="col-12 col-sm-10">
        <div class="row mt-2 row-images">
            <div class="col-3">
                <a class="holder" href="{{ $image->url??$image }}" target="_blank"><img src="{{ $image->url??$image }}" style="width:100%;max-height:200px;max-width:200px;" /></a>
            </div>
            <div class="col-6">
                <button data-input="thumbnail" data-preview="holder" class="images-ckfinder file-upload-browse btn btn-primary" type="button">{{ __('Upload Image') }}</button>
                <input name="{{ $form_name??'image' }}" type="hidden" class="thumbnail form-control file-upload-info" placeholder="上传图片" value="{{ $image->url??$image }}">
            </div>
        </div>
    </div>
</div>

@section('scripts')
{{-- @include('ckfinder::setup') --}}
<script>
    $(document).on('click', '.images-ckfinder', function() {
        var obj = $(this).parent().parent();
        CKFinder.popup({
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function(finder) {
                finder.on('files:choose', function(evt) {
                    var file = evt.data.files.first();
                    obj.find("input").val(file.getUrl());
                    obj.find(".holder").attr("href", file.getUrl());
                    obj.find(".holder img").attr("src", file.getUrl());
                });
                finder.on('file:choose:resizedImage', function(evt) {
                    obj.find("input").val(evt.data.resizedUrl);
                    obj.find(".holder").attr("href", evt.data.resizedUrl);
                    obj.find(".holder img").attr("src", evt.data.resizedUrl);
                });
            }
        });
    });
</script>
@append
