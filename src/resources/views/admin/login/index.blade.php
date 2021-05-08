<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login Admin</title>
    <link href="{{ asset("console/vendor/app.css") }}" rel="stylesheet">

    @if(config('services.recaptcha.enable'))
        <script
            src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
        <script>
            function onSubmit(token) {
                document.getElementsByClassName("recaptcha")[0].submit();
            }
        </script>
    @endif
</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <form method="post" class="recaptcha" action="{{ admin_url('auth') }}">
                        @csrf
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </div>
                                <label for="email"></label>
                                <input type="email" required value="{{ old('email') }}" autocomplete="off"
                                       class="form-control"
                                       placeholder="Username" id="email" name="email">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                </div>
                                <label for="password"></label>
                                <input type="password" required autocomplete="off" class="form-control"
                                       placeholder="Password"
                                       id="password"
                                       name="password">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    @if(config('services.recaptcha.enable'))
                                        <button class="g-recaptcha btn btn-primary px-4"
                                                data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                                data-callback='onSubmit'
                                                data-action='submit'>
                                            <i class="fa fa-sign-in"></i>
                                            Login
                                        </button>
                                    @else
                                        <button class="btn btn-primary px-4">
                                            <i class="fa fa-sign-in"></i>
                                            Login
                                        </button>
                                    @endif

                                    <a target="_blank" href="{{ base_url() }}" class="btn btn-success px-4">
                                        <i class="fa fa-globe"></i>
                                    </a>
                                </div>

                                <div class="text-danger">
                                    <ul>
                                        @if ($errors->count() > 0)
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        @else
                                            @if(!empty($error))
                                                @if(is_array($error))
                                                    @foreach($error as $er)
                                                        <li>{{ e($er) }}</li>
                                                    @endforeach
                                                @else
                                                    <li>{{ e($error) }}</li>
                                                @endif
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card text-white py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <img src="{{ asset('console/img/auth.svg') }}" style="width: 100%" alt="auth">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
