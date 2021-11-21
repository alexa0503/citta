<div class="form-group row">
    <label class="col-12 col-sm-2 col-form-label text-sm-right">{{ __($label_name??'') }}</label>
    <div class="col-12 col-sm-10">
        @if(isset($images) &&  count($images) > 0)
            @foreach($images as $image)
                <div class="row mt-2 row-images">
                    <div class="col-3">
                        <button class="btn-up btn btn-outline-secondary btn-rounded btn-icon" type="button"><i class="mdi mdi-arrow-up-bold"></i> </button>
                        <button class="btn-down btn btn-outline-secondary btn-rounded btn-icon" type="button"><i class="mdi mdi-arrow-down-bold"></i> </button>
                        <button class="btn-images-delete btn btn-outline-warning btn-rounded btn-icon" type="button"><i class="mdi mdi-delete"></i> </button>
                    </div>
                    <div class="col-3">
                        <a class="holder" href="{{ $image->url??$image }}" target="_blank"><img src="{{ $image->url??$image }}" style="width:100%;max-height:200px;max-width:200px;" /></a>
                    </div>
                    <div class="col-6">
                        <button data-input="thumbnail" data-preview="holder" class="images-ckfinder file-upload-browse btn btn-primary" type="button">{{ __('Upload Image') }}</button>
                        <input name="{{ $form_name??'images' }}[]" type="hidden" class="thumbnail form-control file-upload-info" placeholder="上传图片" value="{{ $image->url??$image }}">
                    </div>
                </div>
            @endforeach
        @endif
        <div class="row mt-4" id="row-add">
            <div class="col-12 text-left">
                <button id="btn-recommend" class="btn btn-outline-secondary btn-rounded btn-icon" type="button"><i class="mdi mdi-plus"></i> </button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
{{-- @include('ckfinder::setup') --}}
<script>
    const addTemplate = function(data) {
        var template = `<div class="row mt-2 row-images">
            <div class="col-3">
                <button class="btn-up btn btn-outline-secondary btn-rounded btn-icon" type="button"><i class="mdi mdi-arrow-up-bold"></i> </button>
                <button class="btn-down btn btn-outline-secondary btn-rounded btn-icon" type="button"><i class="mdi mdi-arrow-down-bold"></i> </button>
                <button class="btn-images-delete btn btn-outline-warning btn-rounded btn-icon" type="button"><i class="mdi mdi-delete"></i> </button>
            </div>
            <div class="col-3">
                <a href="" target="_blank" class="holder"><img src="" style="width:100%;max-height:200px;max-width:200px;" /></a>
            </div>
            <div class="col-6">
                <button data-input="thumbnail" data-preview="holder" class="images-ckfinder file-upload-browse btn btn-primary" type="button">{{ __('Upload Image') }}</button>
                <input name="{{ $form_name??'images' }}[]" type="hidden" class="thumbnail form-control file-upload-info" placeholder="上传图片" value="">
            </div>
        </div>`;
        var obj = $(template);
        console.log(obj);
        if (data) {
            if (data.image && data.image.path) {
                obj.find("input[name='images[]']").val(data.image.path);
            }
        }
        $("#row-add").before(obj);
    };
    $(document).on('click', '#btn-recommend', function() {
        addTemplate();
    });
    $(document).on('click', '.btn-images-delete', function() {
        $(this).parent("div").parent("div.row").remove();
    });

    $(document).on('click', '.btn-up', function() {
        var current = $(this).parents("div.row-images");
        var prev = current.prev(".row-images");
        if (prev.length !== 0) {
            current.replaceWith(prev.clone());
            prev.replaceWith(current.clone());
        }
    });
    $(document).on('click', '.btn-down', function() {
        var current = $(this).parents("div.row-images");
        var next = current.next(".row-images");
        if (next.length !== 0) {
            current.replaceWith(next.clone());
            next.replaceWith(current.clone());
        }
    });
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
