<!-- load comment -->
@if(!empty($parent))
    @php
        $comments = \App\Models\Comment::query()->where(['status' => \App\Models\Comment::STATUS_APPROVED, 'parent' => $parent])->orderBy('id', 'desc')->get()->take(100)
    @endphp
    @if($comments->count() > 0)
        <ul class="item-reply-comment">
            @foreach($comments as $comment)
                <li class="media" style="margin-bottom: 10px;">
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
                    </div>
                </li>
                <li style="margin: 10px 0; border-top: 1px solid #ccc"></li>

            @endforeach
        </ul>
    @endif
@endif
