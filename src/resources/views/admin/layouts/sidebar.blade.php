<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link active" href="<?= admin_url('dashboard')?>">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>
            <li class="nav-title"><i class="nav-icon fa fa-sitemap"></i> Menu Main</li>

            @if(!empty($manifest['nav_admin']))
                @foreach($manifest['nav_admin'] as $item)
                    <li class="nav-item @if(!empty($item['child'])) nav-dropdown @endif">
                        <a class="nav-link  @if(!empty($item['child'])) nav-dropdown-toggle @endif"
                           href="@if(!empty($item['child'])) javascript:void(0) @else {{ admin_url($item['url'])}} @endif">
                            <i class="nav-icon {{ $item['icon'] }}"></i>
                            {{ trans($item['title']) }}
                        </a>

                        @if(!empty($item['child']))
                            <ul class="nav-dropdown-items">
                                @foreach($item['child'] as $itemChild)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ admin_url($itemChild['url'])}}">
                                            @if($itemChild['icon'])
                                                <i class="nav-icon {{ $itemChild['icon'] }}"></i>
                                            @endif
                                            {{ trans($itemChild['title']) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif

            @foreach(@config('constant.MENU_ADMIN') as $item)
                <li class="nav-item @if(!empty($item['child'])) nav-dropdown @endif">
                    <a class="nav-link  @if(!empty($item['child'])) nav-dropdown-toggle @endif"
                       href="@if(!empty($item['child'])) javascript:void(0) @else {{ admin_url($item['url'])}} @endif">
                        <i class="nav-icon {{ $item['icon'] }}"></i> {{ trans($item['title']) }}
                    </a>

                    @if(!empty($item['child']))
                        <ul class="nav-dropdown-items">
                            @foreach($item['child'] as $itemChild)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ admin_url($itemChild['url'])}}">
                                        @if($itemChild['icon'])
                                        <i class="nav-icon {{ $itemChild['icon'] }}"></i>
                                        @endif
                                        {{ trans($itemChild['title']) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
