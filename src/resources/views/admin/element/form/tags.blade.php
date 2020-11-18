<div class="form-group">
    <label class="col-form-label" for="{{$name}}">{{ $text ?? trans('common.tags') }}</label>
    <div class="controls">
        <input data-role="tagsinput" class="tagsinput" name="{{$name}}" id="{{$name}}" value="{{ old($name, $value) }}">
        <small class="text-info text">{{ trans('common.tags_note') }}</small>
    </div>
</div>