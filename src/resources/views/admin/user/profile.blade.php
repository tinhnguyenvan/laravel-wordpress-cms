@extends('admin.layout.app')
@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">

                        <h3 class="profile-username text-center">{{ @session('auth')['fullname'] }}</h3>

                        <p class="text-muted text-center">{{ @session('auth')['email'] }}</p>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border"></div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <hr>
                        <strong><i class="fa fa-clock-o"></i> {{ trans('user.updated_at') }}</strong>

                        <p class="text-muted">{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:s') : '' }}</p>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">{{ trans('nav.user_profile') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <form method="post" action="{{ admin_url('users/'.$user->id ) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="col-form-label" for="title">{{ trans('user.name') }}</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name" class="form-control"
                                               value="{{ $user->name }}">
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
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection
