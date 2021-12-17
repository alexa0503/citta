@extends('cms::layouts.cms')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-default">
                <div class="card-body">
                    <h4 class="card-title">常规设置 - 新增</h4>
                    <form class="needs-validation post-form" novalidate method="POST"
                        action="{{ route('cms.posts.store') }}">
                        @csrf
                        @include('cms::partials.form-group',['form_name'=>'title','label_name'=>'标题','value'=>'','multiple_locales'=>true])
                        @include("cms::partials.form-description",['value'=>'','form_name'=>'body','label_name'=>'内容'])
                        <div class="form-group row mt-6">
                            <div class="col-12 col-sm-10 offset-sm-2">
                                <p class="text-left">
                                    <button class="btn btn-space btn-primary" type="submit">提交</button>
                                    <a href="{{ session('redirect_uri') }}" class="btn btn-secondary" role="button"
                                        aria-pressed="true">返回</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@include('cms::partials.form-js')
<script>
    $().ready(function() {
       
    });
</script>
@append