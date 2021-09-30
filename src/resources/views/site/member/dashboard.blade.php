@extends('site.layout.member')
@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Hi, {{ auth('web')->user()->fullname ?? 'Guest' }}</h1>
            <h6 class="col-md-12">
                Welcome back {{ $config['company_name'] }}.
            </h6>
        </div>
    </div>
@endsection
