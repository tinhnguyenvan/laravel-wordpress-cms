@extends('site.layout.member')
@section('content')
    <div class="">
        <h4>{{ $notification->subject->title }}</h4>
        <hr/>
        <div class="lead">{!!  $notification->subject->content ?? '--'  !!}</div>
    </div>
@endsection