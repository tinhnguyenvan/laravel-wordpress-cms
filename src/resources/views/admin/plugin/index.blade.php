@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }}
        </div>
        <div class="card-body">
            <table class="table table-responsive-sm table-bordered table-hover">
                <thead>
                <tr class="bg-light">
                    <th>CODE</th>
                    <th class="text-center">VERSION</th>
                    <th class="text-center">UPDATES ENABLED</th>
                    <th class="text-center">PLUGIN ENABLED</th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->code }}</td>
                            <td class="text-center">{{ $item->version }}</td>
                            <td class="text-center">
                                @include('admin.element.form.check', ['name' => 'status', 'value' => $item->status ?? 0])
                            </td>
                            <td class="text-center">{{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
