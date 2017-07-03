<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('pages', PageController::class);
    $router->resource('news', NewsController::class);
    $router->resource('menu', MenuController::class);
    $router->resource('sliders', SliderController::class);
    $router->resource('statuses', StatusController::class);
    $router->resource('statusrepairs', StatusRepairController::class);
    $router->resource('stocks', StockController::class);
    $router->resource('banners', BannerController::class);
    $router->resource('users', UserController::class);
    //$router->resource('orders', OrderController::class);
    //$router->resource('orderrepairs', OrderRepairController::class);

    $router->get('orders', 'OrderController@index');
    $router->get('orders/{id}/edit', 'OrderController@edit');
    $router->get('orders/{id}', 'OrderController@show');
    $router->put('orders/{id}', 'OrderController@update');
    $router->get('orderrepairs', 'OrderController@index');
    $router->get('orderrepairs/{id}/edit', 'OrderRepairController@edit');
    $router->get('orderrepairs/{id}', 'OrderRepairController@show');
    $router->put('orderrepairs/{id}', 'OrderRepairController@update');

});

