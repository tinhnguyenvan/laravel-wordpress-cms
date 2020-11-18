@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" enctype="multipart/form-data" action="{{ admin_url('medias') }}">
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
                        @include('admin.element.form.image', ['name' => 'file', 'image_id' => '', 'image_url' =>  ''])

                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-upload"></i>
                                {{ trans('common.btn.upload') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
