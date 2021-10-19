<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <title>{{ config('app.name') }} - 后台管理</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendor/cms/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/cms/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendor/cms/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/cms/noty/noty.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/cms/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/cms/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/cms/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/cms/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}">
    @yield('plugin-css')
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('vendor/cms/css/style.css') }}">
    <!-- endinject -->
    <style>
        .noty_body {
            text-align: center;
        }

        .thumbnail {
            position: relative;
        }

        .thumbnail-remove {
            position: absolute;
            right: 0;
            top: 0;
        }

        .ck-editor__editable_inline {
            min-height: 500px;
        }

        .ck-content .text-tiny {
            font-size: 0.7em;
        }

        .ck-content .text-small {
            font-size: 0.85em;
        }

        .ck-content .text-big {
            font-size: 1.4em;
        }

        .ck-content .text-huge {
            font-size: 1.8em;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include("cms::nav")
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <x-cms-sidebar />
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- container-scroller -->
    </div>

    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"><a href="https://site.v.ttsample.com/" target="_blank">途田信息制作</a></span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Email:<a href="mailto:alexa.wang@ttsample.com">alexa.wang@ttsample.com</a></span>
        </div>
    </footer>
    <!-- plugins:js -->
    <script src="{{ asset('vendor/cms/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('vendor/cms/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/cms/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/cms/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/cms/noty/noty.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/cms/dropzone/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/cms/quill/quill.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/cms/flatpickr/flatpickr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/cms/flatpickr/l10n/zh.js') }}"></script>
    @yield('plugin-js')
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('vendor/cms/js/off-canvas.js') }}"></script>
    <script src="{{ asset('vendor/cms/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('vendor/cms/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('vendor/cms/js/dashboard.js') }}"></script>
    <script src="{{ asset('vendor/cms/js/data-table.js') }}"></script>
    <script src="{{ asset('vendor/cms/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/cms/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('vendor/cms/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>
    <script src="{{ asset('vendor/cms/js/app.js') }}"></script>
    <!-- End custom js for this page-->
    <script type="text/javascript">
        var ckeditor_option = {
            language: 'zh-cn',
            mediaEmbed: {
                previewsInData: true,
                providers: [{
                        name: 'dailymotion',
                        url: /^dailymotion\.com\/video\/(\w+)/,
                        html: match => {
                            const id = match[1];

                            return (
                                '<div style="position: relative; padding-bottom: 100%; height: 0; ">' +
                                `<iframe src="https://www.dailymotion.com/embed/video/${ id }" ` +
                                'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" ' +
                                'frameborder="0" width="480" height="270" allowfullscreen allow="autoplay">' +
                                '</iframe>' +
                                '</div>'
                            );
                        }
                    },

                    {
                        name: 'spotify',
                        url: [
                            /^open\.spotify\.com\/(artist\/\w+)/,
                            /^open\.spotify\.com\/(album\/\w+)/,
                            /^open\.spotify\.com\/(track\/\w+)/
                        ],
                        html: match => {
                            const id = match[1];

                            return (
                                '<div style="position: relative; padding-bottom: 100%; height: 0; padding-bottom: 126%;">' +
                                `<iframe src="https://open.spotify.com/embed/${ id }" ` +
                                'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" ' +
                                'frameborder="0" allowtransparency="true" allow="encrypted-media">' +
                                '</iframe>' +
                                '</div>'
                            );
                        }
                    },

                    {
                        name: 'youtube',
                        url: [
                            /^(?:m\.)?youtube\.com\/watch\?v=([\w-]+)/,
                            /^(?:m\.)?youtube\.com\/v\/([\w-]+)/,
                            /^youtube\.com\/embed\/([\w-]+)/,
                            /^youtu\.be\/([\w-]+)/
                        ],
                        html: match => {
                            const id = match[1];
                            return (
                                '<div style="position: relative; padding-bottom: 100%; height: 0; padding-bottom: 56.2493%;">' +
                                `<iframe src="https://www.youtube.com/embed/${ id }" ` +
                                'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" ' +
                                'frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>' +
                                '</iframe>' +
                                '</div>'
                            );
                        }
                    },

                    {
                        name: 'vimeo',
                        url: [
                            /^vimeo\.com\/(\d+)/,
                            /^vimeo\.com\/[^/]+\/[^/]+\/video\/(\d+)/,
                            /^vimeo\.com\/album\/[^/]+\/video\/(\d+)/,
                            /^vimeo\.com\/channels\/[^/]+\/(\d+)/,
                            /^vimeo\.com\/groups\/[^/]+\/videos\/(\d+)/,
                            /^vimeo\.com\/ondemand\/[^/]+\/(\d+)/,
                            /^player\.vimeo\.com\/video\/(\d+)/
                        ],
                        html: match => {
                            const id = match[1];
                            return (
                                '<div style="position: relative; padding-bottom: 100%; height: 0; padding-bottom: 56.2493%;">' +
                                `<iframe src="https://player.vimeo.com/video/${ id }" ` +
                                'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" ' +
                                'frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>' +
                                '</iframe>' +
                                '</div>'
                            );
                        }
                    },

                    {
                        name: 'instagram',
                        url: /^instagram\.com\/p\/(\w+)/
                    },
                    {
                        name: 'twitter',
                        url: /^twitter\.com/
                    },
                    {
                        name: 'googleMaps',
                        url: /^google\.com\/maps/
                    },
                    {
                        name: 'flickr',
                        url: /^flickr\.com/
                    },
                    {
                        name: 'facebook',
                        url: /^facebook\.com/
                    },
                    {
                        name: 'taobao',
                        url: /^cloud\.video\.taobao.*/,
                        html: match => {
                            //获取媒体url
                            const input = match['input'];
                            //console.log('input' + match['input']);
                            return (
                                `<video controls width="100%"><source src="https://${input}" autoplay type="video/mp4"><p>Your browser doesn't support HTML5 video. Here is a <a href="https://${input}">link to the video</a> instead.</p></video>`
                            );
                        }
                    },
                    {
                        name: 'stanfordresidences',
                        url: /.+/,
                        html: match => {
                            //获取媒体url
                            const input = match['input'];
                            return (
                                `<video controls width="100%"><source src="${input}" autoplay type="video/mp4"><p>Your browser doesn't support HTML5 video. Here is a <a href="${input}">link to the video</a> instead.</p></video>`
                            );
                        }
                    }
                ]
            }
        };
        Noty.overrideDefaults({
            layout: "center",
            theme: "nest",
            timeout: 1000,
            progressBar: false,
            killer: true
        });
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ajaxError(function(event, jqxhr, settings, thrownError) {
                if (jqxhr.status == 401) {
                    new Noty({
                        type: 'error',
                        text: '<span class="mdi mdi-close-circle-outline"></span> {{ __("Sorry, please log in.") }}'
                    }).show();
                } else if (jqxhr.status >= 500 || jqxhr.status == 400) {
                    if (jqxhr.responseJSON.errors && typeof jqxhr.responseJSON.errors === 'string') {
                        new Noty({
                            type: 'error',
                            text: '<span class="mdi mdi-close-circle-outline"></span> ' + jqxhr.responseJSON.errors
                        }).show();
                    } else if (jqxhr.responseJSON.errors) {
                        new Noty({
                            type: 'error',
                            text: '<span class="mdi mdi-close-circle-outline"></span> ' + jqxhr.responseJSON.errors[0]
                        }).show();
                    } else {
                        new Noty({
                            type: 'error',
                            text: '<span class="mdi mdi-close-circle-outline"></span> {{ __("Server Error") }}'
                        }).show();
                    }
                }
            });
            $(".destroy,.publish").on("click", function() {
                if ($(this).hasClass('publish') || $(this).hasClass('destroy') && confirm("此操作不可返回，是否继续？")) {
                    $.ajax({
                        url: $(this).data("url"),
                        method: $(this).data('method'),
                        dataType: "JSON",
                        beforeSend: function() {},
                        complete: function() {},
                        success: function(data) {
                            new Noty({
                                timeout: 500,
                                type: 'success',
                                text: '<i class="mdi mdi-check-circle"></i>  {{ __("Successfully updated!") }}'
                            }).on('afterShow', function() {
                                window.location.reload();
                            }).show();
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 422 || xhr.status === 400 || xhr.status === 405) {
                                if (typeof xhr.responseJSON.errors === 'string') {
                                    new Noty({
                                        type: 'error',
                                        text: '<span class="mdi mdi-close-circle-outline"></span> ' + xhr.responseJSON.errors
                                    }).show();
                                } else {
                                    new Noty({
                                        type: 'error',
                                        text: '<span class="mdi mdi-close-circle-outline"></span> ' + xhr.responseJSON.errors[0]
                                    }).show();
                                }
                            }
                        }
                    });
                }
                return false;
            });
        });
    </script>
    @include('ckfinder::setup')
    <script src="{{ asset('vendor/cms/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/cms/ckeditor5/translations/zh-cn.js') }}"></script>
    @yield('scripts')
</body>

</html>
