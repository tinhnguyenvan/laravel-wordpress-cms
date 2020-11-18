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
                <tr style="font-size: 12px">
                    <th>{{ trans('member.fullname') }}</th>
                    <th style="width: 200px">{{ trans('member.tags') }}</th>
                    <th>{{ trans('member.source') }}</th>
                    <th style="width: 120px">{{ trans('member.member_type') }}</th>
                    <th style="width: 150px">{{ trans('common.updated_at') }}</th>
                    <th style="width: 130px"></th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                {{ $item->fullname }}
                                <p>
                                    {{ $item->email }}
                                    <label class="label label-{{ $item->status_color }} btn-sm">
                                        <i class="fa fa-check-circle-o"></i>
                                        {{ $item->status_text }}
                                    </label>
                                </p>
                                <p>{{ $item->phone }}</p>
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
                            <td>
                                <label class="label label-{{ $item->member_type_color }}">
                                    {{ \App\Models\Member::MEMBER_TYPE_LIST[$item->member_type] }}
                                </label>
                            </td>
                            <td style="font-size: 12px">{{ $item->updated_at ? $item->updated_at->format(config('app.date_format')) : '' }}</td>
                            <td class="text-center">
                                <form method="post"
                                      action="{{ admin_url('members/set-status-expert/'.$item->id ) }}">
                                    @csrf
                                    @method('PUT')
                                    @if($item->member_type == \App\Models\Member::MEMBER_TYPE_NORMAL)
                                        <button style="font-size: 10px" class="btn btn-primary btn-sm" type="submit">
                                            <i class="fa fa-level-up"></i> Upgrade Expert
                                        </button>
                                    @else
                                        <button style="font-size: 10px" class="btn btn-warning btn-sm" type="submit">
                                            <i class="fa fa-level-down"></i> Downgrade Expert
                                        </button>
                                </form>
                                @endif
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
