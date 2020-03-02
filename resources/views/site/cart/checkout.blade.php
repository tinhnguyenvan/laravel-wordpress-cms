@extends('layout.'.$theme.'.layouts.app')
@section('content')
    <article id="content" class="container">
        <div class="main-breadcrumb">
            <ol class="breadcrumb mt15">
                <li>
                    <a href="{{ base_url()}}">{{ trans('common.home') }}</a>
                </li>
                <li class="active hidden-xs">{{ trans('common.cart.checkout') }}</li>
            </ol>
        </div>
        <div class="">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h4>{{ trans('common.cart.checkout_info') }}</h4>
                    <form method="post" action="{{ base_url('cart/checkout/'.$token_checkout) }}">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="">{{ trans('common.fullname') }}</label>
                                    <div class="controls">
                                        <input class="form-control @error('billing_fullname') is-invalid @enderror"
                                               name="billing_fullname"
                                               required
                                               value="{{ old('billing_fullname') }}"
                                               placeholder="{{ trans('common.fullname') }}/ Fullname"
                                               autocomplete="off">

                                        @error('billing_fullname')
                                        <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                                <div class="form-group">
                                    <label class="">Email</label>
                                    <div class="controls">
                                        <input class="form-control @error('billing_email') is-invalid @enderror"
                                               value="{{ old('billing_email') }}"
                                               required
                                               name="billing_email"
                                               type="email" autocomplete="off"
                                               placeholder="Email">

                                        @error('billing_email')
                                        <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                <div class="form-group">
                                    <label class="">{{ trans('common.phone') }}</label>
                                    <div class="controls">
                                        <input class="form-control @error('billing_phone') is-invalid @enderror"
                                               name="billing_phone"
                                               required
                                               value="{{ old('billing_phone') }}"
                                               placeholder="{{ trans('common.phone') }}/ Phonenumber"
                                               autocomplete="off">
                                        @error('billing_phone')
                                        <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="">{{ trans('common.address') }}</label>
                                    <div class="controls">
                                        <input class="form-control"
                                               name="billing_address"
                                               value="{{ old('billing_address') }}"
                                               placeholder="{{ trans('common.address') }}/ Address"
                                               autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="">{{ trans('common.note') }}</label>
                                    <div class="controls">
                                        <textarea class="form-control" autocomplete="off"
                                                  name="note"
                                                  placeholder="{{ trans('common.note') }}/ Note">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <a class="btn btn-default" href="{{ base_url('cart') }}">
                                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                                        {{ trans('common.cart.text') }}
                                    </a>

                                    <button class="btn btn-primary">
                                        {{ trans('common.cart.completed') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h4>{{ trans('common.cart.checkout_detail') }}</h4>
                    <form method="post" action="{{ base_url('cart/checkout/'.$token_checkout) }}">
                        @csrf
                        @method('PUT')
                        <div class="page-content">
                            <table class="table">
                                <tbody>
                                @if($items->count() > 0)
                                    @foreach($items as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }} ({{ $item->quantity }})
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($item->price) }}

                                                @if($item->associatedModel->price > $item->associatedModel->price_promotion && $item->associatedModel->price_promotion > 0)
                                                    <br>
                                                    <s style="color: #ccc; font-size: 11px">{{ number_format($item->associatedModel->price) }}</s>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>

                                <!--
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" required
                                               placeholder="{{ trans('common.cart.checkout.discount') }}">
                                    </td>
                                    <td>
                                        <button class="btn btn-default" type="submit">
                                            {{ trans('common.cart.checkout.use_discount') }}
                                        </button>
                                    </td>
                                </tr>
                                -->

                                <tr>
                                    <td class="text-info">
                                        <strong>{{ trans('common.cart.sub_total') }}</strong>
                                    </td>
                                    <td class="text-info text-right">{{ number_format(\Cart::getSubTotal()) }}</td>
                                </tr>

                                <tr>
                                    <td class="text-primary">
                                        <strong>{{ trans('common.cart.total') }}</strong>
                                    </td>
                                    <td class="text-primary text-right">
                                        <strong>{{ number_format(\Cart::getTotal()) }}</strong>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </article>

    <style>
        .is-invalid {
            border: 1px solid #d9534f;
        }
    </style>
@endsection