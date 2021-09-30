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
                        <link href="{{ asset("common/plugin/dropzonejs/dropzone.css") }}" rel="stylesheet">
                        <script src="{{ asset("common/plugin/dropzonejs/dropzone.js") }}" type="text/javascript"></script>

                        <div id="my-awesome-dropzone" class="dropzone">
                            <div class="dropzone-file-area">
                                <div class="dropzone-previews"></div>

                                <div class="dz-default dz-message">
                                    <h3 class="sbold">{{ trans('common.Drop files here to upload') }}</h3>
                                    <span>{{ trans('common.You can also click to open file browser') }}</span>
                                </div>
                            </div>
                        </div>

                        <script>
                            Dropzone.autoDiscover = false;

                            let dropzone = new Dropzone("#my-awesome-dropzone", {
                                url: "{{ admin_url('media/upload') }}",
                                paramName: "upload",
                                uploadMultiple: false,
                                maxFiles: 10, // 10 file
                                maxFilesize: 2, // 2MB
                                // autoProcessQueue: false,
                                addRemoveLinks: true,
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                            });

                            dropzone.on("removedfile", function (file) {
                                // alert('remove triggered');
                            });

                            dropzone.on("addedfile", function (file) {
                                // alert('add triggered');
                            });

                            dropzone.on("success", function (file) {

                            });
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
