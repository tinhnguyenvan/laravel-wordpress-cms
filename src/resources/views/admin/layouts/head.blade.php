<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ $title }} | Module</title>

    <link href="{{ asset("console/vendor/vendor.css") }}" rel="stylesheet">
    <script type="text/javascript">
        let configs = {
            'base_url': '{{ base_url() }}',
            'admin_url': '{{ base_url('admin') }}',
            'MAX_FILE_UPLOAD': '{{ @config('constant.MAX_FILE_UPLOAD') }}',
            'link_media_upload': '{{ admin_url('media/upload?_token='. csrf_token()) }}',
            'ckeditor': '{{ $config['editor_content'] ?? '' }}',
        };
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="{{ asset("console/js/popper.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("console/js/jquery.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("console/js/bootstrap.min.js") }}" type="text/javascript"></script>

    @if(empty($config['editor_content']))
        <link rel="stylesheet" href="{{ asset("common/plugin/summernote-0.8.18/summernote.css") }}">
        <script src="{{ asset("common/plugin/summernote-0.8.18/summernote.js") }}" type="text/javascript"></script>
    @else
        <script src="{{ asset("common/plugin/ckeditor4/ckeditor.js") }}" type="text/javascript"></script>
    @endif

    <script src="{{ asset("console/js/jquery.easy-autocomplete.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("console/js/bootstrap-tagsinput.js") }}" type="text/javascript"></script>
    <script src="{{ asset("console/js/jquery-simple-tree-table.js") }}" type="text/javascript"></script>
    <script src="{{ asset("console/js/pace.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("console/js/perfect-scrollbar.min.js") }}" type="text/javascript"></script>

    <!-- highcharts -->
    <script src="{{ asset("common/plugin/highcharts/highcharts.js") }}" type="text/javascript"></script>
    <script src="{{ asset("common/plugin/highcharts/exporting.js") }}" type="text/javascript"></script>


    <script src="{{ asset("console/js/coreui.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("console/js/jquery.pjax.js") }}" type="text/javascript"></script>
    <script src="{{ asset("console/js/function.js") }}" type="text/javascript"></script>
    <script src="{{ asset("console/js/clipboard.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("console/js/jquery.cookie.js") }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset("console/js/script.js?v=1") }}" type="text/javascript"></script>

    <style type="text/css">
        .status-item-0 {
            -webkit-text-decoration-line: line-through; /* Safari */
            text-decoration-line: line-through;
        }
    </style>
</head>
