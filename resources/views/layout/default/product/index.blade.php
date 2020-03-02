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
            @if (!empty($items))
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td style="width: 100px" class="pro-image">
                            <a href="{{ $item->link($item) }}">
                                @if($item->image_url)
                                    <img src="{{ asset('storage'.$item->image_url) }}"
                                         alt="{{ $item->title }}"
                                         style="width: 100%"
                                         title="{{ $item->title }}"
                                         class="img-responsive"/>
                                @else
                                    <img src="{{ asset('layout/default/img/empty_box.png') }}"
                                         alt="{{ $item->title }}"
                                         style="width: 100%"
                                         class="img-responsive">
                                @endif
                            </a>
                        </td>
                        <td class="pro-name">
                            <a href="{{ $item->link($item) }}"> {{ $item->title }} </a>
                        </td>
                        <td class="pro-price">
                            @if($item->price_promotion > 0)
                                <p class="price-new">{{ $item->price_promotion > 0  ? number_format($item->price_promotion) : 'Vui lòng gọi'}}</p>
                                <p class="price-old">
                                    <del>{{number_format($item->price)}}</del>
                                </p>
                            @else
                                <p class="price-new">{{ $item->price > 0  ? number_format($item->price) : 'Vui lòng gọi'}}</p>
                            @endif

                        </td>
                        <td class="link-detail">
                            <form method="post" action="{{ base_url('cart/add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <input value="1" name="quantity" min="1" type="number" style="width: 100px">
                                <button class="product-atc">
                                    <i class="fa fa-cart-plus"></i>
                                    {{ trans('layout_default.product.view.button.art_cart') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            @endif
            <tfoot>
            <tr>
                <td colspan="4">{{ !empty($items) ? $items->links() : '' }}</td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
