@extends('admin.layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }}

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('member-tags/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.element.filter')
            <table data-opened="closed" class="table table-responsive-sm table-bordered table-hover simple-tree-table">
                <thead>
                <tr>
                    <th>{{ trans('common.name') }}</th>
                    <th>{{ trans('common.created_at') }}</th>
                    <th style="width: 220px;"></th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $item)
                        @include('admin.member_tag.item', compact('item'))
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">
                            {{ trans('common.data_empty') }}
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
