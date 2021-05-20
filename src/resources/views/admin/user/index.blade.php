@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->total() }})

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('users/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.element.filter')

            <table class="table table-responsive-sm table-bordered table-hover font12">
                    <thead>
                    <tr class="bg-light">
                    <th>{{ trans('user.name') }}</th>
                    <th>{{ trans('user.email') }}</th>
                    <th>{{ trans('user.role_id') }}</th>
                    <th>{{ trans('user.updated_at') }}</th>
                    <th style="width: 200px"></th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <a href="{{ admin_url('users/'.$item->id.'/edit') }}">
                                    {{ $item->name }}
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                {{ $item->email }}
                            </td>
                            <td>
                                {{ !empty($item->role->name) ? $item->role->name : '--' }}
                            </td>
                            <td>
                                {{ $item->updated_at }}
                            </td>
                            <td class="text-center">
                                @if($item->status == \App\Models\User::STATUS_WAITING_ACTIVE)
                                    <form method="post" action="{{ admin_url('users/active/'.$item->id ) }}">
                                        @csrf

                                        <button class="btn btn-warning btn-sm" type="submit">
                                            <i class="fa fa-envelope"></i> {{ trans('user.btn_active') }}
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-{{ $item->status_color }} btn-sm">
                                        <i class="fa fa-check-circle-o"></i>
                                        {{ $item->status_text }}
                                    </button>
                                @endif
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
