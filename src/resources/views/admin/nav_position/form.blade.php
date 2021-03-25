@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <form method="POST"
                  action="{{ admin_url('nav_positions') }}{{ ($nav_position->id ?? 0) > 0 ?'/'.$nav_position->id: '' }}">
                <input type="hidden" name="theme" value="{{ $theme }}">
                @csrf
                @if (!empty($nav_position->id))
                    @method('PUT')
                @endif

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
                            <label class="col-form-label" for="title">{{ trans('nav.title') }}</label>
                            <div class="controls">
                                <input type="text"
                                       name="title"
                                       id="title"
                                       value="{{ old('title', $nav_position->title ?? '') }}"
                                       class="form-control @error('title') is-invalid @enderror"
                                />

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="slug">{{ trans('nav.slug') }}</label>
                            <div class="controls">
                                <input type="text" name="slug" id="slug"
                                       value="{{ old('slug', $nav_position->slug ?? '') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            @if (!empty($nav_position->id))
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="form-actions text-lg-right">
                            <form method="POST" onsubmit="return confirm('Do you want DELETE ?');" action="{{ admin_url('nav_positions/'.$nav_position->id ) }}">
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
