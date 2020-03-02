@extends('admin.layouts.app')
@section('content')
    <!-- chart sale order -->
    @if(\App\Models\SaleOrder::query()->count() > 0)
        @include('admin.order.box_chart_report')
    @endif

    <div class="clearfix"></div>

    <div class="row">
        @if (!empty($data))
            @foreach ($data as $item)
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-value-lg">{{ number_format($item['total']) }}</div>
                            <div><i class="{{ $item['icon'] }}"></i> {{ $item['title'] }}</div>
                            <div class="progress progress-xs my-2">
                                <div class="progress-bar bg-gradient-success" role="progressbar"
                                     style="width: 50%"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <a href="{{ $item['link'] }}"
                               class="text-muted">{{ trans('common.read_more') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="clearfix"></div>

@endsection
