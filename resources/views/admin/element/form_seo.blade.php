<div class="card">
    <div class="card-header">
        <i class="fa fa-cog"></i>
        {{ trans('common.config_seo') }}
        <div class="card-header-actions">
            <a class="btn btn-minimize" href="#" data-toggle="collapse" data-target="#collapseExample2"
               aria-expanded="true">
                <i class="icon-arrow-down"></i>
            </a>
        </div>

        <div class="text-info">
            <small>{{ trans('common.config_seo_sub') }}</small>
        </div>
    </div>

    <div class="card-body collapse" id="collapseExample2">
        <div class="form-group">
            <label class="col-form-label" for="seo_title">{{ trans('common.seo_title') }}</label>
            <div class="controls">
                <input type="text" maxlength="70" name="seo_title" id="seo_title"
                       value="{{ old('seo_title', $info->seo_title ?? '') }}" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="seo_description">{{ trans('common.seo_description') }}</label>
            <div class="controls">
                <input type="text" maxlength="160" name="seo_description" id="seo_description"
                       value="{{ old('seo_description', $info->seo_description ?? '') }}" class="form-control">
            </div>
        </div>

        <hr/>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-save"></i>
                {{ trans('common.save') }}
            </button>
        </div>
    </div>
</div>