@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <form method="post" enctype="multipart/form-data"
                  action="{{ admin_url('post_categories') }}{{ ($post_category->id ?? 0) > 0 ?'/'.$post_category->id: '' }}">
                @csrf
                @if (!empty($post_category->id))
                    @method('PUT')
                @endif
                <input type="hidden" name="parent_id"
                       value="{{ old('parent_id', ($post_category->parent_id ?? @request('parent_id', 0))) }}">

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
                            <label class="col-form-label" for="title">{{ trans('post.title') }}</label>
                            <div class="controls">
                                <input type="text"
                                       name="title"
                                       id="title"
                                       value="{{ old('title', $post_category->title ?? '') }}"
                                       class="form-control @error('title') is-invalid @enderror"
                                />

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="slug">{{ trans('post.slug') }}</label>
                            <div class="controls">
                                <input type="text" name="slug" id="slug"
                                       value="{{ old('slug', $post_category->slug ?? '') }}" class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-form-label"
                                   for="description">{{ trans('post.description') }}</label>
                            <div class="controls">
                                <textarea class="form-control" id="description" rows="5"
                                          name="description">{{ old('description', $post_category->description ?? '') }}</textarea>
                            </div>
                        </div>

                        @include('admin.element.form.image', ['name' => 'image_id', 'image_id' => $post_category->image_id ?? '', 'image_url' => $post_category->image_url ?? ''])

                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>
                        </div>
                    </div>
                </div>


                <!-- seo form -->
                @include('admin.element.form_seo', ['info' => $post_category ?? ''])

            </form>

            @if (!empty($post_category->id))
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="form-actions text-lg-right">
                            <form method="post" action="{{ admin_url('post_categories/'.$post_category->id ) }}">
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
