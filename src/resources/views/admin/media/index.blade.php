@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->total() }})

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('medias/create') }}">
                    <small>
                        <i class="fa fa-upload"></i>
                        {{ trans('common.btn.upload') }}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.element.filter')
            <form method="post" action="{{ admin_url('medias/destroy-multi') }}">
                @csrf
                @method('DELETE')
                <table class="table table-responsive-sm table-bordered table-hover font12">
                    <thead>
                    <tr class="bg-light">
                        <th class="text-center w50">
                            <input type="checkbox" name="check_all" id="check_all" value="1">
                        </th>
                        <th>{{ trans('media.name') }}</th>
                        <th>{{ trans('media.object_type') }}</th>
                        <th>{{ trans('media.size') }}</th>
                        <th class="w-100px">{{ trans('media.image') }}</th>
                        <th class="w-150px">{{ trans('media.created_at') }}</th>
                        <th class="w-100px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($items->count() > 0)
                        @foreach ($items as $item)
                            <tr>
                                <td class="text-center">
                                    <input class="check_id" type="checkbox" name="ids[]" value="{{ $item->id }}">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->object_type_name }}</td>
                                <td>{{ number_format($item->size/1024, 2) }} KB</td>
                                <td class="text-center">
                                    @if($item->file_name)
                                        <img src="{{ asset('storage'.$item->file_name) }}"
                                             class="img-table img-thumbnail"/>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-xs btn-sm" target="_blank" download href="{{ asset('storage'.$item->file_name) }}">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    <button type="button"
                                            class="clipboard cursor-pointer btn btn-sm btn-default"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Click copy url {{ $item->name }}"
                                            data-clipboard-text="{{ asset('storage'.$item->file_name) }}">
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
