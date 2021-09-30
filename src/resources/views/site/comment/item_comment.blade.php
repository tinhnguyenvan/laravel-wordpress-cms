<!-- load comment -->
@if(!empty($post_id))
    @php
        $comments = \App\Models\Comment::query()->where(['status' => \App\Models\Comment::STATUS_APPROVED, 'post_id'=> $post_id, 'parent' => 0])->orderBy('id', 'desc')->get()->take(100)
    @endphp
    @if($comments->count() > 0)
        <h3 class="box-comment-list-title">{{ $comments->count() }} COMMENT </h3>
        <div class="bs-example" data-example-id="default-media">
            @foreach($comments as $comment)
                <div class="media box-comment-item">
                    <div class="media-body">
                        <div class="box-comment-item-info">
                            <div class="box-comment-item-info-img">
                                @if(!empty($logo))
                                    <img class="media-object" alt="{{ $comment->author }}"
                                         src="{{ $logo }}" />
                                @else
                                    <img class="media-object" alt="{{ $comment->author }}"
                                         src="{{ asset('site/img/gravatar.jpg') }}" />
                                @endif
                            </div>

                            <div class="box-comment-item-info-profile">
                                <h4 class="media-heading">{{ $comment->author }}</h4>
                                <div class="box-comment-info-time">
                                    {{ $comment->created_at->format(config('app.date_format')) }}
                                </div>
                            </div>

                        </div>
                        <div class="box-comment-item-content">
                            {!! $comment->content !!}
                        </div>

                        @if($comment->rating_id > 0 && !empty($comment->rating->rating))
                            <div class="rating">
                                @for($i = 1; $i < 6; $i++)
                                    <span class="fa fa-star" @if($comment->rating->rating >= $i) style="color: #ffc107"
                                          @endif aria-hidden="true"></span>
                                @endfor
                            </div>
                        @endif
                        <div class="box-comment-item-reply-comment">
                            <ul class="form-item-reply-comment">
                                <li>
                                    <div class="icon-reply-comment item-reply-comment text-primary"
                                         id="icon-reply-comment-{{ $comment->id }}" data-value="{{ $comment->id }}">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                        Reply
                                    </div>
                                    <div class="content-reply-comment" id="content-reply-comment-{{ $comment->id }}"
                                         style="display: none">
                                        <div class="row">
                                            <div class="col-lg-1 hidden-xs">
                                                <div class="box-comment-item-info-img">
                                                    @if(!empty($logo))
                                                        <img class="media-object" alt="{{ $comment->author }}"
                                                             src="{{ $logo }}" />
                                                    @else
                                                        <img class="media-object" alt="{{ $comment->author }}"
                                                             src="{{ asset('site/img/gravatar.jpg') }}" />
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-11 col-xs-12">
                                                <script type="text/javascript">
                                                    function onSubmitComment{{$comment->id}}(token) {
                                                        document.getElementById("fc_recaptcha_{{ $comment->id }}").submit();
                                                    }
                                                </script>
                                                <form method="post" id="fc_recaptcha_{{ $comment->id }}"
                                                      action="{{ base_url('comment/create') }}">
                                                    @csrf
                                                    <input type="hidden" name="post_id"
                                                           id="fc_post_id_{{ $comment->id }}"
                                                           value="{{ $post_id }}">
                                                    <input type="hidden" name="type" id="fc_type_{{ $comment->id }}"
                                                           value="{{ $type }}">
                                                    <input type="hidden" name="redirect"
                                                           id="fc_redirect_{{ $comment->id }}"
                                                           value="{{ @request()->url() }}">
                                                    <input type="hidden" name="comment_id"
                                                           id="fc_comment_id_{{ $comment->id }}"
                                                           value="{{ $comment->id }}">

                                                    <label style="display: block; width: 100%">
                                                    <textarea required name="content" rows="2" style="height: 100px"
                                                              class="form-control"
                                                              placeholder="Type content reply">{{ old('content') }}</textarea>
                                                    </label>
                                                    <div class="form-group" style="margin-bottom: 10px">
                                                        <label style="color: #000" class="label"
                                                               for="author_email_{{ $comment->id ?? 0 }}">Email
                                                            (*)</label>
                                                        <input type="email" class="form-control" autocomplete="off"
                                                               name="author_email"
                                                               id="author_email_{{ $comment->id ?? 0 }}"
                                                               value="{{ old('author_email', auth('web')->user()->email ?? '') }}">
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 10px">
                                                        <label style="color: #000" class="label"
                                                               for="author_{{ $comment->id ?? 0 }}">{{ trans('common.fullname') }}
                                                            (*)</label>
                                                        <input type="text" class="form-control form-control-xs"
                                                               autocomplete="off" name="author"
                                                               id="author_{{ $comment->id ?? 0 }}"
                                                               value="{{ old('author', auth('web')->user()->first_name ?? '') }}">
                                                    </div>
                                                    @if(config('services.recaptcha.enable'))
                                                        <button class="g-recaptcha btn btn-sm btn-small btn-primary"
                                                                data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                                                data-callback='onSubmitComment{{$comment->id}}'
                                                                data-action='submit'>
                                                            <i class="fa fa-comment"></i>
                                                            Post comment
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-small btn-primary">
                                                            <i class="fa fa-comment"></i>
                                                            Post comment
                                                        </button>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            {{-- reply comment --}}
                            @include('site.comment.item_comment_reply', ['parent' => $comment->id])
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endif
