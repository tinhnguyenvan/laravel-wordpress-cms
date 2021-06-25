<h6 class="text-success"><i class="fa fa-envelope-o"></i> Login Mail</h6>
@include('admin.element.form.check_on_off', ['name' => 'login_basic_app_status', 'text' => '', 'value' => $config['login_basic_app_status'] ?? ''])

<hr/>
<h6 class="text-primary"><i class="fa fa-facebook-official"></i> Login Facebook</h6>
@include('admin.element.form.check_on_off', ['name' => 'login_facebook_app_status', 'text' => '', 'value' => $config['login_facebook_app_status'] ?? ''])
@include('admin.element.form.input', ['name' => 'facebook_app_id', 'text' => trans('config.facebook_app_id'), 'value' => $config['facebook_app_id'] ?? '', 'placeholder' => 'Ex: 1318777564985742'])
@include('admin.element.form.input', ['name' => 'facebook_app_secret', 'text' => trans('config.facebook_app_secret'), 'value' => $config['facebook_app_secret'] ?? '', 'placeholder' => 'Ex: c3ae778ab1f6cd5b962b04b20ced56f2'])
<input type="hidden" name="facebook_app_callback_url" value="{{ base_url('member/callback/facebook') }}" />

<hr/>
<h6 class="text-danger"><i class="fa fa-google"></i> Login Google</h6>
@include('admin.element.form.check_on_off', ['name' => 'login_google_app_status', 'text' => '', 'value' => $config['login_google_app_status'] ?? ''])
@include('admin.element.form.input', ['name' => 'google_app_id', 'text' => trans('config.google_app_id'), 'value' => $config['google_app_id'] ?? '', 'placeholder' => 'Ex: qsfseis5b0dikrghj7pcpsof1qfj8g16'])
@include('admin.element.form.input', ['name' => 'google_app_secret', 'text' => trans('config.google_app_secret'), 'value' => $config['google_app_secret'] ?? '', 'placeholder' => 'Ex: UEGvRH+m1Emmq1pZvuIdTEXwi'])
<input type="hidden" name="google_app_callback_url" value="{{ base_url('member/callback/google') }}" />

<hr/>
<h6 class="text-info"><i class="fa fa-phone-square"></i> Login Zalo</h6>
@include('admin.element.form.check_on_off', ['name' => 'login_zalo_app_status', 'text' => '', 'value' => $config['login_zalo_app_status'] ?? ''])
@include('admin.element.form.input', ['name' => 'zalo_app_id', 'text' => trans('config.zalo_app_id'), 'value' => $config['zalo_app_id'] ?? '', 'placeholder' => 'Ex: a123asda3cpsof1qfj8g16'])
@include('admin.element.form.input', ['name' => 'zalo_app_secret', 'text' => trans('config.zalo_app_secret'), 'value' => $config['zalo_app_secret'] ?? '', 'placeholder' => 'Ex: AUonalronkci'])
<input type="hidden" name="zalo_app_callback_url" value="{{ base_url('member/callback/zalo') }}" />
