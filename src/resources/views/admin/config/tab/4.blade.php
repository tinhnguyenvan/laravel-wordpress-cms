<div class="tab-pane" id="tab-4" role="tabpanel">

    @include('admin.element.form.input', ['name' => 'seo_title', 'text' => trans('config.seo_title'), 'value' => $config['seo_title'] ?? ''])
    @include('admin.element.form.input', ['name' => 'seo_description', 'text' => trans('config.seo_description'), 'value' => $config['seo_description'] ?? ''])
    @include('admin.element.form.tags', ['name' => 'seo_keyword', 'text' => trans('config.seo_keyword'), 'value' => $config['seo_keyword'] ?? ''])

</div>