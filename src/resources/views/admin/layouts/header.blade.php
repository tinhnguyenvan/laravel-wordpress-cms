<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ admin_url('dashboard') }}">
        CMS
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" target="_blank" href="{{ url('/') }}"><i class="fa fa-globe"></i> Web</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ admin_url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ admin_url('users') }}"><i class="fa fa-users"></i> Users</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ admin_url('configs') }}"><i class="fa fa-cogs"></i> Settings</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto" style="margin-right: 10px">

        <!--
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-danger">5</span>
            </a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-list"></i>
            </a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-location-pin"></i>
            </a>
        </li>
        -->
        <li class="c-header-nav-item dropdown d-md-down-none mx-2 show">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                {{config('app.language_text')[config('app.locale')] }}   |
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @foreach(config('app.language_text') as $lang => $textLanguage)
                    <a target="_top" class="dropdown-item @if(request()->cookie('locale') == $lang) text-danger @endif"
                       href="{{ request()->fullUrlWithQuery(['lang'=> $lang]) }}">
                        {{ $textLanguage }}
                    </a>
                @endforeach
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                <i class="icon-user"></i>
                Account
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <!-- <div class="dropdown-header text-center">
                    <strong>Account</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-bell-o"></i> Updates
                    <span class="badge badge-info">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-envelope-o"></i> Messages
                    <span class="badge badge-success">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-tasks"></i> Tasks
                    <span class="badge badge-danger">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-comments"></i> Comments
                    <span class="badge badge-warning">42</span>
                </a>
                -->
                <div class="dropdown-header text-center">
                    <strong>{{ trans('nav.setting') }}</strong>
                </div>

                <a class="dropdown-item" href="{{ admin_url('users/profile') }}">
                    <i class="fa fa-user"></i> {{ trans('nav.user_profile') }}
                </a>

                <a class="dropdown-item" href="{{ admin_url('logout') }}">
                    <i class="fa fa-lock"></i> {{ trans('nav.logout') }}
                </a>
            </div>
        </li>
    </ul>
</header>
