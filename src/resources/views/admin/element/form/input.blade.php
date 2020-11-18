<div class="form-group">
    <label class="col-form-label" for="{{$name}}">
        {{$text}}
        @if(!empty($class) && $class == 'date-time-picker')
            <i class="fa fa-calendar"></i>
        @endif
    </label>
    <div class="controls">
        <div class="input-group">
            <input type="{{ $type ?? 'text' }}" name="{{$name}}" id="{{$name}}" value="{{ old($name, $value) }}"
                   class="form-control {{ $class ?? '' }}" autocomplete="off"/>
            @if(empty($type) || ($type == 'text'))
                <div class="input-group-append">
                    <span class="input-group-text">{{ config('app.locale') == 'vi' ?  '🇻🇳' : '🇬🇧' }}</span>
                </div>
            @endif
        </div>
    </div>
</div>