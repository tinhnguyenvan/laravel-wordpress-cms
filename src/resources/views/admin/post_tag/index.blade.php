@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->total() }})

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('post_tags/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.element.filter')

            <form method="post" onsubmit="return confirm('Do you want DELETE ?');" action="{{ admin_url('post_tags/destroy-multi') }}">
                @csrf
                @method('DELETE')
                <table class="table table-responsive-sm table-bordered table-hover font12">
                    <thead>
                    <tr class="bg-light">
                        <th class="text-center w50">
                            <input type="checkbox" name="check_all" id="check_all" value="1">
                        </th>
                        <th>
                            <a href="">
                                {{ trans('post.title') }}
                            </a>
                        </th>

                        <th>{{ trans('post.description') }}</th>
                        <th>{{ trans('post.slug') }}</th>
                        <th>{{ trans('post.source') }}</th>
                        <th>{{ trans('post.total_usage') }}</th>
                        <th>{{ trans('post.updated_at') }}</th>
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
                                    <a href="{{ admin_url('post_tags/'.$item->id.'/edit') }}">
                                        {{ $item->title }}
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    {{ $item->description }}
                                </td>
                                <td>
                                    {{ $item->slug }}
                                </td>
                                <td>
                                    {{ $item->source_text }}
                                </td>
                                <td>
                                    {{ $item->total_usage }}
                                </td>
                                <td>
                                    {{ $item->updated_at->format(config('app.date_format')) }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">
                                {{ trans('common.data_empty') }}
                            </td>
                        </tr>
                    @endif
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="7">
                            @include('admin.element.button.delete_multi')
                        </td>
                    </tr>
                    </tfoot>
                </table>

            </form>

            @include('admin.element.pagination')
        </div>
    </div>

@endsection
