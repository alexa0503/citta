@extends('cms::layouts.auth')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <!-- <div class="brand-logo">
                <img src="../../images/logo.svg" alt="logo">
              </div> -->
                        <h4>您好，请登陆</h4>
                        <!-- <h6 class="font-weight-light">请登陆.</h6> -->
                        <form id="login-form" class="pt-3" method="POST" action="{{ route('cms.login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="name" name="name" type="text" class="form-control form-control-lg" id="" placeholder="登录名">
                                <div class="invalid-feedback" id="name-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input id="password" name="password" type="password" class="form-control form-control-lg" id="" placeholder="密码">
                                <div class="invalid-feedback" id="name-feedback"></div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                    登陆
                                </button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input value="1" name="remember" type="checkbox" class="form-check-input">
                                        记住我
                                    </label>
                                </div>
                                <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                            </div>
                            <!-- <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#login-form").on("submit", function(e) {
            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#login-form button').html('{{ __("loading") }}').prop('disabled', true);
                },
                complete: function() {
                    $('#login-form button').html('{{ __("Login") }}').prop('disabled', false);
                },
                success: function(data) {
                    location.href = "/cms";
                    //if (getUrlParameter("url")) {
                    //    location.href = decodeURIComponent(getUrlParameter("url"))
                    //} else {
                    //    location.href = "/cms";
                    //}
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        $("#login-form input").each(function() {
                            $(this).removeClass('is-invalid');
                            var id = $(this).attr('id')
                            if (xhr.responseJSON.errors && xhr.responseJSON.errors.hasOwnProperty(id)) {
                                $('#' + id).addClass('is-invalid');
                                $('#' + id + '-feedback').html(xhr.responseJSON.errors[id]);
                            } else if (xhr.responseJSON && xhr.responseJSON.hasOwnProperty(id)) {
                                $('#' + id).addClass('is-invalid');
                                $('#' + id + '-feedback').html(xhr.responseJSON[id]);
                            } else {
                                $(this).addClass('is-valid');
                            }
                        })
                        $('#login-form button').html('{{ __("Login") }}').prop('disabled', false);
                    } else if (xhr.status === 302 || xhr.status === 301 || xhr.status === 200) {
                        location.href = "/cms";
                        //if (getUrlParameter("url")) {
                        //    location.href = decodeURIComponent(getUrlParameter("url"))
                        //} else {
                        //    location.href = "/cms";
                        //}
                    } else {
                        alert('{{ __("Server Error") }}')
                        $('#login-form button').html('{{ __("Login") }}').prop('disabled', false);
                    }
                }
            });
            return false;
        });
    });
</script>
@endsection
