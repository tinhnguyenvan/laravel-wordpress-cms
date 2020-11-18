@extends('admin.layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }}

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('products/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.element.filter')
            <form method="post" action="{{ admin_url('products/destroy-multi') }}">
                @csrf
                @method('DELETE')
                <table class="table table-responsive-sm table-bordered table-hover font12">
                    <thead>
                    <tr class="bg-light">
                        <th class="text-center w50">
                            <input type="checkbox" name="check_all" id="check_all" value="1">
                        </th>
                        <th>{{ trans('product.sku') }}</th>
                        <th>
                            <a href="">
                                {{ trans('product.title') }}
                            </a>
                        </th>

                        <th class="th-category_id">{{ trans('product.category_id') }}</th>
                        <th>{{ trans('product.price') }}</th>
                        <th>{{ trans('product.created_at') }}</th>
                        <th>{{ trans('product.image_url') }}</th>
                        <th class="th-status text-center">{{ trans('product.status') }}</th>
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
                                    {{ $item->sku }}
                                </td>
                                <td>
                                    <a href="{{ admin_url('products/'.$item->id.'/edit') }}">
                                        {{ $item->title }}
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    {{ !empty($item->category->title) ?  $item->category->title : '--' }}
                                </td>
                                <td data-price="{{ $item->price }}">
                                    {{ $item->price_format }}
                                </td>
                                <td>
                                    {{ $item->created_at->format(config('app.date_format')) }}
                                </td>
                                <td class="text-center">
                                    @if($item->image_url)
                                        <img src="{{ asset('storage'.$item->image_url) }}"
                                             class="img-table img-thumbnail"/>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ $item->link }}" target="_blank" class="btn btn-info btn-sm">
                                        <i class="fa fa-globe"></i>
                                    </a>

                                    <a class="btn btn-{{ $item->status_color }} btn-sm text-white">
                                        <i class="fa fa-check-circle-o"></i>
                                        {{ $item->status_text }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">
                                {{ trans('common.data_empty') }}
                            </td>
                        </tr>
                    @endif
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="8">
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
