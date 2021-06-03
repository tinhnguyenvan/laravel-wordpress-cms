<!-- load comment -->
@if(!empty($parent))
    @php
        $comments = \App\Models\Comment::query()->where(['status' => \App\Models\Comment::STATUS_APPROVED, 'parent' => $parent])->orderBy('id', 'desc')->get()->take(100)
    @endphp
    @if($comments->count() > 0)
        <ul class="box-comment-item-reply-comment-body">
            @foreach($comments as $comment)
                <li class="media">
                    <div class="box-comment-item-info">
                        <div class="box-comment-item-info-img">
                            <img class="media-object" alt="{{ $comment->author }}"
                                 src="{{ asset('site/img/gravatar.jpg') }}">
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
                </li>
            @endforeach
        </ul>
    @endif
@endif
