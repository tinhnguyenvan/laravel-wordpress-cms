<!DOCTYPE html>
<html lang="en">
@include('admin.layout.head')
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
@include('admin.layout.header')
<div class="app-body ">
    @include('admin.layout.sidebar', ['sidebar_minimizer' => $sidebar_minimizer])
    <main class="main" id="pjax-container">
        <!-- Breadcrumb-->
        <ol class="breadcrumb no-print">
            <li class="breadcrumb-item">
                <a href="{{ admin_url() }}">{{ ucfirst(@request()->segment(1)) }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ admin_url(@request()->segment(2)) }}">
                    {{ trans('nav.menu_left.'.str_replace('-','_',strtolower(@request()->segment(2)))) }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ $title ?? '' }}</li>
        </ol>
        <div class="container-fluid">
            @if(empty($config['config_email_username']))
                <div class="alert alert-warning">{!! trans('common.alert.config_email', ['url' => admin_url('configs')])  !!}</div>
            @endif
            <div class="animated fadeIn"></div>
            @yield('content')
        </div>
    </main>
</div>
@include('admin.layout.footer')
<div id="alert-message-footer">
    @include('admin.element.error')
    @include('admin.element.success')
</div>
</body>
</html>
