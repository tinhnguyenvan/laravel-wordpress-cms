@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i> {{ trans('user.title_reset_password') }} [{{ $users->name }}]
                    <div class="card-header-actions">
                        <a class="btn btn-minimize" href="#" data-toggle="collapse" data-target="#collapseExample"
                           aria-expanded="true">
                            <i class="icon-arrow-up"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body collapse show" id="collapseExample">
                    <form method="post" enctype="multipart/form-data"
                          action="{{ admin_url('users/update-reset-password/'.$users->id ) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="col-form-label" for="password">{{ trans('user.password') }}</label>
                            <div class="controls">
                                <input type="password" name="password" id=password" class="form-control" required
                                       value="{{ old('password') }}" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label"
                                   for="password_confirm">{{ trans('user.password_confirm') }}</label>
                            <div class="controls">
                                <input type="password" name="password_confirm" id=password_confirm" required
                                       class="form-control" autocomplete="off">
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
