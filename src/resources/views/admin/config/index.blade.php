@extends('admin.layouts.app')
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
                                    <a class="nav-link active" data-toggle="tab" href="#tab-1"
                                       role="tab" aria-controls="tab-1"
                                       aria-selected="true">{{ trans('config.tab_general') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab"
                                       aria-controls="tab-2"
                                       aria-selected="false">{{ trans('config.tab_config_email') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-3" role="tab"
                                       aria-controls="tab-3"
                                       aria-selected="false">{{ trans('config.tab_integration') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-4" role="tab"
                                       aria-controls="tab-4"
                                       aria-selected="false">{{ trans('config.tab_seo') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-5" role="tab"
                                       aria-controls="tab-5"
                                       aria-selected="false">{{ trans('config.tab_system') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                @include('admin.config.tab.1')

                                @include('admin.config.tab.2')

                                @include('admin.config.tab.3')

                                @include('admin.config.tab.4')

                                @include('admin.config.tab.5')

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
