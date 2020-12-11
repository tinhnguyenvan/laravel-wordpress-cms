@extends('admin.layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }}

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('post_categories/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.element.filter')
            <table  id="simple-tree-table" class="table table-responsive-sm table-bordered table-hover font12">
                <thead>
                <tr class="bg-light">
                    <th>{{ trans('post.title') }}</th>

                    <th>{{ trans('post.slug') }}</th>
                    <th>{{ trans('post.total_usage') }}</th>
                    <th class="text-center">{{ trans('post.image_url') }}</th>
                    <th>{{ trans('post.created_at') }}</th>
                    <th style="width: 220px;"></th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $item)
                        <tr data-node-id="{{$item->id}}" data-node-pid="{{$item->parent_id}}">
                            <td>
                                <a href="{{ admin_url('post_categories/'.$item->id.'/edit') }}">
                                    {{ $item->title }}
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                {{ $item->slug }}
                            </td>
                            <td>
                                {{ $item->total_usage }}
                            </td>
                            <td class="text-center">
                                @if($item->image_url)
                                    <img src="{{ asset('storage'.$item->image_url) }}" class="img-table img-thumbnail" alt="img"/>
                                @endif
                            </td>
                            <td>
                                {{ $item->created_at->format(config('app.date_format')) }}
                            </td>
                            <td class="text-right">
                                <form method="post" action="{{ admin_url('post_categories/'.$item->id ) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ admin_url('post_categories/create?parent_id='.$item->id) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="fa fa-sitemap"></i> {{ trans('nav.add_menu_child') }}
                                    </a>

                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
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
        </div>
    </div>

@endsection
