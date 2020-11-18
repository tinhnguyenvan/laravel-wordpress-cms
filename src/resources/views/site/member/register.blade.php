@extends('site.layout.member')
@section('content')
    <div class="login-container animated fadeInDown bootstrap snippets">
        <div class="loginbox bg-white">
            <div class="loginbox-title">SIGN UP</div>
            @include("site.member.login_social")
            <form method="post" action="{{ base_url('member/register') }}">
                @csrf
                <div class="loginbox-textbox">
                    <label class="control-label">Email</label>
                    <input type="email" required name="email" class="form-control"  value="{{ old('email') }}">
                </div>

                <div class="loginbox-textbox">
                    <label class="control-label">Password</label>
                    <input type="password" required name="password" class="form-control">
                </div>

                <div class="loginbox-textbox">
                    <label class="control-label">Confirm Password</label>
                    <input type="password" required name="password_confirmation" class="form-control" >
                </div>

                <div class="loginbox-submit">
                    <input type="submit" class="btn btn-primary btn-block" value="Register">
                </div>

                <div class="loginbox-textbox">
                    @if ($errors->any())
                        @foreach ($errors->all() as $err)
                            <p class="text-danger">- {{$err}}</p>
                        @endforeach
                    @endif
                </div>
            </form>
            <div class="loginbox-signup">
                <a href="{{ base_url('member/login') }}">Sign In With Email</a>
            </div>
        </div>
        <div class="logobox text-center">
            <a href="{{base_url()}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a>
        </div>
    </div>
@endsection