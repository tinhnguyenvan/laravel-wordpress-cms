@extends('admin.layout.app')
@section('content')
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            @foreach($language_content as $lang => $textLanguage)
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{ $textLanguage }}</a>
            @endforeach
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <form method="post" class="submit" enctype="multipart/form-data"
                  action="{{ admin_url('posts') }}{{ ($post->id ?? 0) > 0 ?'/'.$post->id: '' }}">
                @csrf
                @if (!empty($post->id))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-lg-8">
                        @include('admin.element.form.input-multi-lang', ['name' => 'title', 'text' => trans('post.title'), 'value' => $post ?? '', 'is_multi_lang' => true])
                        @include('admin.element.form.textarea-multi-lang', ['name' => 'summary', 'text' => trans('post.summary'), 'value' => $post ?? ''])
                        @include('admin.element.form.textarea-multi-lang', ['name' => 'detail', 'class' => 'ckeditor', 'text' => trans('post.detail'), 'value' => $post ?? ''])
                        @include('admin.element.form_seo', ['info' => $post ?? ''])
                    </div>

                    <div class="col-lg-4">

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
            </form>

            @if (!empty($post->id))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-actions">
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
@endsection
