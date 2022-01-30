<header class="app-header navbar">
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item">
            <a class="nav-link px-3" href="{{ admin_url() }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>

        @if(!empty(@config('constant.MENU_APP')))
            @php($plugins = explode(',', Cookie::get('plugin')))
            @foreach(@config('constant.MENU_APP') as $item)
                @if(!in_array($item['plugin'], $plugins))
                    @continue
                @endif

                @if(!in_array(auth('admin')->user()->role_id, $item['role'] ?? []))
                    @continue
                @endif
                <li class="nav-item px-3">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="nav-icon {{ $item['icon'] }}"></i> {{ trans($item['title']) }}
                        @if(!empty($item['child']))
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        @endif
                    </a>

                    @if(!empty($item['child']))
                        <div class="dropdown-menu">
                            @foreach($item['child'] as $itemChild)
                                <a class="dropdown-item" href="{{ admin_url($itemChild['url'])}}">
                                    @if($itemChild['icon'])
                                        <i class="nav-icon {{ $itemChild['icon'] }}"></i>
                                    @endif
                                    @lang($itemChild['title'], [], config('app.locale'))
                                </a>
                            @endforeach
                        </div>
                    @endif
                </li>
            @endforeach
        @endif

        @foreach(@config('constant.MENU_ADMIN') as $item)
            @if(!in_array(auth('admin')->user()->role_id, $item['role'] ?? []))
                @continue
            @endif
            <li class="nav-item px-3">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false">
                    <i class="nav-icon {{ $item['icon'] }}"></i> @lang($item['title'], [], config('app.locale'))
                    @if(!empty($item['child']))
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                    @endif
                </a>
                @if(!empty($item['child']))
                    <div class="dropdown-menu">
                        @foreach($item['child'] as $itemChild)
                            <a class="dropdown-item" href="{{ admin_url($itemChild['url'])}}">
                                @if($itemChild['icon'])
                                    <i class="nav-icon {{ $itemChild['icon'] }}"></i>
                                @endif
                                @lang($itemChild['title'], [], config('app.locale'))
                            </a>
                        @endforeach
                    </div>
                @endif
            </li>
        @endforeach
    </ul>

    <ul class="nav navbar-nav ml-auto" style="margin-right: 10px">
        <li class="nav-item" style="min-width: auto" title="View Website">
            <a class="nav-link" target="_blank" href="{{ base_url('/?ref=admin') }}">
                <i class="fa fa-eye" aria-hidden="true"></i>
            </a>
        </li>
        <li class="nav-item d-md-down-none" title="Comment">
            <a class="nav-link" href="{{ admin_url('comments?status=1') }}">
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-danger">{{ $countComment }}</span>
            </a>
        </li>

        <li class="c-header-nav-item dropdown d-md-down-none mx-2 show">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                {{config('app.language_text')[config('app.locale')] }} |
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @foreach(config('app.language_text') as $lang => $textLanguage)
                    <a target="_top"
                       class="dropdown-item @if(request()->cookie('locale') == $lang) text-danger @endif"
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
                {{ auth('admin')->user()->name ?? 'Account' }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
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
