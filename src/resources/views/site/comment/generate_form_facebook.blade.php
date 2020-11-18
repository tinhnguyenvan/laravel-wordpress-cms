<!-- form comment -->
<div class="box-comment-facebook" style="border-top: 1px solid #cccccc;">
    @if(!empty(auth(\App\Models\RolePermission::GUARD_NAME_WEB)->id()))
        <form method="post" action="{{ base_url('comment/create') }}">
            @csrf
            <input type="hidden" name="post_id" id="fc_post_id" value="{{ $post_id }}">
            <input type="hidden" name="type" id="fc_type" value="{{ $type }}">
            <input type="hidden" name="rating" id="fc_rating" value="5">
            <input type="hidden" name="redirect" id="fc_redirect" value="{{ @request()->url() }}">
            <input type="hidden" name="author" id="fc_author"
                   value="{{ old('author', auth('web')->user()->first_name ?? '') }}">
            <input type="hidden" name="author_email" id="fc_email"
                   value="{{ old('author_email', auth('web')->user()->email ?? '') }}">

            <div class="form-group">
                <label for="content"></label>
                <input required class="form-control-comment-facebook" name="content" id="content"
                       value="{{ old('content') }}"
                       placeholder="What's status do you want to update ?"/>
            </div>
        </form>
    @else
        <div class="alert alert-info">
            Please <a href="{{ base_url('member/login') }}">login</a> post status.
        </div>
    @endif

<!-- load comment -->
    @if(!empty($post_id))
        @php
            $comments = \App\Models\Comment::query()->where(['status' => \App\Models\Comment::STATUS_APPROVED, 'post_id'=> $post_id])->orderBy('id', 'desc')->get()->take(100)
        @endphp
        @if($comments->count() > 0)
            <hr/>
            <div class="bs-example" data-example-id="default-media">
                @foreach($comments as $comment)
                    <div class="media" style="margin-bottom: 10px;">

                        <div class="media-body">
                            <div class="chip">
                                <img src="{{ asset('site/img/gravatar.jpg') }}" alt="{{ $comment->author }}">
                                {{ !empty($comment->author) ? $comment->author : 'No Name' }}
                            </div>
                            {!!nl2br(str_replace(" ", " &nbsp;", $comment->content))!!}
                        </div>
                    </div>
                    <hr/>
                @endforeach
            </div>
        @endif
    @endif

</div>
