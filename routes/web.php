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
    $router->get('/limit/{kategori}',  ['uses' => 'NewsController@categoriLimit']);
    $router->get('/categori/{kategori}',  ['uses' => 'NewsController@newsCategori']);
    $router->get('/populer',  ['uses' => 'NewsController@newPopuler']);
    $router->get('/new',  ['uses' => 'NewsController@newNews']);
    $router->get('/headline',  ['uses' => 'NewsController@headline']);
    $router->get('/{news_id}',  ['uses' => 'NewsController@newsById']);
    $router->get('/',  ['uses' => 'NewsController@allNews']);
});