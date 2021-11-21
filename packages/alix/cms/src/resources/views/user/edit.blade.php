@extends('cms::layouts.cms')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-default">
            <div class="card-body">
                <h4 class="card-title">授权用户 - 编辑</h4>
                <form class="needs-validation post-form" novalidate method="POST"
                    action="{{ route('cms.users.update',$item->id??null) }}">
                    @csrf
                    @method("PUT")
                    @include('cms::partials.form-group',['form_name'=>'mobile','label_name'=>'手机号','value'=>$item->mobile??''])

                    <div class="form-group row mt-6">
                        <div class="col-12 col-sm-10 offset-sm-2">
                            <p class="text-left">
                                <button class="btn btn-space btn-primary" type="submit">更新</button>
                                <a href="{{session('redirect_uri')}}" class="btn btn-secondary" role="button"
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
@append
