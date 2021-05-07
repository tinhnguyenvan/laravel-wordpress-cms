<!DOCTYPE html>
<html lang="en">
@include('admin.layout.head')
<body
    class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show pace-done @if($sidebar_minimizer == 0 ) brand-minimized sidebar-minimized @endif">
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
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    <a class="btn" href="{{ admin_url('dashboard') }}">
                        <i class="icon-graph"></i> Dashboard</a>
                    <a class="btn" href="{{ admin_url('configs') }}">
                        <i class="icon-settings"></i> Settings</a>
                </div>
            </li>
        </ol>
        <div class="container-fluid">
            @if(empty($config['config_email_username']))
                <div
                    class="alert alert-warning">{!! trans('common.alert.config_email', ['url' => admin_url('configs')])  !!}</div>
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
