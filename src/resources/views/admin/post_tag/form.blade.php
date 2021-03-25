@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <form method="post"
                  action="{{ admin_url('post_tags') }}{{ ($post_tag->id ?? 0) > 0 ?'/'.$post_tag->id: '' }}">
                @csrf
                @if (!empty($post_tag->id))
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
                            <label class="col-form-label" for="title">{{ trans('post.title') }}</label>
                            <div class="controls">
                                <input type="text"
                                       name="title"
                                       id="title"
                                       value="{{ old('title', $post_tag->title ?? '') }}"
                                       class="form-control @error('title') is-invalid @enderror"
                                />

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="slug">{{ trans('post.slug') }}</label>
                            <div class="controls">
                                <input type="text" name="slug" id="slug"
                                       value="{{ old('slug', $post_tag->slug ?? '') }}" class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-form-label" for="description">{{ trans('post.description') }}</label>
                            <div class="controls">
                                <textarea class="form-control" id="description" rows="5"
                                          name="description">{{ old('description', $post_tag->description ?? '') }}</textarea>
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


                <!-- seo form -->
                @include('admin.element.form_seo', ['info' => $post_tag ?? ''])

            </form>

            @if (!empty($post_tag->id))
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="form-actions text-lg-right">
                            <form method="post" onsubmit="return confirm('Do you want DELETE ?');" action="{{ admin_url('post_tags/'.$post_tag->id ) }}">
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
