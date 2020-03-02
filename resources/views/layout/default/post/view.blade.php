@extends('layout.default.layouts.app')
@section('content')
    <article id="content" class="container">
        <div class="main-breadcrumb">
            <ol class="breadcrumb mt15">
                <li>
                    <a href="{{ base_url()}}">{{ trans('common.home') }}</a>
                </li>
                <li class="active hidden-xs">{{ $post->title }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="detail-view">
                    <h1 class="article-heading">{{ $post->title }}</h1>
                </div>
                <div class="page-content">
                    {!! $post->detail !!}

                </div>
                <!-- comment -->
                @include('site.comment.generate_form', ['type' => \App\Models\Comment::TYPE_POST, 'post_id' => $post->id])
            </div>
        </div>
    </article>
@endsection
