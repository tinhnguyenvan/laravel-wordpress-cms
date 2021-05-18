<?php
/**
 * @author: nguyentinh
 * @create: 12/28/19, 10:05 AM
 */

return [
    'MENU_APP' => [], // no remove why merge array with package
    'MENU_ADMIN' => [
        [
            'title' => 'nav.menu_left.content',
            'url' => '',
            'icon' => 'fa fa-newspaper-o',
            'child' => [
                [
                    'title' => 'nav.menu_left.post_list',
                    'url' => 'posts',
                    'icon' => 'icon-list',
                ],
                [
                    'title' => 'nav.menu_left.add',
                    'url' => 'posts/create',
                    'icon' => 'icon-plus',
                ],
                [
                    'title' => 'nav.menu_left.post_categories',
                    'url' => 'post_categories',
                    'icon' => 'fa fa-sitemap',
                ],

                [
                    'title' => 'nav.menu_left.pages',
                    'url' => 'pages',
                    'icon' => 'fa fa-copy',
                    'child' => []
                ],
                [
                    'title' => 'nav.menu_left.tags',
                    'url' => 'post_tags',
                    'icon' => 'icon-tag',
                ],
                [
                    'title' => 'nav.menu_left.comments',
                    'url' => 'comments',
                    'icon' => 'fa fa-comment-o',
                    'child' => []
                ],
                [
                    'title' => 'nav.menu_left.bookmarks',
                    'url' => 'bookmarks',
                    'icon' => 'fa fa-bookmark',
                    'child' => []
                ],
            ]
        ],


        [
            'title' => 'nav.menu_left.medias',
            'url' => '',
            'icon' => 'fa fa-file-image-o',
            'child' => [
                [
                    'title' => 'nav.menu_left.media_list',
                    'url' => 'medias',
                    'icon' => 'icon-list',
                ],
                [
                    'title' => 'nav.menu_left.media_add',
                    'url' => 'medias/create',
                    'icon' => 'fa fa-cloud-upload',
                ],
            ]
        ],
        [
            'title' => 'nav.menu_left.themes',
            'url' => '',
            'icon' => 'fa fa-themeisle',
            'child' => [
                [
                    'title' => 'nav.menu_left.templates',
                    'url' => 'themes',
                    'icon' => 'fa fa-themeisle',
                ],
                [
                    'title' => 'nav.menu_left.menu',
                    'url' => 'navs',
                    'icon' => 'fa fa-sitemap',
                ],
                [
                    'title' => 'nav.menu_left.ads',
                    'url' => 'ads',
                    'icon' => 'fa fa-image',
                ],
                [
                    'title' => 'nav.menu_left.theme_css',
                    'url' => 'themes/css',
                    'icon' => 'fa fa-code',
                ],
            ]
        ],
        [
            'title' => 'nav.menu_left.user',
            'url' => '',
            'icon' => 'fa fa-users',
            'child' => [
                [
                    'title' => 'nav.menu_left.member_list',
                    'url' => 'members',
                    'icon' => 'icon-user',
                ],
                [
                    'title' => 'nav.menu_left.user_list',
                    'url' => 'users',
                    'icon' => 'icon-list',
                ],
                [
                    'title' => 'nav.menu_left.user_profile',
                    'url' => 'users/profile',
                    'icon' => 'icon-user',
                ],
                [
                    'title' => 'nav.menu_left.roles',
                    'url' => 'roles/permission',
                    'icon' => 'icon-lock',
                ],
            ]
        ],
        [
            'title' => 'nav.menu_left.contact',
            'url' => '',
            'icon' => 'fa fa-envelope',
            'child' => [
                [
                    'title' => 'nav.menu_left.contact_list',
                    'url' => 'contacts',
                    'icon' => 'icon-list',
                ],
                [
                    'title' => 'nav.menu_left.contact_update',
                    'url' => 'contact_forms/1/edit',
                    'icon' => 'icon-plus',
                ],
            ]
        ],
        [
            'title' => 'nav.menu_left.setting',
            'url' => '',
            'icon' => 'fa fa-sliders',
            'child' => [
                [
                    'title' => 'nav.menu_left.configs',
                    'url' => 'configs',
                    'icon' => 'fa fa-cogs',
                ],
                [
                    'title' => 'nav.menu_left.plugins',
                    'url' => 'plugins',
                    'icon' => 'fa fa-unlock',
                ],         [
                    'title' => 'nav.menu_left.languages',
                    'url' => 'languages',
                    'icon' => 'fa fa-language',
                ],
                [
                    'title' => 'nav.menu_left.regions',
                    'url' => 'regions',
                    'icon' => 'fa fa-globe',
                ],
                [
                    'title' => 'Cache System',
                    'url' => 'cache-systems',
                    'icon' => 'fa fa-database',
                ],
            ]
        ],
    ],
    'DS' => '/',
    'LAYOUT_ADMIN' => 'admin.layout.app',
    'PAGE_NUMBER' => 20,
    'MAX_FILE_UPLOAD' => 2,
    'MAX_FILE_SIZE_UPLOAD' => 1000, // 1000px
    'URL_PREFIX_PRODUCT' => 'collections',
    'URL_PREFIX_POST' => 'blog',
    'URL_PREFIX_COLLEGE' => 'college',
    'URL_PREFIX_SCHOOL' => 'school',
    'URL_PREFIX_SCHOLARSHIPS' => 'scholarships',
    'URL_PREFIX_TAG' => 'tag',
    'URL_PREFIX_PAGE' => 'page',
    'CONTACT_FORM_ID' => 1,
    'COOKIE_EXPIRED' => 2592000,
    'PRICE_UNIT' => 'vnđ',
    'VERSION' => 1.0,
];
