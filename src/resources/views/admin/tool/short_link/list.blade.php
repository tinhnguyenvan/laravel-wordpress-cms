@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }}

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('tools/short_link/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.element.filter')
            <form method="post" action="{{ admin_url('tools/short_link/destroy-multi') }}">
                @csrf
                @method('DELETE')
                <table class="table table-responsive-sm table-bordered table-hover font12">
                    <thead>
                    <tr class="bg-light">
                        <th>{{ trans('tool.short_link.title') }}</th>
                        <th>{{ trans('tool.short_link.short_url') }}</th>
                        <th>{{ trans('tool.short_link.url') }}</th>
                        <th>{{ trans('tool.short_link.views') }}</th>
                        <th>{{ trans('common.updated_at') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($items->count() > 0)
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <a href="{{ $item->link_short_url}}" target="_blank">{{ $item->link_short_url}}</a>
                                </td>
                                <td>
                                    <a href="{{ $item->url}}" target="_blank">{{ $item->url}}</a>
                                </td>
                                <td class="text-center">{{ $item->views }}</td>
                                <td>{{ !empty($item->updated_at) ? $item->updated_at->format('d/m/Y H:i') : '' }}</td>
                                <td class="text-center">
                                    <button type="button"
                                            class="clipboard cursor-pointer btn btn-sm btn-default"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Click copy url {{ $item->title }}"
                                            data-clipboard-text="{{ $item->link_short_url }}">
                                        <i class="fa fa-copy"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                {{ trans('common.data_empty') }}
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </form>
            @include('admin.element.pagination')
        </div>
    </div>
@endsection