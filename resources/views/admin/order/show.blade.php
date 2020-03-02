@extends('admin.layouts.app')
@section('content')

    <div class="container-fluid">
        <div id="ui-view">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <strong>{{ trans('sale_order.title_show') }} {{ $saleOrder->code }}</strong>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <h6 class="mb-3">From:</h6>
                            <div><strong>{{ $saleOrder->billing_fullname }}</strong></div>
                            <div>Address: {{ $saleOrder->billing_address }}</div>
                            <div>Email: {{ $saleOrder->billing_email }}</div>
                            <div>Phone: {{ $saleOrder->billing_phone }}</div>
                        </div>

                        <div class="col-sm-4">
                            <h6 class="mb-3">To:</h6>
                            <div><strong>{{ $config['company_name'] }}</strong></div>
                            <div>Address: {{ $config['company_address'] }}</div>
                            <div>Email: {{ $config['company_email'] }}</div>
                            <div>Phone: {{ $config['company_hotline'] }}</div>
                        </div>

                        <div class="col-sm-4">
                            <h6 class="mb-3">Details:</h6>
                            <div>Invoice: <strong>{{ $saleOrder->invoice_code }}</strong></div>
                            <div>
                                {{ trans('sale_order.created_at') }}
                                : {{ $saleOrder->created_at->format('d/m/Y H:s') }}
                            </div>
                            <div>
                                {{ trans('sale_order.created_id') }}
                                : {{ $saleOrder->creator_id > 0 ?  $saleOrder->user->fullname : '--' }}
                            </div>
                            <div>
                                {{ trans('sale_order.status') }}
                                :
                                <span class="text text-{{ $saleOrder->status_color}}">{{ $saleOrder->status_text }}</span>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 50px" class="center">#</th>
                                <th>SKU</th>
                                <th>Item</th>
                                <th class="center">Quantity</th>
                                <th class="right">Unit Cost</th>
                                <th class="right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($saleOrder->sale_order_lines->count() > 0)
                                @foreach($saleOrder->sale_order_lines as $key => $saleOrderLine)
                                    <tr>
                                        <td class="center">{{ $key+ 1 }}</td>
                                        <td class="left">{{ $saleOrderLine->product_sku }}</td>
                                        <td class="left">{{ $saleOrderLine->product_name }}</td>
                                        <td class="center">{{ $saleOrderLine->quantity }}</td>
                                        <td class="right">{{ number_format($saleOrderLine->item_price_sell) }}</td>
                                        <td class="right">{{ number_format($saleOrderLine->sub_total) }}</td>
                                    </tr>
                                @endforeach
                            @endif

                            <tr>
                                <td colspan="5" class="text-right"><strong>Subtotal</strong></td>
                                <td class="right">{{ number_format($saleOrder->price_sell) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Discount</strong></td>
                                <td class="right">{{ number_format($saleOrder->price_discount) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>VAT</strong></td>
                                <td class="right">{{ number_format($saleOrder->price_tax) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Total</strong></td>
                                <td>
                                    <strong>{{ number_format($saleOrder->price_final) }}</strong>
                                </td>
                            </tr>
                            @if($saleOrder->note)
                                <tr class="bg-white">
                                    <td colspan="2">{{ trans('sale_order.note') }}</td>
                                    <td colspan="4">{!!nl2br(str_replace(" ", " &nbsp;", $saleOrder->note))!!}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="no-print sale_order_action col-lg-12 col-sm-12">
                    <a class="btn btn-default" href="{{ admin_url('orders') }}">
                        <i class="fa fa-history"></i> Back
                    </a>

                    <a class="btn btn-primary" href="{{ admin_url('orders/'.$saleOrder->id) }}"
                       onclick="window.print();">
                        <i class="fa fa-print"></i> Print
                    </a>

                    <form style="display: inline-block"
                          action="{{ admin_url('orders/resent-mail/'.$saleOrder->id) }}" method="post">
                        @csrf
                        <button class="btn btn-warning">
                            <i class="fa fa-telegram" aria-hidden="true"></i> Resend mail
                        </button>
                    </form>

                    <form style="display: inline-block"
                          action="{{ admin_url('orders/status/'.$saleOrder->id) }}" method="post">
                        @csrf
                        <div class="btn-group">
                            <button type="button"
                                    class="btn btn-default dropdown-toggle text-{{ $saleOrder->status_color }}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $saleOrder->status_text }}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach(\App\Models\SaleOrder::STATUS_LIST as $item)
                                    @if($saleOrder->status == $item)
                                        @continue;
                                    @endif
                                    <li>
                                        <button name="status" class="li-sale_order_status" value="{{ $item }}">
                                            {{ trans('sale_order.status.'.$item) }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
