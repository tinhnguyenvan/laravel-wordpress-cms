@extends('site.layout.member')
@section('content')
    <div class="content-panel">
        <table class="table table-hover">
            <tr>
                <td style="width: 150px">
                    <label class="form-label"><span data-feather="user"></span>  User Name</label>
                </td>
                <td>{{ $member->username }}</td>
            </tr>

            <tr>
                <td><label class="form-label"><span data-feather="info"></span> First Name</label></td>
                <td>{{ $member->first_name }}</td>
            </tr>

            <tr>
                <td><label class="form-label"><span data-feather="info"></span> Last Name</label></td>
                <td>{{ $member->last_name }}</td>
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

                    <a class="btn btn-success" href="{{ base_url('member/update-profile') }}">
                        <span data-feather="settings"></span> Settings
                    </a>

                    <a class="btn btn-primary" href="{{ base_url('member/change-password') }}">
                        <span data-feather="key"></span> Change password
                    </a>
                </td>
            </tr>
        </table>

    </div>
@endsection
