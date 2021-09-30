@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" enctype="multipart/form-data"
                  action="{{ admin_url('notifications') }}{{ ($object->id ?? 0) > 0 ?'/'.$object->id: '' }}">
                @csrf
                @if (!empty($object->id))
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
                        @include('admin.element.form.input', ['name' => 'title', 'text' => trans('common.title'), 'value' => $object->title ?? ''])

                        @include('admin.element.form.textarea', ['name' => 'content', 'class' => 'ckeditor', 'text' => trans('common.description'), 'value' => $object->content ?? ''])

                        <div class="form-group">
                            <label class="col-form-label" for="status">{{ trans('common.status') }}</label>
                            <div class="controls">
                                @include('admin.element.form.radio', ['name' => 'status', 'text' => trans('common.status.disable'), 'valueDefault' => 0, 'value' => $object->status ?? 0])
                                @include('admin.element.form.radio', ['name' => 'status', 'text' => trans('common.status.new'), 'valueDefault' => 1, 'value' => $object->status ?? 1])
                                @include('admin.element.form.radio', ['name' => 'status', 'text' => trans('common.status.processing'), 'valueDefault' => 2, 'value' => $object->status ?? 0])
                                @include('admin.element.form.radio', ['name' => 'status', 'text' => trans('common.status.success'), 'valueDefault' => 3, 'value' => $object->status ?? 0])
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-success" type="submit" name="submit" value="0">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
