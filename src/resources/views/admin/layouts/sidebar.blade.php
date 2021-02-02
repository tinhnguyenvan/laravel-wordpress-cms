<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item" style="padding-left: 0">
                <a class="nav-link active" href="<?= admin_url()?>">
                    <i class="nav-icon icon-home"></i> Home
                </a>
            </li>

            @foreach(@config('constant.MENU_ADMIN') as $item)
                <li class="nav-item @if(!empty($item['child'])) nav-dropdown @endif">
                    <a class="nav-link  @if(!empty($item['child'])) nav-dropdown-toggle @endif"
                       href="{{ admin_url($item['url'])}}">
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

            @if(!empty(@config('constant.MENU_APP')))
                @php($plugins = explode(',', Cookie::get('plugin')))
                <li class="nav-title"> APPS</li>
                @foreach(@config('constant.MENU_APP') as $item)
                    @if(!in_array($item['plugin'], $plugins))
                        @continue
                    @endif
                    <li class="nav-item @if(!empty($item['child'])) nav-dropdown @endif">
                        <a class="nav-link  @if(!empty($item['child'])) nav-dropdown-toggle @endif"
                           href="{{ admin_url($item['url'])}}">
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
            @endif
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
