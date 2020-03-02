<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link active" href="<?= admin_url('dashboard')?>">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>

            <li class="nav-title"><i class="nav-icon fa fa-sitemap"></i> Menu Main</li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                    <i class="nav-icon fa fa-newspaper-o"></i> {{ trans('nav.menu_left.post') }}
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('post_categorys')?>">
                            <i class="nav-icon fa fa-sitemap"></i> {{trans('nav.menu_left.post_category')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('posts')?>">
                            <i class="nav-icon icon-list"></i> {{ trans('nav.menu_left.post_list') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('posts/create')?>">
                            <i class="nav-icon icon-plus"></i> {{ trans('nav.menu_left.add') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('post_tags')?>">
                            <i class="nav-icon icon-tag"></i> Tags</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                    <i class="nav-icon fa fa-cube"></i> {{ trans('nav.menu_left.product') }}
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('product_categorys')?>">
                            <i class="nav-icon fa fa-sitemap"></i> {{trans('nav.menu_left.product_category')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('products')?>">
                            <i class="nav-icon icon-list"></i> {{trans('nav.menu_left.product_list')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('products/create')?>">
                            <i class="nav-icon icon-plus"></i> {{ trans('nav.menu_left.add') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                    <i class="nav-icon fa fa-shopping-bag"></i>
                    {{ trans('nav.menu_left.woocommerce') }}
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('orders')?>">
                            <i class="nav-icon fa fa-shopping-cart"></i>
                            {{trans('nav.menu_left.orders_list')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('orders/report')?>">
                            <i class="nav-icon icon-chart"></i>
                            {{trans('nav.menu_left.orders_report')}}
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= admin_url('pages')?>">
                    <i class="nav-icon fa fa-copy"></i> {{ trans('nav.menu_left.page') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= admin_url('comments')?>">
                    <i class="nav-icon fa fa-comment-o"></i> {{ trans('nav.menu_left.comment') }}
                </a>
            </li>


            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                    <i class="nav-icon fa fa-file-image-o"></i> {{ trans('nav.menu_left.media') }}
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('medias')?>">
                            <i class="nav-icon icon-list"></i> {{ trans('nav.menu_left.media_list') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('medias/create')?>">
                            <i class="nav-icon fa fa-cloud-upload"></i> {{ trans('nav.menu_left.media_add') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                    <i class="nav-icon fa fa-themeisle"></i> {{ trans('nav.menu_left.theme') }}
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('themes')?>">
                            <i class="nav-icon fa fa-themeisle"></i> {{ trans('nav.menu_left.template') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('navs')?>">
                            <i class="nav-icon fa fa-sitemap"></i> {{ trans('nav.menu_left.menu') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('ads')?>">
                            <i class="nav-icon fa fa-image"></i> {{ trans('nav.menu_left.ads') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('themes/css')?>">
                            <i class="nav-icon fa fa-code"></i> {{ trans('nav.menu_left.theme_css') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                    <i class="nav-icon fa fa-sliders"></i> {{ trans('nav.menu_left.setting') }}
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('configs')?>">
                            <i class="nav-icon fa fa-cogs"></i> {{ trans('nav.menu_left.configs') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                    <i class="nav-icon fa fa-users"></i> {{ trans('nav.menu_left.user') }}
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('users')?>">
                            <i class="nav-icon icon-list"></i> {{ trans('nav.menu_left.user_list') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('users/create')?>">
                            <i class="nav-icon icon-plus"></i> {{ trans('nav.menu_left.user_add') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('users/profile')?>">
                            <i class="nav-icon icon-user"></i> {{ trans('nav.menu_left.user_profile') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('roles')?>">
                            <i class="nav-icon icon-lock"></i> {{ trans('nav.menu_left.role') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                    <i class="nav-icon fa fa-support"></i> {{ trans('nav.menu_left.contact') }}
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= admin_url('contacts')?>">
                            <i class="nav-icon icon-list"></i> {{ trans('nav.menu_left.contact_list') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= admin_url('contact_forms/' . config('constant.CONTACT_FORM_ID') . '/edit')?>">
                            <i class="nav-icon icon-plus"></i> {{ trans('nav.menu_left.contact_update') }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
