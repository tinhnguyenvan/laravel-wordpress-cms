@foreach($items as $item)
    <tr data-node-id="{{$item->id}}" data-node-pid="{{$item->parent_id}}">
        <td>
            <a href="{{ admin_url('regions/'.$item->id.'/edit') }}">
                {{ $item->name }}
                <i class="fa fa-edit"></i>
            </a>
        </td>

        <td class="text-center">{{ $item->order_by }}</td>
        <td>
            {{ !empty($item->updated_at) ? $item->updated_at->format(config('app.date_format')) : '--' }}
        </td>

        <td class="text-right">
            <form method="post" onsubmit="return confirm('Do you want DELETE ?');" action="{{ admin_url('regions/'.$item->id ) }}">
                @csrf
                @method('DELETE')
                    <a href="{{ admin_url('regions/create?parent_id='.$item->id) }}"
                       class="btn btn-sm btn-primary">
                        <i class="icon-plus"></i> {{ trans('nav.add_menu_child') }}
                    </a>
                @if($item->subItem->count() == 0 )
                    <button class="btn btn-danger btn-sm" type="submit">
                        <i class="fa fa-trash"></i>
                    </button>
                @endif
            </form>
        </td>
    </tr>

    @if($item->subItem->count() > 0 )
        @include('admin.region.item',['items' => $item->subItem])
    @endif
@endforeach
