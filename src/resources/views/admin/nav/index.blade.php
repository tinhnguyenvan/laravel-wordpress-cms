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
                            <th class="text-center">{{ trans('nav.order_by') }}</th>
                            <th style="width: 180px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($items->count() > 0)
                            @foreach ($items as $item)
                                @include('admin.nav.item', compact('item'))
                                @php($itemSub = \App\Models\Nav::query()->where(['parent_id' => $item->id])->orderBy('order_by')->get())
                                @if ($itemSub->count() > 0)
                                    @foreach ($itemSub as $item)
                                        @include('admin.nav.item', compact('item'))
                                        @php($itemSub2 = \App\Models\Nav::query()->where(['parent_id' => $item->id])->orderBy('order_by')->get())
                                        @if ($itemSub2->count() > 0)
                                            @foreach ($itemSub2 as $item)
                                                @include('admin.nav.item', compact('item'))
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
