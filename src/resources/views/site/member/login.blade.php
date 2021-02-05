@extends('site.layout.member_v1')
@section('content')
    <div class="login-container animated fadeInDown bootstrap snippets">
        <div class="loginbox bg-white">
            <div class="loginbox-title">SIGN IN</div>
            @include("site.member.login_social")

            @if(($config['login_basic_app_status'] ?? '') == 'on')
                <form method="post" action="{{ base_url('member/login') }}">
                    @csrf
                    <div class="loginbox-textbox">
                        <label class="control-label">Email</label>
                        <input type="email" placeholder="Email" class="form-control" required name="email"
                               value="{{ old('email') }}">
                    </div>

                    <div class="loginbox-textbox">
                        <label class="control-label">Password</label>
                        <input type="password" class="form-control" required name="password" placeholder="Password">
                    </div>

                    <div class="loginbox-forgot">
                        <a href="{{ base_url('member/forgot') }}">Forgot Password?</a>
                    </div>

                    <div class="loginbox-submit">
                        <input type="submit" class="btn btn-primary btn-block" value="Login">
                    </div>

                    <div class="loginbox-textbox">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">- {{$error}}</p>
                            @endforeach
                        @endif
                    </div>
                </form>
                <div class="loginbox-signup">
                    <a href="{{ base_url('member/register') }}">Sign Up With Email</a>
                </div>
            @endif
        </div>
        <div class="logobox text-center">
            <a href="{{base_url()}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a>
        </div>
    </div>
@endsection