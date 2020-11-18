<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="{{$name}}" id="{{$name. $valueDefault}}"
           value="{{$valueDefault}}" {{ $value == $valueDefault ? 'checked': '' }} />
    <label class="form-check-label" for="{{$name. $valueDefault}}">{{$text}}</label>
</div>