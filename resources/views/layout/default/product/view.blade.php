@extends('layout.default.layouts.app')
@section('content')
    <div class="container">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>{{ trans('product.image_url') }}</th>
                <th>{{ trans('product.title') }}</th>
                <th>{{ trans('product.price') }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="width: 100px" class="pro-image">
                    <a href="{{ $product->link($product) }}">
                        @if($product->image_url)
                            <img src="{{ asset('storage'.$product->image_url) }}"
                                 alt="{{ $product->title }}"
                                 style="width: 100%"
                                 title="{{ $product->title }}"
                                 class="img-responsive"/>
                        @else
                            <img src="{{ asset('layout/default/img/empty_box.png') }}"
                                 alt="{{ $product->title }}"
                                 style="width: 100%"
                                 class="img-responsive">
                        @endif
                    </a>
                </td>
                <td class="pro-name">
                    <a href="{{ $product->link($product) }}"> {{ $product->title }} </a>
                </td>
                <td class="pro-price">
                    @if($product->price_promotion > 0)
                        <p class="price-new">{{ $product->price_promotion > 0  ? number_format($product->price_promotion) : 'Vui lòng gọi'}}</p>
                        <p class="price-old">
                            <del>{{number_format($product->price)}}</del>
                        </p>
                    @else
                        <p class="price-new">{{ $product->price > 0  ? number_format($product->price) : 'Vui lòng gọi'}}</p>
                    @endif

                </td>
                <td class="link-detail">
                    <form method="post" action="{{ base_url('cart/add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input value="1" name="quantity" min="1" type="number" style="width: 100px">
                        <button class="product-atc">
                            <i class="fa fa-cart-plus"></i>
                            {{ trans('layout_default.product.view.button.art_cart') }}
                        </button>
                    </form>
                </td>
            </tr>
            </tbody>

        </table>
    </div>
@endsection
