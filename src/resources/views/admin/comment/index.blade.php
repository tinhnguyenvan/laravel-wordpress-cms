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
                        <th style="min-width: 150px">{{ trans('comment.author') }}</th>
                        <th>{{ trans('comment.content') }}</th>
                        <th style="min-width: 150px">Post</th>
                        <th style="width: 130px" class="text-center">
                            Submitted one
                        </th>
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
                                    <i class="fa fa-user-circle"></i> {{ $item->author }}
                                    <br/>
                                    <small>{{ $item->author_email }}</small>
                                    <br/>
                                    <label class="label label-{{ $item->status_color }}">
                                        <i class="fa fa-check-circle-o"></i>
                                        {{ $item->status_text }}
                                    </label>
                                </td>
                                <td>
                                    {{ strip_tags($item->content) }}

                                    <a href="{{ admin_url('comments/'.$item->id.'/edit') }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </td>
                                <td>
                                    @if(!empty($item->post->id))
                                        <a href="{{ $item->post->link }}#box-comment" target="_blank">
                                            {{ $item->post->title }}
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $item->created_at->format(config('app.date_format')) }}
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
