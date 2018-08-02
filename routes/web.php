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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


/**
 * Routes for resource news
 */
// $router->group(['prefix' => 'news'], function () use ($router) {
//     $router->get('/all',  ['uses' => 'NewsController@allNews']);

//     $router->get('/{id}', ['uses' => 'NewsController@newsById']);
// });
$router->group(['prefix' => 'news'], function () use ($router) {
    $router->get('/',  ['uses' => 'NewsController@allNews']);
    $router->get('/{news_id}',  ['uses' => 'NewsController@newsById']);
    $router->get('/populer',  ['uses' => 'NewsController@newPopuler']);
});