@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                @foreach($plugins as $plugin)
                    <div class="col-sm-6">
                        <form method="post" action="{{ admin_url('configs/save')}}">
                            @csrf
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
