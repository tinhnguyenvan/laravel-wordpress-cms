<h6 class="text-info"><i class="fa fa-info"></i> Head & Footer</h6>
@include('admin.element.form.textarea', ['name' => 'code_header', 'rows' => 15, 'text' => trans('config.code_header'), 'value' => $config['code_header'] ?? ''])
@include('admin.element.form.textarea', ['name' => 'code_footer', 'rows' => 15, 'text' => trans('config.code_footer'), 'value' => $config['code_footer'] ?? ''])
@include('admin.element.form.textarea', ['name' => 'copyright', 'rows' => 5, 'text' => trans('config.copyright'), 'value' => $config['copyright'] ?? ''])

