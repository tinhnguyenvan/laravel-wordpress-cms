<!doctype html>
<html lang="en">
<head>
    @include('site.element.head')

    <!-- Bootstrap core CSS -->
    <link href="{{ asset("site/css/bootstrap.5.0.min.css") }}" rel="stylesheet">
    <link href="{{ asset("site/css/dashboard.css") }}" rel="stylesheet">
    <link href="{{ asset("site/css/member_v2.css") }}" rel="stylesheet"/>
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
        <span data-feather="user"></span>
        {{ auth('web')->user()->first_name ?: "Admin" }}
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav px-3 d-none d-sm-block">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{ base_url('member/logout') }}">
                <span data-feather="log-out"></span> Sign out
            </a>
        </li>
    </ul>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link @if($active_menu == 'member') active @endif" href="{{ base_url('member') }}">
                            <span data-feather="info"></span> Profile
                        </a>
                    </li>

                    @if(!empty($manifest['nav_site']) && isset(auth('web')->user()->member_type))
                        @foreach($manifest['nav_site'] as $item)
                            <li class="nav-item">
                                <a class="nav-link @if($active_menu == $item['url']) active @endif"
                                   href="{{ base_url($item['url']) }}">
                                    <span data-feather="{{ $item['icon'] }}"></span>
                                    {{ trans($item['title']) }}
                                </a>

                                @if(!empty($item['child']))
                                    <ul class="list-unstyled" style="margin-left: 15px">
                                        @foreach($item['child'] as $itemChild)
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ base_url($itemChild['url'])}}">
                                                    <span data-feather="{{ $itemChild['icon'] }}"></span>
                                                    {{ trans($itemChild['title']) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    @endif

                    <li>
                        <a class="nav-link" href="{{ base_url('member/logout') }}">
                            <span data-feather="log-out"></span> Sign out
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="row" style="margin-top: 10px">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a style="text-decoration: none" href="{{ base_url() }}"><span data-feather="home"></span>
                                Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</div>


<script src="{{ asset("site/js/bootstrap.bundle.5.0.min.js") }}"></script>
<script src="{{ asset("site/js/feather.min.js")}}"></script>

<script src="{{ asset("site/js/dashboard.js") }}"></script>


<div class="show-message-footer">
    @isset($error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {!! is_array($error) ? '- '.implode("<br>- ",$error) : $error !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset

    @isset($success)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! is_array($success) ? '- '.implode("<br>- ",$success) : $success !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset
</div>
</body>
</html>
