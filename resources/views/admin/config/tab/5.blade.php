<div class="tab-pane" id="tab-5" role="tabpanel">
    @include('admin.element.form.check', ['name' => 'config_maintenance_website', 'text' => trans('config.config_maintenance_website'), 'value' => $config['config_maintenance_website'] ?? ''])
    @include('admin.element.form.textarea', ['name' => 'config_maintenance_website_note',  'text' => trans('config.config_maintenance_website_note'), 'value' => $config['config_maintenance_website_note'] ?? ''])
</div>