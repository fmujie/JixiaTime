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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['bindings', 'cors'], //添加这个中间件才能使用模型绑定
], function ($api) {
    $api->group(['middleware' => 'api', 'prefix' => 'auth'], function ($api) {
        $api->post('register', 'Auth\AuthController@register');
        $api->post('login', 'Auth\AuthController@login');
        $api->post('logout', 'Auth\AuthController@logout');
        $api->post('refresh', 'Auth\AuthController@refresh');
        $api->post('me', 'Auth\AuthController@me');
    });
    $api->get('ceshi', 'Auth\AuthController@ceshi')->middleware('role:Administer');
    $api->get('/test', 'TestController@test');
});

