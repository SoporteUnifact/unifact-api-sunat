<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v3'], function () use ($router) {
    $router->post('/post','PostController@index');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    // $router->get('products', 'ProductController@index');
    // $router->post('products', 'ProductController@create');
    // $router->get('products/{id}', 'ProductController@show');
    // $router->delete('products/{id}', 'ProductController@destroy');
    // $router->post('products/{id}', 'ProductController@update');
});
