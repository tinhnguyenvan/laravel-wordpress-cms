@extends('admin.layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }}
        </div>
        <div class="card-body">
            @include('admin.element.filter')

            <form method="post" action="{{ admin_url('contacts/destroy-multi') }}">
                @csrf
                @method('DELETE')
                <table class="table table-responsive-sm table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" width="50">
                            <input type="checkbox" name="check_all" id="check_all" value="1">
                        </th>
                        <th>{{ trans('contact.fullname') }}</th>
                        <th>{{ trans('contact.phone') }}</th>
                        <th>{{ trans('contact.email') }}</th>
                        <th class="th-created_at">{{ trans('contact.created_at') }}</th>
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
                                    <a href="{{ admin_url('contacts/'.$item->id.'') }}">
                                        {{ $item->fullname }}
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    {{ $item->created_at->format('d/m/Y H:s') }}
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
                        <td colspan="6">
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
