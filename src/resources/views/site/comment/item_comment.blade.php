<!-- load comment -->
@if(!empty($post_id))
    @php
        $comments = \App\Models\Comment::query()->where(['status' => \App\Models\Comment::STATUS_APPROVED, 'post_id'=> $post_id, 'parent' => 0])->orderBy('id', 'desc')->get()->take(100)
    @endphp
    @if($comments->count() > 0)
        <h3>{{ trans('common.comment') }}</h3>
        <hr style="height: 1px; border-top: 1px solid #ccc"/>
        <div class="bs-example" data-example-id="default-media">
            @foreach($comments as $comment)
                <div class="media" style="margin-bottom: 10px;">
                    <div class="media-left" style="margin-right: 15px">
                        <a href="#">
                            <img class="media-object" data-src="holder.js/64x64" alt="64x64"
                                 src="{{ asset('site/img/gravatar.jpg') }}"
                                 data-holder-rendered="true" style="width: 64px; height: 64px;">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $comment->author }}</h4>
                        @if($type == \App\Models\Comment::TYPE_SCHOOL)
                            {!! $comment->content !!}
                        @else
                            {!!nl2br(str_replace(" ", " &nbsp;", $comment->content))!!}
                        @endif

                        @if($comment->rating_id > 0 && !empty($comment->rating->rating))
                            <div class="rating">
                                @for($i = 1; $i < 6; $i++)
                                    <span class="fa fa-star" @if($comment->rating->rating >= $i) style="color: #ffc107"
                                          @endif aria-hidden="true"></span>
                                @endfor
                            </div>
                        @endif

                        <hr style="height: 1px; border-top: 1px solid #ccc"/>
                        <div class="reply-comment">
                            @include('site.comment.item_comment_reply', ['parent' => $comment->id])
                            <ul class="form-item-reply-comment" style="list-style: none">
                                <li>
                                    <div style="cursor: pointer" class="icon-reply-comment text-primary"
                                         id="icon-reply-comment-{{ $comment->id }}" data-value="{{ $comment->id }}">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                        Reply
                                    </div>
                                    <div class="content-reply-comment" id="content-reply-comment-{{ $comment->id }}"
                                         style="display: none">
                                        <form method="post" action="{{ base_url('comment/create') }}">
                                            @csrf
                                            <input type="hidden" name="author_email" id="fc_author_email" value="{{ auth('web')->user()->email ?? '' }}">
                                            <input type="hidden" name="post_id" id="fc_post_id" value="{{ $post_id }}">
                                            <input type="hidden" name="type" id="fc_type" value="{{ $type }}">
                                            <input type="hidden" name="redirect" id="fc_redirect"
                                                   value="{{ @request()->url() }}">
                                            <input type="hidden" name="comment_id" id="fc_comment_id"
                                                   value="{{ $comment->id }}">
                                            <label style="display: block; width: 100%">
                                                <input type="text" required name="content" class="form-control"
                                                       placeholder="Type content reply">
                                            </label>

                                            <button type="submit" class="btn btn-sm btn-small btn-primary">
                                                <i class="fa fa-comment"></i>
                                                {{ trans('common.form.submit') }}
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            </ul>

                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('.icon-reply-comment').on('click', function () {
                                        let id_comment = $(this).attr('data-value');
                                        $('#content-reply-comment-' + id_comment).slideDown();
                                    })
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endif
