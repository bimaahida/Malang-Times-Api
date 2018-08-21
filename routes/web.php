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

 
function rest($path, $controller,$router)
{
	$router->get($path, $controller.'@index');
	$router->get($path.'/{id}', $controller.'@show');
	$router->post($path, $controller.'@store');
	$router->put($path.'/{id}', $controller.'@update');
	$router->delete($path.'/{id}', $controller.'@destroy');
}



$router->group(['prefix' => 'news'], function () use ($router) {
    $router->get('/{news_id}/{limit}',  ['uses' => 'NewsController@newsById']);
    $router->get('/limit/{kategori}',  ['uses' => 'NewsController@categoriLimit']);
    $router->get('/categori/{kategori}/{limit}',  ['uses' => 'NewsController@newsCategori']);
    $router->get('/populer',  ['uses' => 'NewsController@newPopuler']);
    $router->get('/new',  ['uses' => 'NewsController@newNews']);
    $router->get('/headline',  ['uses' => 'NewsController@headline']);
    rest('/', 'NewsController',$router);
});
$router->group(['prefix' => 'user'], function () use ($router) {
    $router->post('/login', 'UserController@Login');
    rest('/', 'UserController',$router);
});