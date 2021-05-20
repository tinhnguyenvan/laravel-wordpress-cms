@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->total() }})

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('comments/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.element.filter')

            <form method="post" action="{{ admin_url('comments/update-status') }}">
                @csrf
                @method('PUT')
                <table class="table table-responsive-sm table-bordered table-hover font12">
                    <thead>
                    <tr>
                        <td colspan="5">
                            @include("admin.comment.button")
                        </td>
                    </tr>
                    <tr class="bg-light">
                        <th class="text-center w50">
                            <input type="checkbox" name="check_all" id="check_all" value="1">
                        </th>
                        <th style="width: 100px">{{ trans('comment.author') }}</th>
                        <th>{{ trans('comment.author_email') }}</th>
                        <th>{{ trans('comment.content') }}</th>
                        <th style="width: 130px" class="text-center">{{ trans('comment.status') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($items->count() > 0)
                        @foreach ($items as $item)
                            <tr>
                                <td class="text-center">
                                    <input class="check_id" type="checkbox" name="ids[]" value="{{ $item->id }}">
                                </td>
                                <td>
                                    <a href="{{ admin_url('comments/'.$item->id.'/edit') }}">
                                        {{ $item->author }}
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    {{ $item->author_email }}
                                </td>
                                <td>
                                    {{ strip_tags($item->content) }}
                                </td>

                                <td class="text-center">
                                    <label class="btn btn-{{ $item->status_color }} btn-sm">
                                        <i class="fa fa-check-circle-o"></i>
                                        {{ $item->status_text }}
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                {{ trans('common.data_empty') }}
                            </td>
                        </tr>
                    @endif
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="5">
                            @include("admin.comment.button")
                        </td>
                    </tr>
                    </tfoot>
                </table>

            </form>

            @include('admin.element.pagination')
        </div>
    </div>

@endsection
