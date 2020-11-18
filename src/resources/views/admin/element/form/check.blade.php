<div class="form-group">
    @if(!empty($text))
        <label class="col-form-label" for="{{$name}}">{{$text}}</label>
    @endif
    <div class="controls">
        <label class="switch switch-label switch-pill switch-outline-primary-alt">
            <input type="checkbox" id="{{$name}}" name="{{$name}}"
                   class="switch-input" {{ !empty($value) && ($value == 'on' || $value == 1) ? 'checked': '' }}>
            <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
        </label>
    </div>
</div>