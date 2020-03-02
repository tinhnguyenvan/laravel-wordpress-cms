@extends('layout.'.$theme.'.layouts.app')
@section('content')
    <article id="content" class="container">
        <div class="main-breadcrumb">
            <ol class="breadcrumb mt15">
                <li>
                    <a href="{{ base_url()}}">{{ trans('common.home') }}</a>
                </li>
                <li class="active hidden-xs">{{ trans('common.cart.checkout.success') }}</li>
            </ol>
        </div>
        <div class="">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="alert alert-success">{{ trans('common.cart.checkout.success_description') }}</div>
                </div>
            </div>
        </div>
    </article>
@endsection