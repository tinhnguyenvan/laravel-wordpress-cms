<div class="side-bar">
    <div class="user-info">
        @if(!empty(auth('web')->user()->image_url))
            @if(!empty(auth('web')->user()->image_id > 0))
                <img class="img-profile img-circle img-responsive center-block"
                     src="{{ asset('storage'.auth('web')->user()->image_url) }}" alt="avatar">
            @else
                <img class="img-profile img-circle img-responsive center-block"
                     src="{{ auth('web')->user()->image_url }}" alt="avatar">
            @endif
        @endif
        <ul class="meta list list-unstyled">
            <li class="email"><a>{{ auth('web')->user()->first_name }}</a></li>
            <li class="activity">Last logged
                in {{ auth('web')->user()->updated_at->format('d/m/Y H:i A') }}</li>
        </ul>
    </div>
    <nav class="side-menu">
        <ul class="nav">
            <li>
                <a href="{{ base_url('member') }}">
                    <span class="fa fa-user"></span> My Profile
                </a>

                <ul class="nav-dropdown-items">
                    <li class="@if($active_menu == '') active @endif">
                        <a href="{{ base_url('member') }}">
                            <span class="fa fa-info"></span> Profile
                        </a>
                    </li>
                </ul>
            </li>

            @if(!empty($manifest['nav_site']) && isset(auth('web')->user()->member_type) && auth('web')->user()->member_type == \App\Models\Member::MEMBER_TYPE_NORMAL )
                @foreach($manifest['nav_site'] as $item)
                    <li class="@if($active_menu == $item['url']) active @endif">
                        <a href="{{ base_url($item['url']) }}">
                            <i class="nav-icon {{ $item['icon'] }}"></i> {{ trans($item['title']) }}
                        </a>

                        @if(!empty($item['child']))
                            <ul class="nav-dropdown-items">
                                @foreach($item['child'] as $itemChild)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ base_url($itemChild['url'])}}">
                                            <i class="nav-icon {{ $itemChild['icon'] }}"></i>
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
                <a href="{{ base_url('member/logout') }}">
                    <span class="fa fa-sign-out"></span> Logout
                </a>
            </li>
        </ul>
    </nav>
</div>
