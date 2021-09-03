@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <form method="post" enctype="multipart/form-data"
                  action="{{ admin_url('posts') }}{{ ($post->id ?? 0) > 0 ?'/'.$post->id: '' }}">
                @csrf
                @if (!empty($post->id))
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
                        @include('admin.element.form.input-multi-lang', ['name' => 'title', 'text' => trans('post.title'), 'value' => $post ?? '', 'is_multi_lang' => true])

                        <div class="form-group">
                            <label class="col-form-label required" for="title">{{ trans('post.category_id') }}</label>
                            <div class="controls">
                                @include('admin.element.form.select', ['name' => 'category_id', 'data' => $dropdownCategory, 'selected' => old('category_id', ($post->category_id ?? 0))])
                            </div>
                            @if(empty($dropdownCategory))
                                <a target="_blank" href="{{ admin_url('post_categories/create') }}"><i
                                            class="fa fa-plus"></i> Add category</a>
                            @endif
                        </div>

                        @include('admin.element.form.textarea-multi-lang', ['name' => 'summary', 'text' => trans('post.summary'), 'value' => $post ?? ''])
                        @include('admin.element.form.textarea-multi-lang', ['name' => 'detail', 'class' => 'ckeditor', 'text' => trans('post.detail'), 'value' => $post ?? ''])

                        @include('admin.element.form.image', ['name' => 'image_id', 'image_id' => $post->image_id ?? '', 'image_url' => $post->image_url ?? ''])
                        @include('admin.element.form.tags', ['name' => 'tags', 'text' => trans('common.tags'), 'value' => $post->tags ?? ''])

                        @include('admin.element.form.check', ['name' => 'is_hot', 'text' => trans('post.is_hot'), 'value' => $post->is_hot ?? 0])

                        <div class="form-group">
                            <label class="col-form-label" for="status">{{ trans('post.status') }}</label>
                            <div class="controls">
                                @include('admin.element.form.radio', ['name' => 'status', 'text' => trans('post.status.active'), 'valueDefault' => \App\Models\Post::STATUS_ACTIVE, 'value' => $post->status ?? 1])
                                @include('admin.element.form.radio', ['name' => 'status', 'text' => trans('post.status.disable'), 'valueDefault' => \App\Models\Post::STATUS_DISABLE, 'value' => $post->status ?? 0])
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-success" type="submit" name="submit" value="0">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>

                            <button class="btn btn-default" type="submit" name="submit" value="1">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save_close') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- seo form -->
                @include('admin.element.form_seo', ['info' => $post ?? ''])

            </form>

            @if (!empty($post->id))
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="form-actions text-lg-right">
                            <form method="post" onsubmit="return confirm('Do you want DELETE ?');"
                                  action="{{ admin_url('posts/'.$post->id ) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ $post->link }}" target="_blank" class="btn btn-info">
                                    <i class="fa fa-globe"></i> Link preview
                                </a>

                                <a href="{{ admin_url('comments/create?post_id='.$post->id) }}" target="_blank"
                                   class="btn btn-success">
                                    <i class="fa fa-comment-o"></i> Create comment
                                </a>

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
