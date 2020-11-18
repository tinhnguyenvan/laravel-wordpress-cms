@extends('site.layout.member')
@section('content')
    <div class="content-panel">
        <ol class="breadcrumb">
            <li><a href="{{ base_url() }}"><i class="fa fa-home"></i> {{ trans('common.home') }}</a></li>
            <li class="active">{{ $title }}</li>
        </ol>
        coming soon
    </div>
@endsection