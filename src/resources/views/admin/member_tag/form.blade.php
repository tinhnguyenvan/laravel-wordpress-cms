@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" enctype="multipart/form-data"
                  action="{{ admin_url('member-tags') }}{{ ($member_tag->id ?? 0) > 0 ?'/'.$member_tag->id: '' }}">
                @csrf
                @if (!empty($member_tag->id))
                    @method('PUT')
                @endif

                <input type="hidden" name="parent_id"
                       value="{{ old('parent_id', ($member_tag->parent_id ?? @request('parent_id', 0))) }}">

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
                            <label for="name" class="col-form-label" for="title">{{ trans('common.title') }}</label>
                            <div class="controls">
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $member_tag->name ?? '') }}"
                                       class="form-control @error('title') is-invalid @enderror"
                                />

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="slug">{{ trans('common.slug') }}</label>
                            <div class="controls">
                                <input type="text" name="slug" id="slug"
                                       value="{{ old('slug', $member_tag->slug ?? '') }}" class="form-control">
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

            @if (!empty($member_tag->id))
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="form-actions text-lg-right">
                            <form method="POST" action="{{ admin_url('member-tags/'.$member_tag->id ) }}">
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
