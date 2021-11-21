<script>
    var maxFiles = {{isset($max_files) ? $max_files : 1}};
    Dropzone.autoDiscover = false;
    var name = "{{ isset($name)?$name:'image' }}"
    var input = $("input[name='{{ isset($input)?$input:'image' }}']");
    var url = "{{isset($name)?route('cms.upload',['name'=>$name]):route('cms.upload',['name'=>'image'])}}";
    var dropzoneOptions = {
        url: url,
        addRemoveLinks: true,
        paramName: name,
        maxFiles: maxFiles,
        acceptedFiles: 'image/*',
        dictCancelUpload: '取消',
        dictRemoveFile: '删除文件',
        dictMaxFilesExceeded: '最多上传' + maxFiles + '张图片',
        method: 'post',
        thumbnailWidth: {{ isset($thumbnail_width) ? $thumbnail_width : 200 }},
        thumbnailHeight: {{ isset($thumbnail_height) ? $thumbnail_height : 200 }},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        complete: function(file) {
            if (file.status === 'error') {
                // alert('服务器错误')
                this.removeFile(file);
            } else if (file.xhr) {
                let response = JSON.parse(file.xhr.responseText);
                let v = input.val();
                if (v !== '') {
                    v = v + ','
                }
                input.val(v + response.path);
            }
            file.previewElement.classList.add('dz-success');
            return file.previewElement.classList.add("dz-complete");
        },
        maxfilesexceeded: function() {
            new Noty({
                type: 'error',
                text: '<i class="mdi mdi-close-circle-outline"></i> 最多只能上传' + maxFiles + '张文件'
            }).show();
        },
        removedfile: function(file) {
            // this.emit("removedfile",file);
            var array = input.val().split(",");
            var index = array.indexOf(file.path);
            if (index > -1) {
                array.splice(index, 1);
                input.val(array.join(","))
            }
            var _ref;
            if (file.previewElement) {
                if ((_ref = file.previewElement) != null) {
                    _ref.parentNode.removeChild(file.previewElement);
                }
            }
            return this._updateMaxFilesReachedClass();
        },
        reset: function() {
            input.val('');
            return this.element.classList.remove("dz-started");
        },
        @if(isset($image) && $image)
        init: function() {
            var images = [];
            @if(isset($max_files) && $max_files > 1)
            images = @json($image);
            @else
            var mock = @json($image);
            images.push(mock);
            @endif
            var path = [];
            for (i = 0; i < images.length; i++) {
                const mock = images[i];
                if(mock){
                    mock.accepted = true;
                    this.files.push(mock);
                    this.emit('addedfile', mock);
                    this.createThumbnailFromUrl(mock, mock.url);
                    this.emit('complete', mock);
                    path.push(images[i].path);
                }
            }
            input.val(path.join(","));
        }
        @endif
    };
    $('.dropzone').dropzone(dropzoneOptions);
</script>
