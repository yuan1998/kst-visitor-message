<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function ($api) {
    $api->post('message/{type}', "MessageController@store")
        ->name('api.message.store');

    $api->post('visitor/{type}', "VisitorController@store")
        ->name('api.visitor.store');

    $api->get('custype/{type}' , 'cusTypeController@getKsCusTypeData')
        ->name('api.cusType.getKsCusTypeData');

    $api->get('repush/{type}', 'ApiController@repushData')
        ->name('api.repush.message');

    $api->post('url/get', 'ApiController@getUrl');
});
