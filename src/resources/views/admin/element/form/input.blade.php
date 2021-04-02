<div class="form-group">
    <label class="col-form-label" for="{{$name}}">
        {{$text}}
        @if(!empty($class) && $class == 'date-time-picker')
            <i class="fa fa-calendar"></i>
        @endif

        @if(!empty($required))
            <span class="text-danger">(required)</span>
        @endif
    </label>
    <div class="controls">
        <div class="input-group">
            <input type="{{ $type ?? 'text' }}"
                   name="{{$name}}"
                   id="{{$name}}"
                   @if(!empty($required)) required @endif
                   placeholder="{{ $placeholder ?? '' }}"
                   value="{{ old($name, $value) }}"
                   class="form-control {{ $class ?? '' }}"
                   autocomplete="off"/>
        </div>
    </div>
</div>
