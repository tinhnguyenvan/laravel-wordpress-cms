@extends('layout.default.layouts.app')
@section('content')
    <article id="content" class="container">
        <div class="main-breadcrumb">
            <ol class="breadcrumb mt15">
                <li>
                    <a href="{{ base_url()}}">{{ trans('common.home') }}</a>
                </li>
                <li class="active hidden-xs">{{ $title }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="page-tags">
                @if (!empty($itemPosts))
                    <ul>
                        @foreach ($itemPosts as $item)
                            <li>
                                <h3 class="blog-name">
                                    <a href="{{ \App\Models\Post::link($item) }}">{{ $item->title }}</a>
                                </h3>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </article>
@endsection
