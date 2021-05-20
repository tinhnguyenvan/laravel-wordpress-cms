@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->total() }})
        </div>
        <div class="card-body">
            @include('admin.element.filter')

            <table class="table table-responsive-sm table-bordered table-hover font12">
                    <thead>
                    <tr class="bg-light">
                    <th>Type</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->model_type }}</td>
                            <td>{{ $item->model_id }}</td>
                            <td>{{ $item->member_id }}</td>
                            <td>
                                {{ $item->created_at ? $item->created_at->format(config('app.date_format')) : '--' }}
                            </td>
                            <td class="text-center">
                                <form method="post" onsubmit="return confirm('Do you want DELETE ?');" action="{{ admin_url('bookmarks/'.$item->id ) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
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
            </table>

            @include('admin.element.pagination')
        </div>
    </div>

@endsection
