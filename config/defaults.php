<?php

return [
    'statuses' => [
        array('name' => 'publish', 'type' => 1, 'label' => 'انتشار', 'color' => '#4BB543'),
        array('name' => 'pending', 'type' => 1, 'label' => 'در انتظار', 'color' => '#FFCC00'),
        array('name' => 'draft', 'type' => 1, 'label' => 'پیش نویس', 'color' => '#FFCC00'),
    ],
    'roles' => [
        array('name' => 'admin', 'label' => 'مدیر کل سایت', 'is_access_panel' => true , 'is_access_dashboard' => false , 'is_custom' => false , 'custom_route_name_access' => null , 'see_all_post' => true , 'is_default' => true),
        array('name' => 'writer', 'label' => 'نویسنده', 'is_access_panel' => true , 'is_access_dashboard' => false , 'is_custom' => false , 'custom_route_name_access' => null, 'see_all_post' => true, 'is_default' => true),
        array('name' => 'user', 'label' => 'کاربر', 'is_access_panel' => false , 'is_access_dashboard' => true , 'is_custom' => false , 'custom_route_name_access' => null, 'see_all_post' => false, 'is_default' => true),
    ],
    'permission' => array(
        array('id' => 1,'name' => 'posts.read', 'label' => 'خواندن نوشته ها'),
        array('id' => 2,'name' => 'posts.create', 'label' => 'ایجاد نوشته ها'),
        array('id' => 3,'name' => 'posts.edit', 'label' => 'ویرایش نوشته ها'),
        array('id' => 4,'name' => 'posts.delete', 'label' => 'حذف نوشته ها'),
        array('id' => 5,'name' => 'posts.status', 'label' => 'تغییر وضعیت نوشته ها'),

        array('id' => 6,'name' => 'categories.read', 'label' => 'خواندن دسته بندی ها'),
        array('id' => 7,'name' => 'categories.create', 'label' => 'ایجاد دسته بندی ها'),
        array('id' => 8,'name' => 'categories.edit', 'label' => 'ویرایش دسته بندی ها'),
        array('id' => 9,'name' => 'categories.delete', 'label' => 'حذف دسته بندی ها'),

        array('id' => 10,'name' => 'links.read', 'label' => 'خواندن منو ها'),
        array('id' => 11,'name' => 'links.create', 'label' => 'ایجاد منو ها'),
        array('id' => 12,'name' => 'links.edit', 'label' => 'ویرایش منو ها'),
        array('id' => 13,'name' => 'links.delete', 'label' => 'حذف منو ها'),

        array('id' => 14,'name' => 'pages.read', 'label' => 'خواندن صفحه ها'),
        array('id' => 15,'name' => 'pages.create', 'label' => 'ایجاد صفحه ها'),
        array('id' => 16,'name' => 'pages.edit', 'label' => 'ویرایش صفحه ها'),
        array('id' => 17,'name' => 'pages.delete', 'label' => 'حذف صفحه ها'),
        array('id' => 18,'name' => 'pages.status', 'label' => 'تغییر وضعیت صفحه ها'),

        array('id' => 19,'name' => 'roles.read', 'label' => 'خواندن مقام ها'),
        array('id' => 20,'name' => 'roles.create', 'label' => 'ایجاد مقام ها'),
        array('id' => 21,'name' => 'roles.edit', 'label' => 'ویرایش مقام ها'),
        array('id' => 22,'name' => 'roles.delete', 'label' => 'حذف مقام ها'),

        array('id' => 23,'name' => 'settings.read', 'label' => 'خواندن تنظیمات ها'),
        array('id' => 24,'name' => 'settings.edit', 'label' => 'ویرایش تنظیمات ها'),

        array('id' => 25,'name' => 'tags.read', 'label' => 'خواندن تگ ها'),
        array('id' => 26,'name' => 'tags.create', 'label' => 'ایجاد تگ ها'),
        array('id' => 27,'name' => 'tags.edit', 'label' => 'ویرایش تگ ها'),
        array('id' => 28,'name' => 'tags.delete', 'label' => 'حذف تگ ها'),

        array('id' => 29,'name' => 'users.read', 'label' => 'خواندن کاربر ها'),
        array('id' => 30,'name' => 'users.create', 'label' => 'ایجاد کاربر ها'),
        array('id' => 31,'name' => 'users.edit', 'label' => 'ویرایش کاربر ها'),
        array('id' => 32,'name' => 'users.delete', 'label' => 'حذف کاربر ها'),

        array('id' => 33,'name' => 'comments.read', 'label' => 'خواندن نظرات'),
        array('id' => 34,'name' => 'comments.approved', 'label' => 'تایید نظرات'),
        array('id' => 35,'name' => 'comments.reply', 'label' => 'پاسخ نظرات'),
        array('id' => 36,'name' => 'comments.delete', 'label' => 'حذف نظرات'),
    ),
    'permission_role' => array(
        array('role_id' => 1, 'permission_id' => [1, 2, 3, 4, 5, 6, 7, 8 , 9 , 10 , 11 , 12, 13 , 14, 15, 16, 17, 18, 19, 20, 21 , 22 , 23 , 24 , 25 , 26 , 27 , 28 , 29 , 30, 31 , 32 , 33 , 34, 35 , 36]),
        array('role_id' => 2, 'permission_id' => [1,2,3,4,5,6,7,8,23,24,25,26])
    ),
    'settings' => [
        'siteDescription' => '',
        'siteIcon' => '',
        'siteLogos' => [
            'light' => '',
            'dark' => ''
        ],
        'footer' => [
            'icon' => '',
            'description' => ''
        ],
        'socialLinks' => [],
        'metas' => [],
        'subscription' => null,
        'home' => 'صفحه-اصلی',
        'posts' => 'نوشته-ها',
        'extra' => null
    ],
    'posts' => [
        array(
            'title' => 'صفحه اصلی',
            'description' => '',
            'body' => '',
            'post_type' => 'page',
            'status_id' => 1,
        ),
        array(
            'title' => 'نوشته ها',
            'description' => '',
            'body' => '',
            'post_type' => 'page',
            'status_id' => 1,
        ),
        array(
            'title' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ',
            'description' => '',
            'body' => '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>',
            'post_type' => 'post',
            'status_id' => 1,
        )
    ],
    'menus' => [
        array(
            'type' => 'header',
            'used' => true,
            'children' => [
                array(
                    'title' => 'خانه' ,
                    'icon' => null,
                    'parent' => null,
                    'href' => '/',
                    'is_link' => true,
                    'image' => null,
                    'order_item' => 0
                )
            ]
        )
    ]
];
