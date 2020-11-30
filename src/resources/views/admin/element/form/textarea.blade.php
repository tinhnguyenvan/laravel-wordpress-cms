<div class="form-group">
    @if(!empty($text))
        <label class="col-form-label" for="{{$name}}">{{$text}}</label>
    @endif
    <div class="controls">
        <textarea name="{{$name}}" id="{{$id ?? $name}}" rows="{{ $rows ?? 5 }}"
                  class="form-control {{ $class ?? '' }}">{{ old($name, $value) }}</textarea>
    </div>
</div>
