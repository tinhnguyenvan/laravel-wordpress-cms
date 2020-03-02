@extends('layout.default.layouts.app')
@section('content')
    <article id="content" class="container">
        <div class="main-breadcrumb">
            <ol class="breadcrumb mt15">
                <li>
                    <a href="{{ base_url()}}">{{ trans('common.home') }}</a>
                </li>
                <li class="active hidden-xs">{{ $postCategory->title }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="blog-article clearfix page-content">
                    @if (!empty($items))
                        @foreach ($items as $item)
                            <div class="blog-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ \App\Models\Post::link($item) }}">
                                            @if($item->image_url)
                                                <img src="{{ asset('storage'.$item->image_url) }}"
                                                     alt="{{ $item->title }}" title="{{ $item->title }}"
                                                     class="img-responsive"/>
                                            @else
                                                <img src="{{ asset('layout/default/img/empty_box.png') }}"
                                                     alt="{{ $item->title }}" class="img-responsive">
                                            @endif

                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <h3 class="blog-name">
                                            <a href="{{ \App\Models\Post::link($item) }}">{{ $item->title }}</a>
                                        </h3>
                                        <p class="blog-info"> {{ $item->created_at->format('d/m/Y H:s') }}</p>
                                        <p class="blog-description">
                                            {!!nl2br(str_replace(" ", " &nbsp;", $item->summary))!!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="colletion-topbar">
                    <div class="pull-right">
                        {{ !empty($items) ? $items->links() : '' }}
                    </div>
                </div>
            </div>

        </div>
    </article>
@endsection
