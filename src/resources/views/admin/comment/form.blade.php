@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
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
                    <form method="post"
                          action="{{ admin_url('comments') }}{{ ($comment->id ?? 0) > 0 ?'/'.$comment->id: '' }}">
                        @csrf
                        @if (!empty($comment->id))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label class="col-form-label" for="post_id">{{ trans('comment.post_id') }}</label>
                            <div class="controls">
                                <input type="number" name="post_id" id="post_id"
                                       value="{{ old('post_id', $comment->post_id ?? '') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="author">{{ trans('comment.author') }}</label>
                            <div class="controls">
                                <input type="text" name="author" id="author"
                                       value="{{ old('author', $comment->author ?? '') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="author_email">{{ trans('comment.author_email') }}</label>
                            <div class="controls">
                                <input type="email" name="author_email" id="author_email"
                                       value="{{ old('author_email', $comment->author_email ?? '') }}"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="description">{{ trans('comment.content') }}</label>
                            <div class="controls">
                                <textarea class="form-control" id="description" rows="5"
                                          name="content">{{ old('content', $comment->content ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>
                        </div>
                    </form>
                </div>

                @if (!empty($comment->id))
                    <div class="card-footer">
                        <div class="form-actions text-lg-left">
                            <form style="display: inline-block"
                                  action="{{ admin_url('comments/status/'.$comment->id) }}" method="post">
                                @csrf
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-default dropdown-toggle text-{{ $comment->status_color }}"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $comment->status_text }}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach(\App\Models\Comment::STATUS_LIST as $item)
                                            @if($comment->status == $item)
                                                @continue;
                                            @endif
                                            <li>
                                                <button name="status" class="li-sale_order_status" value="{{ $item }}">
                                                    {{ trans('comment.status.'.$item) }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </form>

                            <form style="display: inline-block" method="post" action="{{ admin_url('comments/'.$comment->id ) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash"></i>
                                    {{ trans('common.trash') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
@endsection
