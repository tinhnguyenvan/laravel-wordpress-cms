@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->count() }})

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('languages/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-responsive-sm table-bordered table-hover font12">
                <thead>
                <tr class="bg-light">
                    <th>Name</th>
                    <th>Code</th>
                    <th class="text-center">Update at</th>
                    <th class="w-200px">Status</th>
                    <th class="w-200px"></th>
                </tr>
                </thead>
                <tbody>

                @if (!empty($items))
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <a href="{{ admin_url('languages/'.$item->id.'/edit') }}">
                                    {{ $item->name }}
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                {{ $item->code }}
                                @if($item->is_default == 1)
                                    <label class="label label-primary">Default</label>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $item->created_at->format(config('app.date_format')) }}
                            </td>
                            <td class="text-center">
                                @if($item->status == 1)
                                    <label class="label label-primary">Public</label>
                                @else
                                    <label class="label label-default">Private</label>
                                @endif
                            </td>
                            <td class="text-center w-100px">
                                @if($items->count() > 1)
                                    <form method="post" onsubmit="return confirm('Do you want DELETE ?');"
                                          action="{{ admin_url('languages/'.$item->id ) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
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
        </div>
    </div>

@endsection
