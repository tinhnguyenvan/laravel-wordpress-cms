@extends('layout.'.$theme.'.layouts.app')
@section('content')
    <article id="content" class="container">
        <div class="main-breadcrumb">
            <ol class="breadcrumb mt15">
                <li>
                    <a href="{{ base_url()}}">{{ trans('common.home') }}</a>
                </li>
                <li class="active hidden-xs">{{ trans('common.cart.title') }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="panel panel-default col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="detail-view">
                    <h4 class="article-heading">{{ trans('common.cart.title') }}</h4>
                    <hr>
                </div>
                <form method="get" action="{{ base_url('cart/checkout/'.$token_checkout) }}">
                    <div class="page-content">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ trans('common.cart.name') }}</th>
                                <th class="text-center">{{ trans('common.cart.quantity') }}</th>
                                <th class="text-center">{{ trans('common.cart.price') }}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if($items->count() > 0)
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                            {{ $item->name }}
                                            <a href="{{ base_url('cart/delete/'.$item->id) }}"
                                               class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <input class="text-center" type="number" min="1"
                                                   value="{{ $item->quantity }}">
                                        </td>
                                        <td class="text-center">
                                            {{ number_format($item->price) }}

                                            @if($item->associatedModel->price > $item->associatedModel->price_promotion && $item->associatedModel->price_promotion > 0)
                                                <br>
                                                <s style="color: #ccc; font-size: 11px">{{ number_format($item->associatedModel->price) }}</s>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">{{ trans('common.td_empty') }}</td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="text-right" colspan="2">
                                    <strong>{{ trans('common.cart.total') }}</strong>
                                </td>
                                <td class="text-center">{{ number_format(\Cart::getTotal()) }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    @if($items->count() > 0)
                        <div class="text-right" style="margin: 10px">
                            <button class="btn btn-default">{{ trans('common.cart.btn_update_cart') }}</button>
                            <button class="btn btn-primary">{{ trans('common.cart.btn_checkout') }}</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </article>
@endsection
