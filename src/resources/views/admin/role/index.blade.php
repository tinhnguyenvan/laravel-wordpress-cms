@extends('admin.layout.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->total() }})
        </div>
        <div class="card-body">
            <table  id="simple-tree-table" class="table table-responsive-sm table-bordered table-hover font12">
                <thead>
                <tr class="bg-light">
                    <th>{{ trans('post.title') }}</th>
                    <th>{{ trans('post.updated_at') }}</th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $item)
                        <tr data-node-id="{{$item->id}}" data-node-pid="0">
                            <td class="text-primary">{{ $item->description }} [{{ $item->name }}]</td>

                            <td>{{ $item->updated_at->format(config('app.date_format')) }}</td>
                        </tr>
                        @if($item->users->count() > 0)
                            @foreach ($item->users as $user)
                                <tr data-node-id="{{$item->id}}{{$user->id}}" data-node-pid="{{$user->role_id}}">
                                    <td>
                                        {{ $user->name }}
                                        <label class="btn btn-{{ $user->status_color }} btn-sm">
                                            <i class="fa fa-check-circle-o"></i>
                                            {{ $user->status_text }}
                                        </label>
                                    </td>
                                    <td>{{ $user->updated_at->format('d/m/Y H:s') }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="2">
                            {{ trans('common.data_empty') }}
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
