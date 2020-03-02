<div class="tab-pane" id="tab-2" role="tabpanel">
    <div class="row">
        <div class="col-lg-7">
            <h6>Information config mail</h6>
            <hr/>

            @include('admin.element.form.input', ['name' => 'config_email_from', 'text' => trans('config.config_email_from'), 'value' => $config['config_email_from'] ?? ''])
            @include('admin.element.form.input', ['name' => 'config_email_from_name', 'text' => trans('config.config_email_from_name'), 'value' => $config['config_email_from_name'] ?? ''])
            @include('admin.element.form.input', ['name' => 'config_email_smtp_host', 'text' => trans('config.config_email_smtp_host'), 'value' => $config['config_email_smtp_host'] ?? ''])

            <div class="form-group">
                <label class="col-form-label" for="config_email_smtp_secure">
                    {{ trans('config.config_email_smtp_secure') }}
                </label>
                <div class="controls">
                    @include('admin.element.form.radio', ['name' => 'config_email_smtp_secure', 'text' => 'None', 'valueDefault' => "", 'value' => $config['config_email_smtp_secure'] ?? ''])
                    @include('admin.element.form.radio', ['name' => 'config_email_smtp_secure', 'text' => 'SSL', 'valueDefault' => "ssl", 'value' => $config['config_email_smtp_secure'] ?? ''])
                    @include('admin.element.form.radio', ['name' => 'config_email_smtp_secure', 'text' => 'TLS', 'valueDefault' => "tls", 'value' => $config['config_email_smtp_secure'] ?? ''])
                </div>
            </div>

            @include('admin.element.form.input', ['name' => 'config_email_smtp_port', 'text' => trans('config.config_email_smtp_port'), 'value' => $config['config_email_smtp_port'] ?? ''])
            @include('admin.element.form.check', ['name' => 'config_email_smtp_authentication', 'text' => trans('config.config_email_smtp_authentication'), 'value' => $config['config_email_smtp_authentication'] ?? ''])

            @include('admin.element.form.input', ['name' => 'config_email_username', 'text' => trans('config.config_email_username'), 'value' => $config['config_email_username'] ?? ''])
            @include('admin.element.form.input', ['name' => 'config_email_password', 'text' => trans('config.config_email_password'), 'value' => $config['config_email_password'] ?? '', 'type' => 'password'])

        </div>

        <div class="col-lg-5">
            <h6>{{ trans('config.config_email_test_title') }}</h6>
            <hr/>
            @include('admin.element.form.input', ['name' => 'config_email_test_to', 'text' => trans('config.config_email_test_to'), 'value' => $config['config_email_test_to'] ?? ''])
            @include('admin.element.form.input', ['name' => 'config_email_test_subject', 'text' => trans('config.config_email_test_subject'), 'value' => $config['config_email_test_subject'] ?? ''])
            @include('admin.element.form.input', ['name' => 'config_email_test_message', 'text' => trans('config.config_email_test_message'), 'value' => $config['config_email_test_message'] ?? ''])

            <div class="form-actions">
                <button class="btn btn-primary" onclick="testSendMailConfig()"
                        type="button">
                    <i class="fa fa-send-o"></i>
                    {{ trans('common.button.send_test') }}
                </button>
            </div>
        </div>
    </div>
</div>