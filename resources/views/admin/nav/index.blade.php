@extends('admin.layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }}

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
                        <div class="alert alert-danger">{{ trans('nav.alert.add_nav_position') }}</div>
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
                            <th style="width: 180px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($items->count() > 0)
                            @foreach ($items as $item)
                                <tr data-node-id="{{$item->id}}" data-node-pid="{{$item->parent_id}}">
                                    <td>
                                        <a href="{{ admin_url('navs/'.$item->id.'/edit') }}">
                                            {{ $item->title }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ \App\Models\Nav::dropDownType()[$item->type] ?? '--' }}

                                        @if(!empty($item->value))
                                            <a target="_blank" href="{{ url($item->value) }}">
                                                <i class="fa fa-external-link" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->created_at->format('d/m/Y H:s') }}
                                    </td>
                                    <td class="text-right">
                                        <form method="post" action="{{ admin_url('navs/'.$item->id ) }}">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ admin_url('navs/create?parent_id='.$item->id.'&position='.$position) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fa fa-sitemap"></i> {{ trans('nav.add_menu_child') }}
                                            </a>

                                            <button class="btn btn-danger btn-sm" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
