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
                    <form method="post" enctype="multipart/form-data" action="{{ admin_url('medias') }}">
                        @csrf
                        <x-forms.file-dropzone name="file"></x-forms.file-dropzone>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
