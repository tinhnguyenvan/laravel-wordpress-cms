@include('admin.element.form.input', ['name' => 'company_name', 'text' => trans('config.company_name'), 'value' => $config['company_name'] ?? ''])
@include('admin.element.form.input', ['name' => 'company_address', 'text' => trans('config.company_address'), 'value' => $config['company_address'] ?? ''])
@include('admin.element.form.input', ['name' => 'company_phone', 'text' => trans('config.company_phone'), 'value' => $config['company_phone'] ?? ''])
@include('admin.element.form.input', ['name' => 'company_hotline', 'text' => trans('config.company_hotline'), 'value' => $config['company_hotline'] ?? ''])
@include('admin.element.form.input', ['name' => 'company_email', 'text' => trans('config.company_email'), 'value' => $config['company_email'] ?? ''])
@include('admin.element.form.input', ['name' => 'company_fax', 'text' => trans('config.company_fax'), 'value' => $config['company_fax'] ?? ''])
@include('admin.element.form.textarea', ['name' => 'company_map', 'text' => trans('config.company_map'), 'value' => $config['company_map'] ?? ''])
@include('admin.element.form.input', ['name' => 'company_website', 'text' => trans('config.company_website'), 'value' => $config['company_website'] ?? ''])
@include('admin.element.form.input', ['name' => 'company_facebook', 'text' => trans('config.company_facebook'), 'value' => $config['company_facebook'] ?? ''])
@include('admin.element.form.input', ['name' => 'company_google', 'text' => trans('config.company_google'), 'value' => $config['company_google'] ?? ''])
@include('admin.element.form.input', ['name' => 'company_youtube', 'text' => trans('config.company_youtube'), 'value' => $config['company_youtube'] ?? ''])
@include('admin.element.form.input', ['name' => 'company_pinterest', 'text' => trans('config.company_pinterest'), 'value' => $config['company_pinterest'] ?? ''])
@include('admin.element.form.input', ['name' => 'company_twitter', 'text' => trans('config.company_twitter'), 'value' => $config['company_twitter'] ?? ''])

<div class="form-group">
    <label class="col-form-label" for="logo">Url Logo</label>
    <div class="input-group">
        <input type="text" name="logo" id="logo" value="{{ old('logo', $config['logo'] ?? '') }}"
               class="form-control" autocomplete="off"/>
        <div class="input-group-btn">
            <a class="btn btn-default" target="_blank" href="{{ admin_url('medias') }}">
                <i class="fa fa-copy"></i> Copy link
            </a>
        </div>
    </div>

    <div class="preview-img" style="margin-top: 5px">
        @if(!empty($config['logo']))
            <img src="{{ $config['logo'] }}" class="img-table img-thumbnail"/>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="col-form-label" for="logo">Url Favicon</label>
    <div class="input-group">
        <input type="text" name="favicon" id="favicon" value="{{ old('favicon', $config['favicon'] ?? '') }}"
               class="form-control" autocomplete="off"/>
        <div class="input-group-btn">
            <a class="btn btn-default" target="_blank" href="{{ admin_url('medias') }}">
                <i class="fa fa-copy"></i> Copy link
            </a>
        </div>
    </div>

    <div class="preview-img" style="margin-top: 5px">
        @if(!empty($config['favicon']))
            <img src="{{ $config['favicon'] }}" class="img-table img-thumbnail"/>
        @endif
    </div>
</div>