@extends('admin.layouts.app')
@section('content')

    <div class="col-sm-10">
        <div class="card">
            <div class="card-header"><strong>@lang('Profile Information')</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover table-striped table-bordered">
                            <tbody>
                            <tr>
                                <td style="width: 150px" class="bg-light text-bold"><i
                                        class="fa fa-user"></i> @lang('member.fullname')</td>
                                <td>{{ $member->fullname }}</td>
                            </tr>

                            <tr>
                                <td class="bg-light text-bold"><i class="fa fa-phone"></i> @lang('common.phone')</td>
                                <td>{{ $member->phone }}</td>
                            </tr>

                            <tr>
                                <td class="bg-light text-bold"><i class="fa fa-envelope"></i> @lang('member.email')</td>
                                <td>{{ $member->email }}</td>
                            </tr>

                            <tr>
                                <td class="bg-light text-bold"><i class="fa fa-tags"></i> @lang('member.tags')</td>
                                <td>{!!  $member->tags_label !!}</td>
                            </tr>

                            <tr>
                                <td class="bg-light text-bold"><i class="fa fa-link"></i> @lang('member.source')</td>
                                <td>
                                    @if(!empty($member->socials))
                                        @foreach($member->socials as $social)
                                            <label style="margin-right: 5px"
                                                   class="label label-{{ $social->provider_color }}">
                                                {{ $social->provider }}
                                            </label>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ admin_url('members/'.$member->id.'/edit') }}" class="btn btn-sm btn-default" type="submit">
                    <i class="fa fa-edit"></i> Edit
                </a>

                <form method="post" style="display: inline-block"
                      action="{{ admin_url('members/set-member-type/'.$member->id ) }}">
                    @csrf
                    @method('PUT')
                    @if($member->member_type == \App\Models\Member::MEMBER_TYPE_NORMAL)
                        <button class="btn btn-success btn-sm" type="submit" name="member_type"
                                value="{{ \App\Models\Member::MEMBER_TYPE_EXPERT }}">
                            <i class="fa fa-level-up"></i> Upgrade Expert
                        </button>

                        <button class="btn btn-info btn-sm" type="submit" name="member_type"
                                value="{{ \App\Models\Member::MEMBER_TYPE_EDUCATOR }}">
                            <i class="fa fa-level-up"></i> Upgrade Educator
                        </button>

                        <button class="btn btn-primary btn-sm" type="submit" name="member_type"
                                value="{{ \App\Models\Member::MEMBER_TYPE_SCHOOL }}">
                            <i class="fa fa-level-up"></i> Upgrade School
                        </button>
                    @else
                        <button class="btn btn-{{ $member->member_type_color }} btn-sm" type="submit" name="member_type"
                                value="{{ \App\Models\Member::MEMBER_TYPE_NORMAL }}">
                            <i class="fa fa-level-down"></i>
                            Downgrade @lang('member.member_type.'.$member->member_type)
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </div>

@endsection
