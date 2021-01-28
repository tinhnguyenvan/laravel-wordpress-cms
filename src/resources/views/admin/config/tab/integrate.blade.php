<h6 class="text-info"><i class="fa fa-info"></i> Head & Footer</h6>
@include('admin.element.form.textarea', ['name' => 'code_header', 'rows' => 15, 'text' => trans('config.code_header'), 'value' => $config['code_header'] ?? ''])
@include('admin.element.form.textarea', ['name' => 'code_footer', 'rows' => 15, 'text' => trans('config.code_footer'), 'value' => $config['code_footer'] ?? ''])
@include('admin.element.form.textarea', ['name' => 'copyright', 'rows' => 5, 'text' => trans('config.copyright'), 'value' => $config['copyright'] ?? ''])

<hr/>
<h6 class="text-primary"><i class="fa fa-facebook-official"></i> Facebook Integration</h6>
@include('admin.element.form.input', ['name' => 'facebook_app_id', 'text' => trans('config.facebook_app_id'), 'value' => $config['facebook_app_id'] ?? '', 'placeholder' => 'Ex: 1318777564985742'])
@include('admin.element.form.input', ['name' => 'facebook_app_secret', 'text' => trans('config.facebook_app_secret'), 'value' => $config['facebook_app_secret'] ?? '', 'placeholder' => 'Ex: c3ae778ab1f6cd5b962b04b20ced56f2'])
@include('admin.element.form.input', ['name' => 'facebook_app_callback_url', 'text' => trans('config.facebook_app_callback_url'), 'value' => $config['facebook_app_callback_url'] ?? '', 'placeholder' => 'Ex: https://cms.tweb.com.vn/member/callback/facebook'])

<hr/>
<h6 class="text-danger"><i class="fa fa-google"></i> Google Integration</h6>
@include('admin.element.form.input', ['name' => 'google_app_id', 'text' => trans('config.google_app_id'), 'value' => $config['google_app_id'] ?? '', 'placeholder' => 'Ex: qsfseis5b0dikrghj7pcpsof1qfj8g16'])
@include('admin.element.form.input', ['name' => 'google_app_secret', 'text' => trans('config.google_app_secret'), 'value' => $config['google_app_secret'] ?? '', 'placeholder' => 'Ex: UEGvRH+m1Emmq1pZvuIdTEXwi'])
@include('admin.element.form.input', ['name' => 'google_app_callback_url', 'text' => trans('config.google_app_callback_url'), 'value' => $config['google_app_callback_url'] ?? '', 'placeholder' => 'Ex: https://cms.tweb.com.vn/member/callback/google'])
