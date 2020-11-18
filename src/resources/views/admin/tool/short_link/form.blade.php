@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <form method="post" enctype="multipart/form-data" action="{{ admin_url('tools/short_link/create') }}">
                @csrf

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
                        @include('admin.element.form.input', ['name' => 'title', 'text' => trans('tool.short_link.title'), 'value' => old('title')])
                        @include('admin.element.form.input', ['name' => 'url', 'text' => trans('tool.short_link.url'), 'value' => old('url')])

                        <div class="form-group">
                            <label class="col-form-label" for="short_url">Short Code</label>
                            <div class="controls">
                                <input type="text" readonly name="short_url" id="short_url" value="{{ $short_url }}"
                                       class="form-control" autocomplete="off"/>
                                <br />
                                <code><i class="fa fa-link"></i> Link generate: {{ base_url('sl/'.$short_url) }}</code>
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
        </div>
    </div>
@endsection