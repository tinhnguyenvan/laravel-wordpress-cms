<head>
    @include('site.element.head')

    @if(!empty($config['editor_content']) && $config['editor_content'] == 'summernote' )
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
</head>
