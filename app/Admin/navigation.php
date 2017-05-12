<?php

use SleepingOwl\Admin\Navigation\Page;

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//
// AdminNavigation::addPage(\App\User::class)->setTitle('test')->setPages(function(Page $page) {
// 	  $page
//		  ->addPage()
//	  	  ->setTitle('Dashboard')
//		  ->setUrl(route('admin.dashboard'))
//		  ->setPriority(100);
//
//	  $page->addPage(\App\User::class);
// });
//
// // or
//
// AdminSection::addMenuPage(\App\User::class)

return [
    [
        'title' => 'Главная',
        'icon'  => 'fa fa-dashboard',
        'url'   => route('admin.dashboard'),
    ],

    //[
     //   'title' => 'Information',
     //   'icon'  => 'fa fa-exclamation-circle',
     //   'url'   => route('admin.information'),
    //],

    [
        'title'=>'Меню',
        'icon'=>'fa fa-bars',
        'model'=> \App\Menu::class,
        'priority' => 300,
    ],

   // [
     //   'title'=>'Новости <span class="badge alert-info">'.\App\News::count().'</span>',
     //   'icon'=>'fa fa-newspaper-o',
     //   'model'   => \App\News::class,
     //   'priority' => 400,

    //],

    [
        'title'=>'Страници',
        'icon'=>'fa fa-file-text-o',
        'model' => \App\Page::class,
        'priority' => 500,
    ],



    [
        'title'=>'Слайдер',
        'icon'=>'fa fa-picture-o',
        'model'=> \App\Slider::class,
        'priority' => 700,
    ],

    [
        'title'=>'Баннеры',
        'icon'=>'fa fa-square-o',
        'model'=> \App\Banner::class,
        'priority' => 800,
    ],

    [
        'title'=>'Акции',
        'icon'=>'fa fa-star-o',
        'model'=> \App\Stock::class,
        'priority' => 900,
    ],

    [
        'title'=>'Параметры',
        'icon'=>'fa fa-cog',
        'model'=> \App\Settings::class,
        'priority' => 1000,
    ],

    [
        'title'=>'Администраторы',
        'icon'=>'fa fa-user-circle',
        'model'=> \App\AdminUser::class,
        'priority' => 1100,
    ],

   // [
   //     'title'=>'Клиенты <span class="badge alert-info" style="margin-left: 20px">'.\App\UserProfile::count().'</span>',
   //     'icon'=>'fa fa-user-o',
   //     'model'   => \App\UserProfile::class,
    //    'priority' => 1200,

   // ],

   // [
    //    'title'=>'Заказы <span class="badge alert-success">'.\App\Order::count().'</span>',
   //     'icon'=>'fa fa-cart-plus',
    //    'model'   => \App\Order::class,
    //    'priority' => 1300,

    //],

    [
        'title'=>'Статусы заказа',
        'icon'=>'fa fa-thumbs-o-up',
        'model'   => \App\Status::class,
        'priority' => 1400,

    ],

    [
        'title'=>'Статусы ремонта',
        'icon'=>'fa fa-hand-o-right',
        'model'   => \App\StatusRepair::class,
        'priority' => 1500,

    ],

    [
        'title'=>'Выход',
        'icon'=>'fa fa-sign-out',
        'url'   => '/admin/logout',
        'priority' => 2000,

    ]

    // Examples
    // [
    //    'title' => 'Content',
    //    'pages' => [
    //
    //        \App\User::class,
    //
    //        // or
    //
    //        (new Page(\App\User::class))
    //            ->setPriority(100)
    //            ->setIcon('fa fa-user')
    //            ->setUrl('users')
    //            ->setAccessLogic(function (Page $page) {
    //                return auth()->user()->isSuperAdmin();
    //            }),
    //
    //        // or
    //
    //        new Page([
    //            'title'    => 'News',
    //            'priority' => 200,
    //            'model'    => \App\News::class
    //        ]),
    //
    //        // or
    //        (new Page(/* ... */))->setPages(function (Page $page) {
    //            $page->addPage([
    //                'title'    => 'Blog',
    //                'priority' => 100,
    //                'model'    => \App\Blog::class
	//		      ));
    //
	//		      $page->addPage(\App\Blog::class);
    //	      }),
    //
    //        // or
    //
    //        [
    //            'title'       => 'News',
    //            'priority'    => 300,
    //            'accessLogic' => function ($page) {
    //                return $page->isActive();
    //		      },
    //            'pages'       => [
    //
    //                // ...
    //
    //            ]
    //        ]
    //    ]
    // ]
];