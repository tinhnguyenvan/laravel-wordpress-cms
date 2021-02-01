<!-- form comment -->
<div class="box-comment" style="border-top: 1px solid #cccccc; padding: 20px 0">
    @include('site.comment.item_comment', ['type' => $type, 'post_id' => $post_id])
    <h3>{{ trans('common.reply') }}</h3>
    <p>{{ trans('common.comment_sub_title') }}</p>

    <form method="post" action="{{ base_url('comment/create') }}">
        @csrf
        <input type="hidden" name="post_id" id="fc_post_id" value="{{ $post_id }}">
        <input type="hidden" name="type" id="fc_type" value="{{ $type }}">
        <input type="hidden" name="rating" id="fc_rating" value="5">
        <input type="hidden" name="redirect" id="fc_redirect" value="{{ @request()->url() }}">

        <div class="form-group">
            <label style="color: #000" class="label" for="content">{{ trans('common.form.submit') }} (*)</label>
            <textarea required class="form-control" rows="5" name="content" id="content">{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label style="color: #000" class="label" for="author_email">Email (*)</label>
            <input type="email" class="form-control" autocomplete="off" name="author_email" id="author_email"
                   value="{{ old('author_email', auth('web')->user()->email ?? '') }}">
        </div>

        <div class="form-group">
            <label style="color: #000" class="label" for="author">{{ trans('common.fullname') }} (*)</label>
            <input type="text" class="form-control" autocomplete="off" name="author" id="author"
                   value="{{ old('author', auth('web')->user()->first_name ?? '') }}">
        </div>

        @if(!empty($showRaiting))
            <div class="form-group text-right"
        @endif

        <div class="form-group" style="margin-top: 10px">
            <button class="btn btn-primary">
                <i class="fa fa-comment"></i>
                {{ trans('common.form.submit') }}
            </button>
        </div>
    </form>
</div>
@if(!empty($showRaiting))
<script type="text/javascript">
    $(document).ready(function () {
        $('.btn-start').on('click', function () {
            let value = $(this).attr('data-value');
            $('#fc_rating').val(value);
            $('.btn-start').each(function (key, item) {
                if (key < value) {
                    $(item).addClass('btn-warning').removeClass('btn-grey');
                } else {
                    $(item).removeClass('btn-warning').addClass('btn-grey');
                }
            });
        });
    });
</script>
@endif