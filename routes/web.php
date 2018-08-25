<?php

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

$router->get('/', function() use ($router) {
    return $router->app->version();
});


/**
 * Routes for resource news
 */
$router->group(['prefix' => 'news'], function () use ($router) {
    $router->get('/{news_id}/{limit}',  ['uses' => 'NewsController@newsById']);
    $router->get('/limit/{kategori}',  ['uses' => 'NewsController@categoriLimit']);
    $router->get('/categori/{kategori}/{limit}',  ['uses' => 'NewsController@newsCategori']);
    $router->get('/populer',  ['uses' => 'NewsController@newPopuler']);
    $router->get('/new',  ['uses' => 'NewsController@newNews']);
    $router->get('/headline',  ['uses' => 'NewsController@headline']);
    $router->delete('/{id}',  ['uses' => 'NewsController@destroy']);
    $router->put('/{id}',  ['uses' => 'NewsController@update']);
    $router->get('/{id}',  ['uses' => 'NewsController@show']);
    $router->post('/',  ['uses' => 'NewsController@create']);
    $router->get('/',  ['uses' => 'NewsController@index']);
});
$router->group(['prefix' => 'user'], function () use ($router) {
    $router->post('/login', 'UserController@login');
    $router->delete('/{id}',  ['uses' => 'UserController@destroy']);
    $router->put('/{id}',  ['uses' => 'UserController@update']);
    $router->get('/{id}',  ['uses' => 'UserController@show']);
    $router->post('/',  ['uses' => 'UserController@register']);
    $router->get('/',  ['uses' => 'UserController@index']);
});
$router->group(['prefix' => 'categori'], function () use ($router) {
    $router->delete('/{id}',  ['uses' => 'CategorisController@destroy']);
    $router->put('/{id}',  ['uses' => 'CategorisController@update']);
    $router->get('/{id}',  ['uses' => 'CategorisController@show']);
    $router->post('/',  ['uses' => 'CategorisController@store']);
    $router->get('/',  ['uses' => 'CategorisController@index']);
});