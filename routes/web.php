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

//Post
$router -> post ('blogs', 'BlogController@store');
//Read
$router-> get ('blogs', 'BlogController@index');
$router-> get ('/blogs/{id}', 'BlogController@show');
//Update
$router -> put ('blogs/{id}', 'BlogController@update');
//delete
$router -> delete ('blogs/{id}', 'BlogController@destroy');