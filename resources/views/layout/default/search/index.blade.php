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
        <div class="page-search">
            @if ($itemPosts->count() > 0)
                <ul>
                    @foreach ($itemPosts as $item)
                        <li class="blog-item">
                            <h3 class="blog-name">
                                <a href="{{ \App\Models\Post::link($item) }}">{{ $item->title }}</a>
                            </h3>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if ($itemProducts->count() > 0)
                <ul>
                    @foreach ($itemProducts as $item)
                        <li class="col-md-3 col-sm-4 col-xs-12 no-padding">
                            @include('layout.default.product.item', compact('item'))
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </article>
@endsection
