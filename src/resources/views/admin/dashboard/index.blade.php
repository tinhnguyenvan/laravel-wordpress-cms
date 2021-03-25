@extends('admin.layout.app')
@section('content')
    <div class="row">
        @if (!empty($data))
            @foreach ($data as $item)
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-value-lg">{{ number_format($item['total']) }}</div>
                            <div><i class="{{ $item['icon'] }}"></i> {{ $item['title'] }}</div>
                            <div class="progress progress-xs my-2">
                                <div class="progress-bar bg-{{ $item['color'] ?? 'success' }}" role="progressbar"
                                     style="width: {{ $item['percent'] ?? 99 }}%"
                                     aria-valuenow="{{ $item['percent'] ?? 99 }}" aria-valuemin="0" aria-valuemax="100"></div>
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
