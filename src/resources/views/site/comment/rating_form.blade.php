<!-- form comment -->
<div class="box-comment" style="border-top: 1px solid #cccccc; padding: 20px 0">
    <form method="post" action="{{ base_url('comment/create') }}">
        @csrf
        <input type="hidden" name="post_id" id="fc_post_id" value="{{ $post_id }}">
        <input type="hidden" name="type" id="fc_type" value="{{ $type }}">
        <input type="hidden" name="rating" id="fc_rating" value="5">
        <input type="hidden" name="redirect" id="fc_redirect" value="{{ @request()->url() }}">
        <input type="hidden" name="author" id="fc_author" value="{{ old('author', auth('web')->user()->first_name ?? '') }}">
        <input type="hidden" name="author_email" id="fc_email" value="{{ old('author_email', auth('web')->user()->email ?? '') }}">

        <div class="form-group">
            <label style="color: #000" class="label" for="content">Comment (*)</label>
            <input required class="form-control" name="content" id="content" value="{{ old('content') }}">
        </div>

        <div class="form-group">
            <label style="color: #000" class="label" for="content">Rating</label>
            <div class="form-group">
                <button data-value="1" type="button" class="btn-start btn btn-warning btn-sm" aria-label="Left Align">
                    <span class="fa fa-star" aria-hidden="true"></span>
                </button>
                <button data-value="2" type="button" class="btn-start btn btn-warning btn-sm" aria-label="Left Align">
                    <span class="fa fa-star" aria-hidden="true"></span>
                </button>
                <button data-value="3" type="button" class="btn-start btn btn-warning btn-sm" aria-label="Left Align">
                    <span class="fa fa-star" aria-hidden="true"></span>
                </button>
                <button data-value="4" type="button" class="btn-start btn btn-warning btn-sm" aria-label="Left Align">
                    <span class="fa fa-star" aria-hidden="true"></span>
                </button>
                <button data-value="5" type="button" class="btn-start btn btn-warning btn-sm"
                        aria-label="Left Align">
                    <span class="fa fa-star" aria-hidden="true"></span>
                </button>
            </div>
        </div>


        <div class="form-group">
            <button class="btn btn-primary">
                <i class="fa fa-comment"></i>
                Rating
            </button>
        </div>
    </form>
</div>
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