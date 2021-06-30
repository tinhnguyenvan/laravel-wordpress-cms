<!-- form comment -->
<div class="box-comment" id="box-comment">
    <form method="post" class="recaptcha" action="{{ base_url('comment/create') }}">
        @csrf
        <input type="hidden" name="post_id" id="fc_post_id" value="{{ $post_id }}">
        <input type="hidden" name="type" id="fc_type" value="{{ $type }}">
        @if(!empty($showRaiting))
            <input type="hidden" name="rating" id="fc_rating" value="5">
        @endif
        <input type="hidden" name="redirect" id="fc_redirect" value="{{ @request()->url() }}#box-comment">

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

        <div class="form-group" style="margin-top: 10px">
            @if(config('services.recaptcha.enable'))
                <button class="g-recaptcha btn btn-primary"
                        data-sitekey="{{ config('services.recaptcha.site_key') }}"
                        data-callback='onSubmit'
                        data-action='submit'>
                    <i class="fa fa-comment"></i>
                    Post comment
                </button>
            @else
                <button class="btn btn-primary">
                    <i class="fa fa-comment"></i>
                    Post comment
                </button>
            @endif
        </div>

        <div class="text-danger">
            <ul>
                @if ($errors->count() > 0)
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                @else
                    @if(!empty($error))
                        @if(is_array($error))
                            @foreach($error as $er)
                                <li>{{ e($er) }}</li>
                            @endforeach
                        @else
                            <li>{{ e($error) }}</li>
                        @endif
                    @endif
                @endif
            </ul>
        </div>
    </form>
</div>

<div class="box-comment-list">
    @include('site.comment.item_comment', ['type' => $type, 'post_id' => $post_id, 'reply' => $reply ?? 0])
</div>
@if(!empty($showRaiting))
    <script type="text/javascript">
        window.addEventListener("DOMContentLoaded", function () {
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

<script type="text/javascript">
    window.addEventListener("DOMContentLoaded", function () {

        // show form comment
        $('.item-reply-comment').on('click', function () {
            let idReply = $(this).attr('data-value');
            $('#content-reply-comment-' + idReply).show();
        })

        // reply comment
        $('.icon-reply-comment').on('click', function () {
            let id_comment = $(this).attr('data-value');
            $('#content-reply-comment-' + id_comment).slideDown();
        })
    });
</script>

<style>
    .box-comment {
        border-top: 1px solid #cccccc;
        padding: 20px 0;
        margin-top: 50px;
    }

    .box-comment input {
        text-transform: none;
    }

    .box-comment-list-title {
        border-bottom: 2px solid #00B38F;
        color: #555555;
        padding: 5px 15px 3px 5px;
        font-weight: 600;
        margin-bottom: 5px;
        font-size: 14px;
        letter-spacing: 1px;
        text-transform: uppercase;
        text-align: left;
        line-height: 24px;
    }

    .box-comment-item {
        margin: 20px 10px;
        border-bottom: 1px dashed #ccc;
        padding-bottom: 10px;
    }

    .box-comment-item-info {

    }

    .box-comment-item-info-img {
        width: 48px;
        height: 48px;
    }

    .box-comment-item-info-img img {
        width: 100%;
    }

    .box-comment-item-info-img, .box-comment-item-info-profile {
        float: left;
        margin-bottom: 10px;
    }

    .box-comment-item-info-profile {
        margin-left: 10px;
    }

    .box-comment-item-info-profile h4 {
        color: #00B38F;
        font-size: 15px;
    }

    .box-comment-item-info-profile .box-comment-info-time {
        padding: 0 10px 0 0;
        font-size: 12px;
    }

    .box-comment-item-content {
        clear: both;
        margin: 8px 0 5px 0;
        color: #777777;
        font-size: 15px;
        padding: 0 0 8px 0;
        word-break: break-word;
    }

    .box-comment-item-reply-comment {
    }

    .box-comment-item-reply-comment .icon-reply-comment {
        margin-bottom: 15px;
        cursor: pointer;
    }

    .box-comment-item-reply-comment-body {
        margin-top: 10px;
        margin-bottom: 10px;
        background: #fafafa;
        padding: 10px 20px;
        margin-left: 30px;
        border-left: 4px solid #0fba98;
    }

    .form-item-reply-comment li,
    .box-comment-item-reply-comment-body li {
        list-style: none;
    }

    .box-comment-item-reply-comment-body li {
        border-bottom: 1px dashed #ccc;
    }

    .box-comment-item:last-child,
    .box-comment-item-reply-comment-body li:last-child {
        border-bottom: 0;
    }
</style>