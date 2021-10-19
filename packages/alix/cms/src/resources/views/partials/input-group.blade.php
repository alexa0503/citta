<div class="input-group">
    <div class="input-group-prepend">
        <button class="btn-language btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">{{config('languages')[Config::get('app.locale')]??''}}</button>
        <div class="dropdown-menu" x-placement="bottom-start"
            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 46px, 0px);">
            @foreach(config('languages') as $key=>$language)
            <a data-input="input-{{$form_name}}-{{$key}}" class="dropdown-item drop-language" href="javascript:;">{{$language}}</a>
            @endforeach
        </div>
    </div>
    @foreach(config('languages') as $key=>$languages)
    <input type="{{Config::get('app.locale')==$key?'text':'hidden'}}"
        class="input-{{$form_name}}-{{$key}} form-control input-language"
        value="{{ $value[$key] ?? ($value[strtolower($key)] ?? '') }}"
        name="{{ $form_name }}[{{$key}}]">
    @endforeach
</div>
