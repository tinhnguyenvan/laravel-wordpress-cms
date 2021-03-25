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
                                @foreach($tabs as $tab)
                                    <li class="nav-item">
                                        <a class="nav-link @if($tabActive == $tab) active @endif"
                                           href="{{ admin_url('configs?tab='.$tab) }}">
                                            {!!  $iconTabs[$tab]  !!}
                                            {{ trans('config.tab_'.$tab) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active">
                                    @include('admin.config.tab.'.$tabActive)
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
