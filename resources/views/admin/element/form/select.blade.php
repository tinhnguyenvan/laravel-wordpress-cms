<select name="{{ $name }}" id="{{ $name }}" class="form-control" {{ !empty($attr) ? $attr : '' }}>
    @if (!empty($empty))
        <option value="">{{ trans('common.select_option') }}</option>
    @endif

    @if (!empty($data))
        @foreach ($data as $id => $value)
            <option {{ $selected == $id ? 'selected': '' }} value="{{$id}}">{{ $value }}</option>
        @endforeach
    @endif
</select>