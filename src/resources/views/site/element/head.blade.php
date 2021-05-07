<title>{{ $title ?? '' }}</title>
<base href="./">
<link rel="canonical" href="{{ request()->fullUrl() }}"/>
<meta charset="utf-8">
<meta http-equiv="content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<meta name="description" content="{{ $description ?? '' }}">
<meta name="author" content="TWEB.COM.VN">
<meta name="keywords" content="{{ $keyword ?? '' }}">
<meta name="news_keywords" content="{{ $keyword ?? '' }}">

<!-- facebook -->
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $title ?? '' }}">
<meta property="og:image:alt" content="{{ $og_image ?? '' }}">
<meta property="og:image" content="{{ $og_image ?? '' }}">
<meta property="og:image:secure_url" content="{{ $og_image ?? '' }}">
<meta property="og:description" content="{{ $description ?? '' }}">
<meta property="og:url" content="{{ @request()->fullUrl() }}">
<meta property="og:site_name" content="{{ $config['company_name'] ?? '' }}">

<!-- twitter -->
<meta property="twitter:card" content="website">
<meta property="twitter:title" content="{{ $title ?? '' }}">
<meta property="twitter:description" content="{{ $description ?? '' }}">
<meta property="twitter:image" content="{{ $og_image ?? ''}}">

<link rel="canonical" href="{{ base_url() }}"/>
<link rel="shortcut icon" href="{{  $config['favicon'] ?? base_url('favicon.ico') }}" type="image/x-icon">
<link rel="icon" href="{{ $config['favicon'] ?? base_url('favicon.ico') }}" type="image/x-icon">

{!! $config['code_header'] ?? ''  !!}
@if(!empty($theme))
    <style>{!! $config[$theme.'_css'] ?? ''  !!}</style>
@endif
<script type="text/javascript">
    let config = {
        "base_url": "{{ base_url() }}",
    }
</script>
@if(config('services.recaptcha.enable'))
    <script
        src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <script type="text/javascript">
        function onSubmit(token) {
            document.getElementsByClassName("recaptcha")[0].submit();
        }
    </script>
@endif
