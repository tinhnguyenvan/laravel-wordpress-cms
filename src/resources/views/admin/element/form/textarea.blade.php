<div class="form-group">
    @if(!empty($text))
        <label class="col-form-label" for="{{$name}}">{!! $text !!}</label>

        @if(!empty($required))
            <span class="text-danger">({{ trans('common.required') }})</span>
        @endif
    @endif

    @if(($config['editor_content'] ?? '') == 'ckeditor5' && ($class ?? '') == 'ckeditor')
        <div class="box-ckeditor5">
            <div id="toolbar-container"></div>
            <div class="ckeditor5"></div>
            <textarea style="display: none" name="{{$name}}" id="{{$id ?? $name}}" rows="{{ $rows ?? 5 }}" placeholder="{{ $placeholder ?? '' }}"
                      class="text-{{ $config['editor_content'] ?? '' }} form-control {{ $class ?? '' }}">{{ old($name, $value) }}</textarea>
        </div>
    @else
        <div class="controls">
        <textarea name="{{$name}}" id="{{$id ?? $name}}" rows="{{ $rows ?? 5 }}" placeholder="{{ $placeholder ?? '' }}"
                  class="form-control {{ $class ?? '' }}">{{ old($name, $value) }}</textarea>
        </div>
    @endif
</div>
