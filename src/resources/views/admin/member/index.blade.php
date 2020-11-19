@extends('admin.layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }}

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" target="_blank" href="{{ base_url('member/register') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.element.filter')

            <table class="table table-responsive-sm table-bordered table-hover font12">
                <thead>
                <tr class="bg-light">
                    <th>ID</th>
                    <th>{{ trans('member.fullname') }}</th>
                    <th style="width: 200px">{{ trans('member.tags') }}</th>
                    <th>{{ trans('member.source') }}</th>
                    <th style="width: 120px">{{ trans('member.member_type') }}</th>
                    <th style="width: 150px">{{ trans('common.updated_at') }}</th>
                    <th style="width: 100px"></th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                {{ !empty($item->fullname) ? $item->fullname : 'No name' }}
                                <a href="{{ admin_url('members/'.$item->id) }}"><i class="fa fa-cog"></i> </a>
                                <p>
                                    <i class="fa fa-phone"></i> {{ !empty($item->phone) ? $item->phone : '--' }}
                                    <br>
                                    <i class="fa fa-envelope"></i> {{ !empty($item->email) ? $item->email : '--' }}
                                </p>
                            </td>
                            <td>
                                {!!  $item->tags_label !!}
                                <br>
                                <a class="font10 text-info" href="{{ admin_url('members/tags/'.$item->id) }}">
                                    <i class="fa fa-tags"></i> Add tags
                                </a>
                            </td>
                            <td>
                                @if(!empty($item->socials))
                                    @foreach($item->socials as $social)
                                        <label style="margin-right: 5px"
                                               class="label label-{{ $social->provider_color }}">
                                            {{ $social->provider }}
                                        </label>
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center">
                                <label class="label label-{{ $item->member_type_color }}">
                                    {{ \App\Models\Member::MEMBER_TYPE_LIST[$item->member_type] }}
                                </label>
                            </td>
                            <td style="font-size: 12px">{{ $item->updated_at ? $item->updated_at->format(config('app.date_format')) : '' }}</td>
                            <td class="text-center">
                                <label class="label label-{{ $item->status_color }} btn-sm">
                                    <i class="fa fa-check-circle-o"></i>
                                    {{ $item->status_text }}
                                </label>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">
                            {{ trans('common.data_empty') }}
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>

            @include('admin.element.pagination')
        </div>
    </div>

@endsection
