@extends('admin.layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }}
        </div>
        <div class="card-body">
            @include('admin.element.filter')

            <form method="post" action="{{ admin_url('medias/destroy-multi') }}">
                @csrf
                @method('DELETE')
                <table class="table table-responsive-sm table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" width="50">
                            <input type="checkbox" name="check_all" id="check_all" value="1">
                        </th>
                        <th>
                            <a href="">
                                {{ trans('media.name') }}
                            </a>
                        </th>

                        <th>{{ trans('media.size') }}</th>
                        <th class="w-100px">{{ trans('media.image') }}</th>
                        <th>{{ trans('media.created_at') }}</th>
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
                                <td>{{ number_format($item->size/1024, 2) }} KB</td>
                                <td class="text-center">
                                    @if($item->file_name)
                                        <img src="{{ asset('storage'.$item->file_name) }}"
                                             class="img-table img-thumbnail"/>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at->format('d/m/Y H:s') }}
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
                        <td colspan="5">
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
