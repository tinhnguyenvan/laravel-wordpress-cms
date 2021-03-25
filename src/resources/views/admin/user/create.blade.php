@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
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
                    <form method="post" enctype="multipart/form-data" action="{{ admin_url('users') }}">
                        @csrf

                        <div class="form-group">
                            <label class="col-form-label" for="title">{{ trans('user.name') }}</label>
                            <div class="controls">
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="title">{{ trans('user.email') }}</label>
                            <div class="controls">
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="title">{{ trans('user.password') }}</label>
                            <div class="controls">
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="title">{{ trans('user.role_id') }}</label>
                            <div class="controls">
                                @include('admin.element.form.select', ['name' => 'role_id', 'data' => $dropdownRole, 'selected' => old('role_id')])
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
