<!doctype html>
<html lang="en">
<head>
    @include('site.element.head')

    <link href="{{ asset("site/css/bootstrap.5.0.min.css") }}" rel="stylesheet">
    <link href="{{ asset("site/css/dashboard.css") }}" rel="stylesheet">
    <link href="{{ asset("common/plugin/select2/css/select2.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("common/plugin/select2/css/select2-bootstrap4.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("site/css/font-awesome.min.css") }}" rel="stylesheet"/>
    <link href="{{ asset("site/css/member_v2.css") }}" rel="stylesheet"/>
    <script type="text/javascript">
        let configs = {
            'base_url': '<?php echo e(base_url()); ?>',
            'admin_url': '<?php echo e(base_url('admin')); ?>',
            'MAX_FILE_UPLOAD': '<?php echo e(@config('constant.MAX_FILE_UPLOAD')); ?>',
        };
    </script>

    <script src="{{ asset("site/js/jquery-3.2.1.min.js") }}"></script>
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
        <i class="fa fa-user-circle" aria-hidden="true"></i>
        {{ !empty(auth('web')->user()->first_name) ? auth('web')->user()->first_name :  "Member" }}
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    @if(!empty(auth('web')->user()->id))
        <ul class="navbar-nav px-3 d-none d-sm-block">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{ base_url('member/logout') }}">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Sign out
                </a>
            </li>
        </ul>
    @endif
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    @if(!empty(auth('web')->user()->id))
                        <li class="nav-item">
                            <a class="nav-link @if(!empty($active_menu) && $active_menu == 'dashboard') active @endif" aria-current="page" href="{{ base_url('member/dashboard') }}">
                                <i class="fa fa-dashboard" aria-hidden="true"></i>
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if(!empty($active_menu) && $active_menu == 'member') active @endif"
                               href="{{ base_url('member') }}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i> Profile
                            </a>
                        </li>

                        @if(!empty($manifest['nav_site']) && isset(auth('web')->user()->member_type))
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>Saved reports</span>
                                <a class="link-secondary" href="#" aria-label="Add a new report">
                                    <span data-feather="plus-circle"></span>
                                </a>
                            </h6>

                            @foreach($manifest['nav_site'] as $item)
                                <li class="nav-item">
                                    <a class="nav-link @if(!empty($active_menu) && $active_menu == $item['url']) active @endif"
                                       href="{{ base_url($item['url']) }}">
                                        <i class="fa {{ $item['icon'] }}"></i>
                                        {{ trans($item['title']) }}
                                    </a>

                                    @if(!empty($item['child']))
                                        <ul class="list-unstyled" style="margin-left: 15px">
                                            @foreach($item['child'] as $itemChild)
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ base_url($itemChild['url'])}}">
                                                        <i class="fa {{ $itemChild['icon'] }}"></i>

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
                                <i class="fa fa-sign-out" aria-hidden="true"></i> Sign out
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="row" style="margin-top: 10px">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a style="text-decoration: none" href="{{ base_url() }}">
                                <i class="fa fa-home" aria-hidden="true"></i>
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
<script src="{{ asset("common/plugin/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("site/js/script.js") }}"></script>

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
