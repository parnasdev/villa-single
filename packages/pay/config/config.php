<?php
return [
    'enums' => [
        'types' => [
            array('name' => 'payment' , 'label' => 'پرداخت' , 'id' => 3)
        ],
        'status' => [
            'successful' => 7,
            'unsuccessful' => 8,
            'cancel' => 9,
        ],
        'banks' => array(
            array(
                'name' => 'بانک ملّی ایران',
                'code' => array('603799'),
                'logo' => '/images/bankLogo/logoMeli.png'
            ),
            array(
                'name' => 'بانک سپه',
                'code' => array('589210'),
                'logo' => '/images/bankLogo/logoSepah.png'
            ),
            array(
                'name' => 'بانک صنعت ومعدن',
                'code' => array('637961'),
                'logo' => '/images/bankLogo/logoSanaateAndMadan.png'
            ),
            array(
                'name' => 'بانک کشاورزی',
                'code' => array('603770' , '639217'),
                'logo' => '/images/bankLogo/logoKeshavrzi.png'
            ),
            array(
                'name' => 'بانک مسکن',
                'code' => array('628023'),
                'logo' => '/images/bankLogo/logomaskan.png'
            ),
            array(
                'name' => 'بانک توسعه صادرات ایران',
                'code' => array('627648' , '207177'),
                'logo' => '/images/bankLogo/logoExportDevelopmentBankOfIran.png'
            ),
            array(
                'name' => 'بانک توسعه تعاون',
                'code' => array('502908'),
                'logo' => '/images/bankLogo/logoToseeTavon.png'
            ),
            array(
                'name' => 'پست بانک ایران',
                'code' => array('627760'),
                'logo' => '/images/bankLogo/logoPostBank.png'
            ),
            array(
                'name' => 'بانک اقتصاد نوین',
                'code' => array('627412'),
                'logo' => '/images/bankLogo/logoEnBank.png'
            ),
            array(
                'name' => 'بانک پارسیان',
                'code' => array('622106' , '639194' , '627884'),
                'logo' => '/images/bankLogo/logoParsianBank.png'
            ),
            array(
                'name' => 'بانک کارآفرین',
                'code' => array('627488' , '502910'),
                'logo' => '/images/bankLogo/logoKarAfarin.png'
            ),
            array(
                'name' => 'بانک سامان',
                'code' => array('621986'),
                'logo' => '/images/bankLogo/logoSamanBank.png'
            ),
            array(
                'name' => 'بانک سینا',
                'code' => array('639346'),
                'logo' => '/images/bankLogo/logoSinaBank.png'
            ),
            array(
                'name' => 'بانک شهر',
                'code' => array('502806'),
                'logo' => '/images/bankLogo/logoSharBank.png'
            ),
            array(
                'name' => 'بانک دی',
                'code' => array('502938'),
                'logo' => '/images/bankLogo/logoDeBank.png'
            ),
            array(
                'name' => 'بانک صادرات',
                'code' => array('603769'),
                'logo' => '/images/bankLogo/logoSaderatBank.png'
            ),
            array(
                'name' => 'بانک ملت',
                'code' => array('610433'),
                'logo' => '/images/bankLogo/logoBankMellat.png'
            ),
            array(
                'name' => 'بانک تجارت',
                'code' => array('627353'),
                'logo' => '/images/bankLogo/logoTejaratBank.png'
            ),
            array(
                'name' => 'بانک رفاه',
                'code' => array('589463'),
                'logo' => '/images/bankLogo/logorefah.png'
            ),
            array(
                'name' => 'بانک حکمت ایرانیان',
                'code' => array('636949'),
                'logo' => '/images/bankLogo/logoBankHekmatIranian.png'
            ),
            array(
                'name' => 'بانک گردشکری',
                'code' => array('505416'),
                'logo' => '/images/bankLogo/logoRar_bgardeshgari.png'
            ),
            array(
                'name' => 'بانک ایران زمین',
                'code' => array('505785'),
                'logo' => '/images/bankLogo/logoZaminBank.png'
            ),
            array(
                'name' => 'بانک قوامین',
                'code' => array('639599'),
                'logo' => '/images/bankLogo/logoGavamin.png'
            ),
            array(
                'name' => 'بانک انصار',
                'code' => array('627381'),
                'logo' => '/images/bankLogo/logoAnsarBank.png'
            ),
            array(
                'name' => 'بانک سرمایه',
                'code' => array('639607'),
                'logo' => '/images/bankLogo/logoBankSarmaye.png'
            ),
            array(
                'name' => 'بانک پاسارگاد',
                'code' => array('639347' , '502229'),
                'logo' => '/images/bankLogo/logoBankPasargard.png'
            ),
        ),
    ],
    'sidebar' => [
        'title' => 'پرداخت ها',
        'icon' => '',
        'route' => '',
        'links' => array(
            array(
                'title' => 'همه',
                'route' => 'admin.payments.index',
                'can' => 'payments.read',
            ),
            array(
                'title' => 'تنظیمات',
                'route' => 'admin.payments.setting',
                'can' => 'payments.setting',
            ),
        ),
        'can' => 'payments',
        'order' => 3
    ],
    'defaults' => [
        'statuses' => [
            array('name' => 'successful', 'type' => 3, 'label' => 'پرداخت موفق', 'color' => '#4BB543'),
            array('name' => 'unsuccessful', 'type' => 3, 'label' => 'پرداخت ناموفق', 'color' => '#FFCC00'),
            array('name' => 'cancel', 'type' => 3, 'label' => 'لغو پرداخت', 'color' => '#FFCC00'),
        ],
        'permission' => array(
            array('id' => 41,'name' => 'payments.read', 'label' => 'دیدن تراکنش ها'),
            array('id' => 42,'name' => 'payments.setting', 'label' => 'تنظیمات پرداخت ها'),
        ),
        'permission_role' => array(
            array('role_id' => 1, 'permission_id' => [41 , 42]),
        ),
        'settings' => [
           'ports' => ['zarinpal'],
           'atmCart' => [
               'active' => false,
               'items' => []
           ]
        ]
    ],
];
