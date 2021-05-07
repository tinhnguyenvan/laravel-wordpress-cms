<!DOCTYPE html>
<html lang="en">
<head>
    @include('site.element.head')

    <link href="{{ asset("site/css/bootstrap.min.3.3.7.css") }}" rel="stylesheet"/>
    <link href="{{ asset("site/css/font-awesome.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("site/css/member_v1.css") }}" rel="stylesheet"/>
    <script src="{{ asset("site/js/jquery.min.v1.10.2.js") }}" type="text/javascript"></script>
    <script src="{{ asset("site/js/bootstrap.min.js") }}" type="text/javascript"></script>


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
