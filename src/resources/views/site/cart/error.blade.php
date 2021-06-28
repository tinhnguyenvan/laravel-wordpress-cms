@extends('site.layout.member')
@section('content')
    <article id="content" class="container">
        <div class="">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="alert alert-danger">{{ trans('common.cart.checkout.error_description') }}</div>
                </div>
            </div>
        </div>
    </article>
@endsection