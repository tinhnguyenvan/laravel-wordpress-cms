@extends('site.layout.member')
@section('content')
    <div class="content-panel">
        <ol class="breadcrumb">
           <li><a href="{{ base_url() }}"><i class="fa fa-home"></i> {{ trans('common.home') }}</a></li>
            <li class="active">{{ $title }}</li>
        </ol>

        <form class="form-horizontal">
            <fieldset class="fieldset">
                <h3 class="fieldset-title">Personal Info</h3>
                <div class="form-group">
                    <label class="col-md-2 col-sm-3 col-xs-12">User Name</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <label>{{ $member->username }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 col-sm-3 col-xs-12">First Name</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <label>{{ $member->first_name }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-sm-3 col-xs-12">Last Name</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <label>{{ $member->last_name }}</label>
                    </div>
                </div>
            </fieldset>
            <fieldset class="fieldset">
                <h3 class="fieldset-title">Contact Info</h3>
                <div class="form-group">
                    <label class="col-md-2  col-sm-3 col-xs-12">Email</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <label>{{ $member->email }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2  col-sm-3 col-xs-12">Address</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <label>{{ $member->address }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2  col-sm-3 col-xs-12">Phone</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <label>{{ $member->phone }}</label>
                    </div>
                </div>
            </fieldset>
            <hr>
            <div class="form-group">
                <div class="col-md-12">
                    <a class="btn btn-primary" href="{{ base_url('member/update-profile') }}">Edit profile</a>
                </div>
            </div>
        </form>
    </div>
@endsection
