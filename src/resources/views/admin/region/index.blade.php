@extends('admin.layout.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->count() }})


            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('regions/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="simple-tree-table" class="table table-hover table-bordered table-sm table-striped">
                <thead>
                <tr>
                    <th>{{ trans('common.name') }}</th>
                    <th class="text-center">{{ trans('common.order_by') }}</th>
                    <th>{{ trans('common.created_at') }}</th>
                    <th style="width: 220px;"></th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $key => $item)
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
                @else
                    <tr>
                        <td colspan="4">
                            {{ trans('common.data_empty') }}
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
