<div class="loginbox-social">
    <div class="social-title ">Connect with Your Social Accounts</div>
    <div class="social-buttons text-center">
        <div class="row">
            @if(($config['login_facebook_app_status'] ?? '') == 'on')
                <div class="col-lg-12 col-xs-12 margin-bottom-10">
                    <a class="btn btn-primary btn-radius btn-social"
                       href="{{ base_url('member/login-social/facebook'.(!empty($redirect) ? '?redirect='.$redirect : '')) }}">
                        <i class="fa fa-facebook"></i> Facebook
                    </a>
                </div>
            @endif

            @if(($config['login_google_app_status'] ?? '') == 'on')
                <div class="col-lg-12 col-xs-12 margin-bottom-10">
                    <a class="btn btn-danger btn-radius btn-social"
                       href="{{ base_url('member/login-social/google'.(!empty($redirect) ? '?redirect='.$redirect : '')) }}">
                        <i class="fa fa-google"></i> Google
                    </a>
                </div>
            @endif

            @if(($config['login_zalo_app_status'] ?? '') == 'on')
                <div class="col-lg-12 col-xs-12 margin-bottom-10">
                    <a class="btn btn-info btn-radius btn-social"
                       href="{{ base_url('member/login-social/zalo'.(!empty($redirect) ? '?redirect='.$redirect : '')) }}">
                        <i class="fa fa-phone-square" aria-hidden="true"></i> zalo
                    </a>
                </div>
            @endif

        </div>

        <div class="fb-message alert alert-danger" style="display: none"></div>
    </div>
</div>
<div class="loginbox-or">
    <div class="or-line"></div>
    <div class="or">OR</div>
</div>
