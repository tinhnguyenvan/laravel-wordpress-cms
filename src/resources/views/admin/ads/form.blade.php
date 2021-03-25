@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <form method="post" enctype="multipart/form-data"
                  action="{{ admin_url('ads') }}{{ ($ads->id ?? 0) > 0 ?'/'.$ads->id: '' }}">
                @csrf
                @if (!empty($ads->id))
                    @method('PUT')
                @endif

                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-edit"></i> {{ trans('common.form') }}
                        <div class="card-header-actions">
                            <a class="btn btn-minimize" href="#" data-toggle="collapse" data-target="#collapseExample"
                               aria-expanded="true">
                                <i class="icon-arrow-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body collapse show" id="collapseExample">
                        @include('admin.element.form.input', ['name' => 'title', 'text' => trans('common.title'), 'value' => $ads->title ?? ''])
                        @include('admin.element.form.input', ['name' => 'link', 'text' => trans('common.link'), 'value' => $ads->link ?? ''])

                        <div class="form-group">
                            <label class="col-form-label"
                                   for="config_email_smtp_secure">{{ trans('common.type') }}</label>
                            <div class="controls">

                                @include('admin.element.form.radio', ['name' => 'type', 'text' => 'Image', 'valueDefault' => \App\Models\Ads::TYPE_IMAGE, 'value' => $ads->type ?? 1])
                                @include('admin.element.form.radio', ['name' => 'type', 'text' => 'HTML', 'valueDefault' =>  \App\Models\Ads::TYPE_HTML, 'value' => $ads->type ?? ''])

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="title">{{ trans('common.position') }}</label>
                            <div class="controls">
                                @include('admin.element.form.select', ['name' => 'position', 'data' => $dropdownPosition, 'selected' => old('position', ($ads->position ?? 0))])
                            </div>
                        </div>

                        @include('admin.element.form.textarea', ['name' => 'code', 'text' => trans('common.code'), 'value' => $ads->code ?? ''])

                        @include('admin.element.form.image', ['name' => 'image_id', 'image_id' => $ads->image_id ?? '', 'image_url' => $ads->image_url ?? ''])

                        <div class="form-group">
                            <label class="col-form-label" for="status">{{ trans('common.status') }}</label>
                            <div class="controls">
                                @include('admin.element.form.radio', ['name' => 'status', 'text' => trans('common.status.active'), 'valueDefault' => \App\Models\Ads::STATUS_ACTIVE, 'value' => $post->status ?? 1])
                                @include('admin.element.form.radio', ['name' => 'status', 'text' => trans('common.status.disable'), 'valueDefault' => \App\Models\Ads::STATUS_DISABLE, 'value' => $post->status ?? 0])
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>
                        </div>
                    </div>
                </div>

            </form>

            @if (!empty($ads->id))
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="form-actions text-lg-right">
                            <form method="post" onsubmit="return confirm('Do you want DELETE ?');" action="{{ admin_url('ads/'.$ads->id ) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash"></i>
                                    {{ trans('common.trash') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
