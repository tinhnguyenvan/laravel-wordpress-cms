@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->total() }})
        </div>
        <div class="card-body">
            <form method="post" action="{{ admin_url('cache-systems/destroy-multi') }}">
                @csrf
                @method('DELETE')

            <table class="table table-responsive-sm table-bordered table-hover font12">
                <thead>
                <tr class="bg-light">
                    <th class="text-center w50">
                        <input type="checkbox" name="check_all" id="check_all" value="1">
                    </th>
                    <th>Key</th>
                    <th class="text-center w-150px">Size</th>
                    <th class="text-center w-150px">Expired</th>
                </tr>
                </thead>
                <tbody>

                @if (!empty($items))
                    @foreach ($items as $item)
                        <tr>
                            <td class="text-center">
                                <label>
                                    <input class="check_id" type="checkbox" name="key[]" value="{{ $item->key }}"/>
                                </label>
                            </td>
                            <td>{{ $item->key }}</td>
                            <td class="text-center">{{ \Illuminate\Support\Str::length($item->key) }} (bytes)</td>
                            <td class="text-center">{{ date('d/m/Y H:i', $item->expiration) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">
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
