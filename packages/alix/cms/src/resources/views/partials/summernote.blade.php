<div class="form-group row">
    <label class="col-12 col-sm-2 col-form-label text-sm-right">{!! $label_name !!}</label>
    <div class="col-12 col-sm-10">
        <textarea class="form-control" id="{{$form_name}}"
            name="{{$form_name}}">{!! isset($value)?$value:'' !!}</textarea>
        <div class="invalid-feedback" id="{{$form_name}}-feedback"></div>
    </div>
</div>
@section('plugin-css')
<link rel="stylesheet" href="{{ asset('vendor/cms/summernote/summernote.min.css') }}">
@append
@section('scripts')
<script src="{{asset('vendor/cms/summernote/summernote.min.js')}}"></script>
<script src="{{asset('vendor/cms/summernote/plugin/image-attributes/summernote-image-attributes.js')}}"></script>
<script src="{{asset('vendor/cms/summernote/lang/summernote-zh-CN.min.js')}}"></script>
<script src="{{asset('vendor/cms/summernote/plugin/image-attributes/lang/zh-CN.js')}}"></script>
<script>
    $('#{{$form_name}}').summernote({
        lang:'zh-CN',
        height:400,
        toolbar:[
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'image', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        buttons: {
            image: function (context){
                var ui = $.summernote.ui;
                var button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: '插入图片',
                click: function() {
                    lfm({type: 'image', prefix: '/filemanager'}, function(data) {
                        context.invoke('editor.insertImage', data[0].url, (image)=>{
                            image.css('width','');
                        });
                    });
                }
                });
                return button.render();
            }
        },
        popover: {
            image: [
                ['custom', ['imageAttributes']],
                ['imagesize', ['resizeFull', 'resizeHalf', 'resizeQuarter','resizeNone']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ],
        },
        lang: 'zh-CN', // Change to your chosen language
        imageAttributes:{
            icon:'<i class="note-icon-pencil"/>',
            removeEmpty:false, // true = remove attributes | false = leave empty if present
            disableUpload: true // true = don't display Upload Options | Display Upload Options
        }
        // callbacks:{
        //     onImageUpload: function(files, editor, welEditable) {
        //         alert("111");
        //         lfm({type: 'image', prefix: '/filemanager'}, function(url, path) {
        //             obj.find("input").val(path);
        //             obj.find(".holder").attr('src', url);
        //         });
        //     }
        // }
    });
</script>
@append
