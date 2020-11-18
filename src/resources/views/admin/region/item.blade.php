<tr data-node-id="{{$item->source_id}}" data-node-pid="{{$item->source_parent_id}}">
    <td>
        <a href="{{ admin_url('regions/'.$item->id.'/edit') }}">
            {{ $item->name }}
            <i class="fa fa-edit"></i>
        </a>
    </td>
    <td class="text-center">{{ $item->level }}</td>
    <td class="text-center">{{ $item->order_by }}</td>
    <td>
        {{ !empty($item->updated_at) ? $item->updated_at->format(config('app.date_format')) : '--' }}
    </td>
    <td class="text-right">
        <form method="post" action="{{ admin_url('regions/'.$item->id ) }}">
            @csrf
            @method('DELETE')

            @if($item->level < 4 )
                <a href="{{ admin_url('regions/create?source_parent_id='.$item->source_id.'&level='.$item->level) }}"
                   class="btn btn-sm btn-primary">
                    <i class="icon-plus"></i> {{ trans('nav.add_menu_child') }}
                </a>
            @endif
            @if($item->cities->count() == 0 )
                <button class="btn btn-danger btn-sm" type="submit">
                    <i class="fa fa-trash"></i>
                </button>
            @endif
        </form>
    </td>
</tr>