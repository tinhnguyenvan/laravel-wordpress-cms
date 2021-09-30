@extends('site.layout.member')
@section('content')
    <div class="content-panel">
        @if(empty($member->email))
            <div class="alert alert-danger">
                {{ trans('member.page.index.required_email_phone') }}
            </div>
        @endif

        <table class="table table-hover">
            <tr>
                <td style="width: 150px">
                    <label class="form-label"><i class="fa fa-user" aria-hidden="true"></i> User Name</label>
                </td>
                <td>{{ $member->username }}</td>
            </tr>

            <tr>
                <td><label class="form-label"><i class="fa fa-info" aria-hidden="true"></i> Full Name</label></td>
                <td>{{ $member->fullname }}</td>
            </tr>

            <tr>
                <td><label class="form-label"><i class="fa fa-map-pin" aria-hidden="true"></i> Address</label></td>
                <td>{{ $member->address }}</td>
            </tr>

            <tr>
                <td><label class="form-label"><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</label></td>
                <td>{{ $member->email }}</td>
            </tr>
            <tr>
                <td><label class="form-label"><i class="fa fa-phone-square" aria-hidden="true"></i> Phone</label></td>
                <td>{{ $member->phone }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <a class="btn btn-primary" href="{{ base_url('member/update-profile') }}">
                        <i class="fa fa-edit" aria-hidden="true"></i> Edit profile
                    </a>
                    @if($member->member_type == 0)
                        <a class="btn btn-primary" href="{{ base_url('member/change-password') }}">
                            <i class="fa fa-key" aria-hidden="true"></i> Change password
                        </a>
                    @endif
                </td>
            </tr>
        </table>

    </div>
@endsection
