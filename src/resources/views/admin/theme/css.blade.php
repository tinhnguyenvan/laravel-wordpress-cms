@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ admin_url('configs/save')}}">
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
                        <div class="nav-tabs-boxed">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab"
                                       aria-controls="tab-1"
                                       aria-selected="false">{{ trans('config.tab_css') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- tab 5 -->
                                <div class="tab-pane active" id="tab-1" role="tabpanel">
                                    @include('admin.element.form.textarea', ['name' => $theme_active_css, 'rows' => 25, 'value' => $config[$theme_active_css] ?? ''])
                                </div>
                            </div>
                        </div>

                        <div class="form-actions mt-5">
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
