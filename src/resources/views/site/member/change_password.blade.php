@extends('site.layout.member')
@section('content')
    <div class="content-panel">
        <form class="form-horizontal" method="post" action="{{ base_url('member/change-password') }}">
            @csrf
            <h3 class="fieldset-title">Change password</h3>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirm" id="password_confirm" class="form-control">
            </div>


            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Update">

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