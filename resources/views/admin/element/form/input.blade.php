<div class="form-group">
    <label class="col-form-label" for="{{$name}}">{{$text}}</label>
    <div class="controls">
        <input type="{{ $type ?? 'text' }}" name="{{$name}}" id="{{$name}}" value="{{ old($name, $value) }}"
               class="form-control" autocomplete="off"/>
    </div>
</div>