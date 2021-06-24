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
                    <label class="form-label"><span data-feather="user"></span> User Name</label>
                </td>
                <td>{{ $member->username }}</td>
            </tr>

            <tr>
                <td><label class="form-label"><span data-feather="info"></span> Full Name</label></td>
                <td>{{ $member->fullname }}</td>
            </tr>

            <tr>
                <td><label class="form-label"><span data-feather="map-pin"></span> Address</label></td>
                <td>{{ $member->address }}</td>
            </tr>

            <tr>
                <td><label class="form-label"><span data-feather="mail"></span> Email</label></td>
                <td>{{ $member->email }}</td>
            </tr>
            <tr>
                <td><label class="form-label"><span data-feather="phone"></span> Phone</label></td>
                <td>{{ $member->phone }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <a class="btn btn-primary" href="{{ base_url('member/update-profile') }}">
                        <span data-feather="plus-circle"></span> Edit profile
                    </a>
                    @if($member->member_type == 0)
                        <a class="btn btn-primary" href="{{ base_url('member/change-password') }}">
                            <span data-feather="key"></span> Change password
                        </a>
                    @endif
                </td>
            </tr>
        </table>

    </div>
@endsection
