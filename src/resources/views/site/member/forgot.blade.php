@extends('site.layout.member_v1')
@section('content')
    <div class="login-container animated fadeInDown bootstrap snippets">
        <div class="loginbox bg-white">
            <div class="loginbox-title">Forgot password</div>
            <form method="post" action="{{ base_url('member/forgot') }}">
                @csrf
                <div class="loginbox-textbox">
                    <label class="control-label">Email</label>
                    <input type="email" class="form-control" required placeholder="Email" name="email" value="{{ old('email') }}">
                </div>

                <div class="loginbox-submit">
                    <input type="submit" class="btn btn-primary btn-block" value="Submit">
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
                <a href="{{ base_url('member/login') }}">Login here</a>
            </div>
        </div>
        <div class="logobox text-center">
            <a href="{{base_url()}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a>
        </div>
    </div>
@endsection