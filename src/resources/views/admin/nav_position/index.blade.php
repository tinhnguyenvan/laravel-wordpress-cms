@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }}

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('nav_positions/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ admin_url('nav_positions') }}">
                @csrf
                <table class="table table-responsive-sm table-bordered table-hover font12">
                    <thead>
                    <tr class="bg-light">
                        <th class="width-check-item">ID</th>
                        <th>
                            <a href="">
                                {{ trans('nav.title') }}
                            </a>
                        </th>

                        <th>{{ trans('nav.slug') }}</th>
                        <th>{{ trans('nav.created_at') }}</th>
                        <th style="width: 180px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($items->count() > 0)
                        @foreach ($items as $item)
                            <tr>
                                <td class="width-check-item">{{ $item->id }}</td>
                                <td>
                                    <a href="{{ admin_url('nav_positions/'.$item->id.'/edit') }}">
                                        {{ $item->title }}
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    {{ $item->slug }}
                                </td>
                                <td>
                                    {{ $item->created_at->format(config('app.date_format')) }}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary" href="{{admin_url('navs/create?position='.$item->id)}}">
                                        <i class="icon-plus"></i>
                                        {{trans('nav.button.add_menu')}}
                                    </a>
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
