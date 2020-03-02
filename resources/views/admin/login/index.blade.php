<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login Admin</title>
    <link href="{{ asset("console/vendor/vendor.css") }}" rel="stylesheet">
</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <form method="post" action="{{ admin_url('auth') }}">
                        @csrf
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </div>
                                <input type="email" required value="{{ old('email') }}" autocomplete="off"
                                       class="form-control"
                                       placeholder="Username" name="email">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                </div>
                                <input type="password" required autocomplete="off" class="form-control"
                                       placeholder="Password"
                                       name="password">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary px-4">
                                        <i class="fa fa-sign-in"></i>
                                        Login
                                    </button>
                                    <a target="_blank" href="{{ base_url() }}" class="btn btn-success px-4">
                                        <i class="fa fa-globe"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <div class="sk-cube-grid">
                            <div class="sk-cube sk-cube1"></div>
                            <div class="sk-cube sk-cube2"></div>
                            <div class="sk-cube sk-cube3"></div>
                            <div class="sk-cube sk-cube4"></div>
                            <div class="sk-cube sk-cube5"></div>
                            <div class="sk-cube sk-cube6"></div>
                            <div class="sk-cube sk-cube7"></div>
                            <div class="sk-cube sk-cube8"></div>
                            <div class="sk-cube sk-cube9"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= asset("console/js/jquery.min.js") ?>"></script>
<script src="<?= asset("console/js/popper.min.js") ?>"></script>
<script src="<?= asset("console/js/bootstrap.min.js") ?>"></script>
<script src="<?= asset("console/js/pace.min.js") ?>"></script>
<script src="<?= asset("console/js/perfect-scrollbar.min.js") ?>"></script>
<script src="<?= asset("console/js/coreui.min.js") ?>"></script>

@include('admin.element.error')
@include('admin.element.success')
</body>
</html>
