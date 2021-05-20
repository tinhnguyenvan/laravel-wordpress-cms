@extends('admin.layout.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->count() }})
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
                                <div class="form-group">
                                    <div class="controls">
                                        <form method="post"
                                              action="{{ admin_url('plugins/'.$item->id.'/update-status' ) }}">
                                            @csrf
                                            @method('PUT')
                                            <label class="switch switch-label switch-pill switch-outline-primary-alt">
                                                <input type="hidden" value="{{ $item->id }}" name="id">
                                                <input onchange="this.form.submit()" type="checkbox" id="status"
                                                       name="status"
                                                       class="switch-input" {{ !empty($item->status) && ($item->status == 'on' || $item->status == 1) ? 'checked': '' }}>
                                                <span class="switch-slider" data-checked="&#x2713;"
                                                      data-unchecked="&#x2715;"></span>
                                            </label>
                                        </form>
                                    </div>
                                </div>
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
