@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->count() }})

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('navs/create?position='.$position) }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>

            <div class="text-danger">
                <small>{{ trans('nav.text-info-number-level') }}</small>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    @if ($itemPositions->count() > 0)
                        <ul class="list-group">
                            @foreach ($itemPositions as $itemPosition)
                                <li class="list-group-item {{ $position == $itemPosition->slug ? 'active': '' }}">
                                    <a href="{{ admin_url('navs?position='.$itemPosition->slug) }}">
                                        <i class="fa fa-th-list"></i> {{ $itemPosition->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-danger">
                            {{ trans('nav.alert.add_nav_position') }}
                            <hr />
                            <a class="btn btn-small btn-primary"  href="{{ admin_url('nav_positions') }}">
                                <i class="fa fa-plus"></i>
                            Add
                            </a>
                        </div>
                    @endif
                </div>
                <div class="col-lg-9">
                    <table id="simple-tree-table" class="table table-bordered table-sm">
                        <thead>
                        <tr>
                            <th>
                                <a href="">
                                    {{ trans('nav.title') }}
                                </a>
                            </th>

                            <th style="width: 170px">{{ trans('nav.type') }}</th>
                            <th style="width: 150px">{{ trans('nav.created_at') }}</th>
                            <th class="text-center">{{ trans('nav.order_by') }}</th>
                            <th style="width: 180px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr data-node-id="{{$item->id}}" data-node-pid="{{$item->parent_id}}">
                                <td>
                                    <a href="{{ admin_url('navs/'.$item->id.'/edit') }}">
                                        {!! $item->title !!}
                                    </a>
                                </td>
                                <td>--</td>
                                <td>
                                    {{ $item->created_at->format(config('app.date_format')) }}
                                </td>
                                <td class="text-center">
                                    {{ $item->order_by ?? 0 }}
                                </td>
                                <td class="text-right">
                                    <form method="post" onsubmit="return confirm('Do you want DELETE ?');" action="{{ admin_url('navs/'.$item->id ) }}">
                                        @csrf
                                        @method('DELETE')
                                        @if($item->level < 2)
                                            <a href="{{ admin_url('navs/create?parent_id='.$item->id.'&position='.$position) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fa fa-sitemap"></i> {{ trans('nav.add_menu_child') }}
                                            </a>
                                        @endif

                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            @if(count($item->subCategory))
                                @include('admin.nav.item',['items' => $item->subCategory])
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
