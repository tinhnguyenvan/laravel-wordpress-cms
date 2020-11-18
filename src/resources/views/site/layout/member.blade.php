<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="{{ !empty($description) ? $description : '' }}">
    <meta name="author" content="TWEB.COM.VN">
    <meta name="keyword" content="{{ !empty($keyword) ? $keyword : '' }}">
    <title>{{ !empty($title) ? $title : '' }}</title>

    <link rel="shortcut icon" href="{{ !empty($config['favicon']) ? $config['favicon'] : base_url('favicon.ico') }}"
          type="image/x-icon">
    <link rel="icon" href="{{ !empty($config['favicon']) ? $config['favicon'] : base_url('favicon.ico') }}"
          type="image/x-icon">

    <link href="{{ asset("site/css/bootstrap.min.3.3.7.css") }}" rel="stylesheet"/>
    <link href="{{ asset("site/css/font-awesome.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("site/css/member.css") }}" rel="stylesheet"/>
    <script src="{{ asset("site/js/jquery.min.v1.10.2.js") }}" type="text/javascript"></script>
    <script src="{{ asset("site/js/bootstrap.min.js") }}" type="text/javascript"></script>

    {!! !empty($config['code_header']) ? $config['code_header'] : ''  !!}
    <style>
        {!! !empty($config[$theme.'_css']) ? $config[$theme.'_css'] : ''  !!}
    </style>
</head>

<body>
<div class="container-fluid-swap">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
                    @include('site.member.nav')
                @endif
                @yield('content')
            </div>
        </section>
    </div>
</div>

<div class="show-message-footer">
    @isset($error)
        <div class="alert alert-warning alert-dismissible">
            {!! is_array($error) ? '- '.implode("<br>- ",$error) : $error !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endisset

    @isset($success)
        <div class="alert alert-success alert-dismissible">
            {!! is_array($success) ? '- '.implode("<br>- ",$success) : $success !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endisset
</div>

</body>
</html>
