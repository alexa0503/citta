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
                        @include('cms::partials.form-group',['form_name'=>'name','label_name'=>'模块名（英文，唯一）','value'=>''])
                        @include('cms::partials.form-group',['form_name'=>'title','label_name'=>'标题','value'=>'','multiple_locales'=>true])
                        @include('cms::partials.images',['form_name'=>'image','label_name'=>'头部图片','','image'=>[]])
                        @include('cms::partials.form-group',['form_name'=>'link_type','label_name'=>'链接类型','value'=>''])
                        @include('cms::partials.form-group',['form_name'=>'link','label_name'=>'链接地址','value'=>''])
                        {{-- <div class="form-group row">
                            <label class="col-12 col-sm-2 col-form-label text-sm-right">{{ __('缩略图') }}</label>
                            <div class="col-12 col-sm-10">
                                <div class="input-group col-xs-12 mt-2">
                                    <input name="image" type="text" class="thumbnail form-control file-upload-info" placeholder="上传图片" value="">
                                    <span class="input-group-append">
                                        <button data-input="thumbnail" data-preview="holder" class="ckfinder file-upload-browse btn btn-primary" type="button">{{__('Upload Image')}}</button>
                                    </span>
                                </div>
                                <img src="" class="holder" style="margin-top:15px;width:200px;">
                            </div>
                        </div> --}}
                        @include("cms::partials.form-group-textarea",['value'=>'','form_name'=>'descr','label_name'=>'描述','multiple_locales'=>true])
                        @include("cms::partials.form-group-textarea",['value'=>'','form_name'=>'body','label_name'=>'内容','multiple_locales'=>true])
                        {{-- @include("cms::partials.form-description",['value'=>'','form_name'=>'body','label_name'=>'内容']) --}}
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
@include('cms::partials.dropzone',['input'=>'image'])
@include('cms::partials.form-js')
<script>
    $().ready(function() {
        $(".btn-add").click(function(){
            $(".row-new").before(`<div class="form-group row">
                <label class="col-12 col-sm-2 col-form-label text-sm-right"></label>
                <div class="col-12 col-sm-10">
                    <div class="row">
                        <div class="col-2">{!! Form::text('hotSearches[title][]', null,['class'=>'form-control','placeholder'=>'输入文本']) !!}</div>
                        <div class="col-8">{!! Form::text('hotSearches[url][]','',['class'=>'form-control','placeholder'=>'输入链接']) !!}</div>
                    </div>
                </div>
            </div>`);
        });
    });
</script>
@append