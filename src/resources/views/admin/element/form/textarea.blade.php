<div class="form-group">
    @if(!empty($text))
        <label class="col-form-label" for="{{$name}}">{!! $text !!}</label>

        @if(!empty($required))
            <span class="text-danger">({{ trans('common.required') }})</span>
        @endif
    @endif
    <div class="controls">
        <textarea name="{{$name}}" id="{{$id ?? $name}}" rows="{{ $rows ?? 5 }}" placeholder="{{ $placeholder ?? '' }}"
                  class="form-control {{ $class ?? '' }}">{{ old($name, $value) }}</textarea>
    </div>
</div>
