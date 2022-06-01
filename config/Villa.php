<?php
return [
    'type' => [
        array('name' => 'residence' , 'label' => 'اقامتگاه' , 'id' => 2),
        array('name' => 'residence_reserve' , 'label' => 'رزرو اقامتگاه' , 'id' => 3),
        array('name' => 'view' , 'label' => 'چشم انداز' , 'id' => 4),
        array('name' => 'position' , 'label' => 'موقعیت' , 'id' => 5)
    ],
    'reserve_status' => [
        array('name' => 'reserve', 'type' => 3, 'label' => 'با موفقیت رزرو شد', 'color' => '#4BB543'),
        array('name' => 'pending Approve', 'type' => 3, 'label' => 'در انتظار تایید صاحب ویل', 'color' => '#FFCC00'),
        array('name' => 'pending Pay', 'type' => 3, 'label' => 'در انتظار پرداخت', 'color' => '#FFCC00'),
        array('name' => 'draft', 'type' => 3, 'label' => 'کنسل', 'color' => '#c91d12'),
    ],
    'permission' => array(
        array('id' => 33,'name' => 'residences.read', 'label' => 'خواندن اقامتگاه ها','is_default' => true),
        array('id' => 34,'name' => 'residences.create', 'label' => 'ایجاد اقامتگاه ها','is_default' => true),
        array('id' => 35,'name' => 'residences.edit', 'label' => 'ویرایش اقامتگاه ها','is_default' => true),
        array('id' => 36,'name' => 'residences.delete', 'label' => 'حذف اقامتگاه ها','is_default' => true),
        array('id' => 37,'name' => 'residences.status', 'label' => 'تغییر وضعیت اقامتگاه ها','is_default' => true),

        array('id' => 38,'name' => 'residence_reserves.read', 'label' => 'خواندن رزرو اقامتگاه ها','is_default' => true),
        array('id' => 39,'name' => 'residence_reserves.create', 'label' => 'ایجاد رزرو اقامتگاه ها','is_default' => true),
        array('id' => 40,'name' => 'residence_reserves.edit', 'label' => 'ویرایش رزرو اقامتگاه ها','is_default' => true),
        array('id' => 41,'name' => 'residence_reserves.delete', 'label' => 'حذف رزرو اقامتگاه ها','is_default' => true),
        array('id' => 42,'name' => 'residence_reserves.status', 'label' => 'تغییر وضعیت رزرو اقامتگاه ها','is_default' => true),
    ),
    'permission_role' => array(
        array('role_id' => 1, 'permission_id' => [33 , 34 , 35 , 36 , 37  , 38 ,39 , 40 , 41, 42]),
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
    ],
];
