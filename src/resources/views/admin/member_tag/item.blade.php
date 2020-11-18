<tr data-node-id="{{$item->id}}" data-node-pid="{{$item->parent_id}}">
    <td>
        <a href="{{ admin_url('member-tags/'.$item->id.'/edit') }}">
            {{ $item->name }}
            <i class="fa fa-edit"></i>
        </a>
    </td>
    <td>
        {{ $item->created_at->format(config('app.date_format')) }}
    </td>
    <td class="text-right">
        <form method="post" action="{{ admin_url('member-tags/'.$item->id ) }}">
            @csrf
            @method('DELETE')
            @if($item->parent_id == 0)
                <a href="{{ admin_url('member-tags/create?parent_id='.$item->id) }}"
                   class="btn btn-sm btn-primary">
                    <i class="fa fa-sitemap"></i> {{ trans('nav.add_menu_child') }} [1]
                </a>
            @endif

            <button class="btn btn-danger btn-sm" type="submit">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </td>
</tr>
