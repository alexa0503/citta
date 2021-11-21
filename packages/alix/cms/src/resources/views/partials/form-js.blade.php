<script>
    $(document).ready(function() {
        $(".ckfinder").click(function(){
            var obj = $(this).parent().parent().parent();
            CKFinder.popup( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        obj.find("input").val(file.getUrl());
                        obj.find(".holder").attr("src", file.getUrl());
                    } );
                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        obj.find("input").val(evt.data.resizedUrl);
                        obj.find(".holder").attr("src", evt.data.resizedUrl);
                    } );
                }
            });
        });
        $(".lfm").click(function() {
            //var obj = $(this).parents("div.col-12");
            var obj = $(this).parent().parent().parent();
            lfm({
                type: "image",
                prefix: "/filemanager"
            }, function(data) {
                obj.find("input").val(data[0].url.replace("{{ url('/') }}", ''));
                obj.find(".holder").attr("src", data[0].thumb_url);
            });
        });
        $(".post-form").on("submit", function(e) {
            var form = $(this)
            // var data = $(this).serializeArray();
            // if( $(this).attr('enctype') === 'multipart/form-data'){
            //     data = new FormData($(".post-form")[0]);
            // }
            $(".post-form").trigger('form-pre-serialize');
            var data = new FormData($(".post-form")[0]);
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                enctype: $(this).attr('enctype'),
                processData: false,
                contentType: false,
                cache: false,
                dataType: "JSON",
                data: data,
                beforeSend: function() {
                    $(".is-invalid").removeClass('is-invalid');
                    $(".invalid-feedback").hide();
                    $(':submit').html('{{ __("loading") }}').prop('disabled', true);
                },
                complete: function() {
                    $(':submit').html('{{ __("Submit") }}').prop('disabled', false);
                },
                success: function(data) {
                    new Noty({
                        timeout: 500,
                        type: 'success',
                        text: '<i class="fa fa-check-circle"></i>  {{ __("Successfully updated!") }}'
                    }).on('afterShow', function() {
                        location.href = data.redirectUri;
                    }).show();
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        let hasKey = false;
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key + '-feedback').html(value).show();
                            hasKey = true;
                        })
                        if (!hasKey) {
                            new Noty({
                                type: 'error',
                                text: '<span class="mdi mdi-close-circle-outline"></span> ' + errors[Object.keys(errors)[0]]
                            }).show();
                        }
                        $(':submit').html('{{ __("Submit") }}').prop('disabled', false);
                    } else {
                        $(':submit').html('{{ __("Submit") }}').prop('disabled', false);

                    }
                }
            });
            return false;
        });

        $(".post-form").on("click", ".drop-language", function() {
            var input = $(this).data("input");
            var obj = $(this)
                .parent(".dropdown-menu")
                .parent(".input-group-prepend")
                .parent(".input-group");
            obj.find(".input-language").attr("type", "hidden");
            obj.find("." + input).attr("type", "text");
            obj.find(".btn-language").text($(this).text());
        });

    });
</script>
