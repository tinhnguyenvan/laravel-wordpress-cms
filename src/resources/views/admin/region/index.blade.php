@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }}


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
            @include('admin.element.filter')
            <table id="simple-tree-table" data-opened="closed" class="table table-responsive-sm table-bordered">
                <thead>
                <tr>
                    <th>{{ trans('common.name') }}</th>
                    <th class="text-center">{{ trans('common.level') }}</th>
                    <th class="text-center">{{ trans('common.order_by') }}</th>
                    <th>{{ trans('common.created_at') }}</th>
                    <th style="width: 220px;"></th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $key => $item)
                        @include('admin.region.item', compact('item', 'key'))
                        @foreach ($item->cities as $key => $item)
                            @include('admin.region.item', compact('item', 'key'))
                        @endforeach
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
                            {{ trans('common.data_empty') }}
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
