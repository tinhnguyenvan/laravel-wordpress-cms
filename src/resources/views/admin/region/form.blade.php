@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <form method="POST" enctype="multipart/form-data"
                  action="{{ admin_url('regions') }}{{ ($region->id ?? 0) > 0 ?'/'.$region->id: '' }}">
                @csrf
                @if (!empty($region->id))
                    @method('PUT')
                @endif

                <input type="hidden" name="parent_id"
                       value="{{ old('parent_id', ($region->parent_id ?? @request('parent_id', 0))) }}">

                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-edit"></i> {{ trans('common.form') }}
                        <div class="card-header-actions">
                            <a class="btn btn-minimize" href="#" data-toggle="collapse" data-target="#collapseExample"
                               aria-expanded="true">
                                <i class="icon-arrow-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body collapse show" id="collapseExample">
                        <div class="form-group">
                            <label class="col-form-label" for="title">{{ trans('common.name') }}</label>
                            <div class="controls">
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $region->name ?? '') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                />

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="code">{{ trans('common.slug') }}</label>
                            <div class="controls">
                                <input type="text" name="code" id="code"
                                       value="{{ old('code', $region->code ?? '') }}" class="form-control">
                            </div>
                        </div>

                        @include('admin.element.form.input', ['name' => 'order_by', 'text' => trans('common.order_by'), 'value' => $region->order_by ?? ''])

                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            @if (!empty($region->id))
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="form-actions text-lg-right">
                            <form method="POST" onsubmit="return confirm('Do you want DELETE ?');" action="{{ admin_url('regions/'.$region->id ) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash"></i>
                                    {{ trans('common.trash') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
