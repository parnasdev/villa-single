<?php

return array(
    array(
        'title' => 'داشبورد',
        'route' => 'admin.panel',
        'links' => array(),
        'can' => '',
        'order' => 1
    ),
    array(
        'title' => 'بلاگ ها',
        'route' => '',
        'links' => array(
            array(
                'title' => 'همه',
                'route' => 'admin.posts.index',
                'can' => 'posts.read',
            ),
            array(
                'title' => 'افزودن',
                'route' => 'admin.posts.create',
                'can' => 'posts.create',
            ),
            array(
                'title' => 'دسته بندی',
                'route' => 'admin.categories.index',
                'param' => ["type" => 1],
                'can' => 'categories.read',
            )
        ),
        'can' => 'posts.read',
        'order' => 2
    ),
    array(
        'title' => 'صفحه ها',
        'route' => '',
        'links' => array(
            array(
                'title' => 'همه',
                'route' => 'admin.pages.index',
                'can' => 'pages.read',
            ),
            array(
                'title' => 'افزودن',
                'route' => 'admin.pages.create',
                'can' => 'pages.create',
            )
        ),
        'can' => 'pages.read',
        'order' => 3
    ),
    array(
        'title' => 'منو سایت',
        'route' => '',
        'links' => array(
            array(
                'title' => 'همه',
                'route' => 'admin.links.index',
                'can' => 'links.read',
            ),
            array(
                'title' => 'افزودن',
                'route' => 'admin.links.create',
                'can' => 'links.create',
            )
        ),
        'can' => 'links.read',
        'order' => 4
    ),
    array(
        'title' => 'کاربران',
        'route' => '',
        'links' => array(
            array(
                'title' => 'همه',
                'route' => 'admin.users.index',
                'can' => 'users.read',
            ),
            array(
                'title' => 'افزودن',
                'route' => 'admin.users.create',
                'can' => 'users.create',
            ),
            array(
                'title' => 'مقام ها',
                'route' => 'admin.roles.index',
                'can' => 'roles.create',
            )
        ),
        'can' => 'users.read',
        'order' => 5
    ),
    // array(
    //     'title' => 'رزروها',
    //     'route' => 'admin.villa.my-reserves',
    //     'can' => '',
    //     'links' => array(),
    //     'order' => 3
    // ),
    array(
        'title' => 'ویلا',
        'route' => '',
        'links' => array(
            array(
                'title' => 'لیست',
                'route' => 'admin.villa.list',
                'can' => 'villa.read',
            ),
            array(
                'title' => 'افزودن',
                'route' => 'admin.villa.add',
                'can' => 'villa.create',
            ), array(
                'title' => 'درخواست ها',
                'route' => 'admin.villa.reserves',
                'can' => 'reserve.read',
            ),
          

        ),
        'can' => 'villa.read',
        'order' => 6
    ),
);
