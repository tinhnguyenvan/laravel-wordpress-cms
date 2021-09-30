<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item" style="padding-left: 0">
                <a class="nav-link active" href="<?= admin_url()?>">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>

            @if(!empty(@config('constant.MENU_APP')))
                @php($plugins = explode(',', Cookie::get('plugin')))
                <li class="nav-title"> APPS</li>
                @foreach(@config('constant.MENU_APP') as $item)
                    @if(!in_array($item['plugin'], $plugins))
                        @continue
                    @endif

                    @if(!in_array(auth('admin')->user()->role_id, $item['role'] ?? []))
                        @continue
                    @endif
                    <li class="nav-item @if(!empty($item['child'])) nav-dropdown @endif">
                        <a href="@if(!empty($item['url'])) {{ admin_url($item['url']) }} @else javascript:void(0) @endif"
                           class="nav-link  @if(!empty($item['child'])) nav-dropdown-toggle @endif">
                            <i class="nav-icon {{ $item['icon'] }}"></i> {{ trans($item['title']) }}
                        </a>

                        @if(!empty($item['child']))
                            <ul class="nav-dropdown-items">
                                @foreach($item['child'] as $itemChild)
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{ $itemChild['url'] ? admin_url($itemChild['url']) : 'javascript:void(0)'}}">
                                            @if($itemChild['icon'])
                                                <i class="nav-icon {{ $itemChild['icon'] }}"></i>
                                            @else
                                                <span>&nbsp;&nbsp;&nbsp;</span>
                                            @endif
                                            {!! trans($itemChild['title']) !!}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif

            <li class="nav-title"> Website</li>
            @foreach(@config('constant.MENU_ADMIN') as $item)
                @if(!in_array(auth('admin')->user()->role_id, $item['role'] ?? []))
                    @continue
                @endif
                <li class="nav-item @if(!empty($item['child'])) nav-dropdown @endif">
                    <a href="@if(!empty($item['url'])) {{ admin_url($item['url']) }} @else javascript:void(0) @endif"
                       class="nav-link  @if(!empty($item['child'])) nav-dropdown-toggle @endif">
                        <i class="nav-icon {{ $item['icon'] }}"></i> @lang($item['title'], [], config('app.locale'))
                    </a>

                    @if(!empty($item['child']))
                        <ul class="nav-dropdown-items">
                            @foreach($item['child'] as $itemChild)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ admin_url($itemChild['url'])}}">
                                        @if($itemChild['icon'])
                                            <i class="nav-icon {{ $itemChild['icon'] }}"></i>
                                        @endif
                                        @lang($itemChild['title'], [], config('app.locale'))
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
