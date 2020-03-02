<!-- form comment -->
<div class="box-comment" style="border-top: 1px solid #cccccc; padding: 20px 0">
    @include('site.comment.item_comment', ['type' => $type, 'post_id' => $post_id])
    <h3>{{ trans('common.reply') }}</h3>
    <p>{{ trans('common.comment_sub_title') }}</p>

    <form method="post" action="{{ base_url('comment/create') }}">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post_id }}">
        <input type="hidden" name="type" value="{{ $type }}">
        <div class="form-group">
            <label style="color: #000" class="label" for="content">{{ trans('common.form.submit') }} (*)</label>
            <textarea required class="form-control" rows="5" name="content" id="content">{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label style="color: #000" class="label" for="author_email">Email (*)</label>
            <input type="email" class="form-control" autocomplete="off" name="author_email" id="author_email"
                   value="{{ old('author_email') }}">
        </div>

        <div class="form-group">
            <label style="color: #000" class="label" for="author">{{ trans('common.fullname') }} (*)</label>
            <input type="text" class="form-control" autocomplete="off" name="author" id="author"
                   value="{{ old('author') }}">
        </div>

        <div class="form-group">
            <button class="btn btn-primary">
                <i class="fa fa-send"></i>
                {{ trans('common.form.submit') }}
            </button>
        </div>
    </form>
</div>