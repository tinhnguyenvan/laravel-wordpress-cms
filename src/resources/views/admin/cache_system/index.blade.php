@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->total() }})
        </div>
        <div class="card-body">
            <table class="table table-responsive-sm table-bordered table-hover font12">
                <thead>
                <tr class="bg-light">
                    <th>Key</th>
                    <th class="text-center w-150px">Size</th>
                    <th class="text-center w-150px">Expired</th>
                    <th class="w-100px"></th>
                </tr>
                </thead>
                <tbody>

                @if (!empty($items))
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->key }}</td>
                            <td class="text-center">{{ \Illuminate\Support\Str::length($item->key) }} (bytes)</td>
                            <td class="text-center">{{ date('d/m/Y H:i', $item->expiration) }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Do you want DELETE [{{$item->key}}]?');"
                                      action="{{ admin_url('cache-systems/'.$item->key) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
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
            </table>

            @include('admin.element.pagination')
        </div>
    </div>

@endsection
