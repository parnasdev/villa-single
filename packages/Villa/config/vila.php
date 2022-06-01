<?php
return [
    'type' => [
        array('name' => 'residence', 'label' => 'اقامتگاه', 'id' => 2),
        array('name' => 'residence_reserve', 'label' => 'رزرو اقامتگاه', 'id' => 3),
        array('name' => 'view', 'label' => 'چشم انداز', 'id' => 4),
        array('name' => 'position', 'label' => 'موقعیت', 'id' => 5)
    ],
    'reserve_status' => [
        array('name' => 'reserve', 'type' => 3, 'label' => 'با موفقیت رزرو شد', 'color' => '#4BB543'),
        array('name' => 'pending Approve', 'type' => 3, 'label' => 'در انتظار تایید صاحب ویل', 'color' => '#FFCC00'),
        array('name' => 'pending Pay', 'type' => 3, 'label' => 'در انتظار پرداخت', 'color' => '#FFCC00'),
        array('name' => 'draft', 'type' => 3, 'label' => 'کنسل', 'color' => '#c91d12'),
    ],
    'permission' => array(
        array('id' => 33, 'name' => 'residences.read', 'label' => 'خواندن اقامتگاه ها', 'is_default' => true),
        array('id' => 34, 'name' => 'residences.create', 'label' => 'ایجاد اقامتگاه ها', 'is_default' => true),
        array('id' => 35, 'name' => 'residences.edit', 'label' => 'ویرایش اقامتگاه ها', 'is_default' => true),
        array('id' => 36, 'name' => 'residences.delete', 'label' => 'حذف اقامتگاه ها', 'is_default' => true),
        array('id' => 37, 'name' => 'residences.status', 'label' => 'تغییر وضعیت اقامتگاه ها', 'is_default' => true),

        array('id' => 38, 'name' => 'residence_reserves.read', 'label' => 'خواندن رزرو اقامتگاه ها', 'is_default' => true),
        array('id' => 39, 'name' => 'residence_reserves.create', 'label' => 'ایجاد رزرو اقامتگاه ها', 'is_default' => true),
        array('id' => 40, 'name' => 'residence_reserves.edit', 'label' => 'ویرایش رزرو اقامتگاه ها', 'is_default' => true),
        array('id' => 41, 'name' => 'residence_reserves.delete', 'label' => 'حذف رزرو اقامتگاه ها', 'is_default' => true),
        array('id' => 42, 'name' => 'residence_reserves.status', 'label' => 'تغییر وضعیت رزرو اقامتگاه ها', 'is_default' => true),
    ),
    'permission_role' => array(
        array('role_id' => 1, 'permission_id' => [33, 34, 35, 36, 37, 38, 39, 40, 41, 42]),
    ),
    'settings' => [
        'residences' => 'اقامتگاه-ها',
    ],
    'pages' => [
        array(
            'title' => 'اقامتگاه ها',
            'slug' => 'اقامتگاه-ها',
            'description' => '',
            'body' => '',
            'options' => [],
            'status_id' => 4,
        )
    ], 'types' =>

        array(array(
            'title' => 'ویلایی همسطح',
            'id' => 1,
            'type' => 1
        ), array(
            'title' => 'ویلایی دوبلکس',
            'id' => 2,
            'type' => 1
        ), array(
            'title' => 'ویلایی تریبلکس',
            'id' => 3,
            'type' => 1
        ), array(
            'title' => 'آپارتمانی (یک واحد)',
            'id' => 4,
            'type' => 2
        ), array(
            'title' => 'آپارتمانی (چند واحد)',
            'id' => 5,
            'type' => 2
        ), array(
            'title' => 'کلبه جنگلی همسطح',
            'id' => 6,
            'type' => 3
        ), array(
            'title' => 'کلبه جنگلی چوبی',
            'id' => 7,
            'type' => 3
        ), array(
            'title' => 'کلبه جنگلی گلی',
            'id' => 8,
            'type' => 3
        ), array(
            'title' => 'روستایی',
            'id' => 9,
            'type' => 4
        ), array(
            'title' => 'سنتی/بومگردی همسطح',
            'id' => 10,
            'type' => 5
        ), array(
            'title' => 'سنتی/بومگردی دوبلکس',
            'id' => 11,
            'type' => 5
        ),
            array(
                'title' => 'مجموع اقامتی',
                'id' => 11,
                'type' => 6
            ),),
    'views' =>
        array(array(
            'title' => 'کوهستان',
            'id' => 1,
        ), array(
            'title' => 'جنگل',
            'id' => 2,
        ), array(
            'title' => 'دریا',
            'id' => 3,
        ), array(
            'title' => 'کوهپایه',
            'id' => 4,
        ),
        ), 'facilities' => array(
            array(
                'icon' => 'fa fa-broom',
                'title' => 'جارو برقی',
                'id' => 1
            ),
            array(
                'icon' => 'fa fa-arrows-alt-v',
                'title' => 'آسانسور',
                'id' => 2
            ), array(
                'icon' => 'fa fa-clinic-medical',
                'title' => 'جعبه کمک‌های اولیه',
                'id' => 3
            ), array(
                'icon' => 'fa fa-church',
                'title' => 'مهر و جانماز',
                'id' => 4
            ), array(
                'icon' => 'fa fa-camera',
                'title' => 'دوربین مداربسته',
                'id' => 5
            ), array(
                'icon' => 'fa fa-tshirt',
                'title' => 'اتو',
                'id' => 6
            ), array(
                'icon' => 'fa fa-chair',
                'title' => 'مبلمان',
                'id' => 7
            ),
            array(
                'icon' => 'fa fa-bath',
                'title' => 'حمام',
                'id' => 8
            ),
            array(
                'icon' => 'fa fa-toilet',
                'title' => 'دستشویی',
                'id' => 9
            ),
            array(
                'icon' => 'fa fa-tv',
                'title' => 'تلویزیون',
                'id' => 10
            ),
            array(
                'icon' => 'fa fa-hdd',
                'title' => 'گیرنده دیجیتال',
                'id' => 11
            ),
    
        )
    ];
