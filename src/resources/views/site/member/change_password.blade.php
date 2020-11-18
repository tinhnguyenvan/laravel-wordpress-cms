@extends('site.layout.member')
@section('content')
    <div class="content-panel">
        <ol class="breadcrumb">
           <li><a href="{{ base_url() }}"><i class="fa fa-home"></i> {{ trans('common.home') }}</a></li>
            <li class="active">{{ $title }}</li>
        </ol>

        <form class="form-horizontal" method="post" action="{{ base_url('member/change-password') }}">
            @csrf
            <fieldset class="fieldset">
                <h3 class="fieldset-title">Change password</h3>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label">Password</label>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label">Confirm Password</label>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <input type="password" name="password_confirm" class="form-control">
                    </div>
                </div>

            </fieldset>

            <hr>
            <div class="form-group">
                <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                    <input class="btn btn-primary" type="submit" value="Update">
                </div>
            </div>

            <div class="loginbox-textbox">
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <p class="text-danger">- {{$err}}</p>
                    @endforeach
                @endif
            </div>
        </form>
    </div>

@endsection