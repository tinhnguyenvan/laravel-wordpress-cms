<div class="form-group">
    @if(!empty($text))
        <label class="col-form-label">{!! $text !!}</label>
    @endif
    <div>
        <div style="margin-right: 10px; display: inline-block">
            <input class="" type="radio" name="{{$name}}" id="{{$name}}-on"
                   value="on" {{ $value == 'on' ? 'checked': '' }} />
            <label class="form-check-label" for="{{$name}}-on">On</label>
        </div>
        <div style="margin-right: 10px; display: inline-block">
            <input class="" type="radio" name="{{$name}}" id="{{$name}}-off"
                   value="off" {{ $value == 'off' ? 'checked': '' }} />
            <label class="form-check-label" for="{{$name}}-off">Off</label>
        </div>
    </div>
</div>