<select name="{{ $name ?? '' }}" id="{{ $name ?? '' }}" class="form-control js-example-basic-single" {{ !empty($attr) ? $attr : '' }}>
    @if (!empty($empty))
        <option value="">{{ trans('common.select_option') }}</option>
    @endif

    @if (!empty($data))
        @foreach ($data as $groupName => $items)
            <optgroup label="{{ $groupName }}">
                @foreach ($items as $id => $value)
                    <option {{ $selected == $id ? 'selected': '' }} value="{{$id}}">{{ $value }}</option>
                @endforeach
            </optgroup>
        @endforeach
    @endif
</select>
