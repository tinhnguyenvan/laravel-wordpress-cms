<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ $title ?? 'Admin' }}</title>

    <link href="{{ asset("console/vendor/vendor.css") }}" rel="stylesheet">
    <script type="text/javascript">
      let configs = {
        'base_url': '{{ base_url() }}',
        'admin_url': '{{ admin_url() }}',
        'MAX_FILE_UPLOAD': '{{ @config('constant.MAX_FILE_UPLOAD') }}',
        'filebrowserUploadUrl': '{{ admin_url('ckeditor/upload?_token='. csrf_token()) }}'
      };
    </script>
</head>
