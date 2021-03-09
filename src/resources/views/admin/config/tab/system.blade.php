<div class="form-group">
    <label class="col-form-label" for="title">Editor Content</label>
    <div class="controls">
        @include('admin.element.form.select', ['name' => 'editor_content', 'data' => ['summernote' => 'Summernote', 'ckeditor' => 'Ckeditor'], 'selected' => old('editor_content', ($config['editor_content'] ?? ''))])
    </div>
</div>

@include('admin.element.form.check', ['name' => 'config_maintenance_website', 'text' => trans('config.config_maintenance_website'), 'value' => $config['config_maintenance_website'] ?? ''])
@include('admin.element.form.textarea', ['name' => 'config_maintenance_website_note',  'text' => trans('config.config_maintenance_website_note'), 'value' => $config['config_maintenance_website_note'] ?? ''])
@include('admin.element.form.check', ['name' => 'config_basic_auth', 'text' => trans('config.config_basic_auth'), 'value' => $config['config_basic_auth'] ?? ''])
<code>
    {{ trans('common.basic_auth') }} {{ trans('nav.menu_left.user_list') }}: <i class="fa fa-user"></i> username & <i
            class="fa fa-key"></i> password
</code>
