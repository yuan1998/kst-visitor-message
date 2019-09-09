<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')
        ->name('admin.home.index');

    $router->get('form_message' , 'FormMessageController@index')
        ->name('admin.form_message.index');

    $router->get('form_message/{id}' , 'FormMessageController@show')
        ->name('admin.form_message.show');

    $router->get('visitor', 'VisitorController@index')
        ->name('admin.visitor.index');
    $router->get('visitor/{type}', 'VisitorController@index')
        ->name('admin.visitor.index');

});
