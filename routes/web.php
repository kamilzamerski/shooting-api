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
 * Shooter
 */
$router->get('/shooter/{id}', 'ShooterController@get');
$router->post('/shooter', 'ShooterController@add');
$router->put('/shooter/{id}', 'ShooterController@update');
$router->delete('/shooter/{id}', 'ShooterController@delete');

/**
 * Club
 */
$router->get('/club', 'ClubController@getAll');
$router->get('/club/{id}', 'ClubController@getClub');
$router->post('/club', 'ClubController@createClub');
$router->put('/club/{id}', 'ClubController@updateClub');
$router->delete('/club/{id}', 'ClubController@deleteClub');

/**
 * Event
 */
$router->get('/event/{id}', 'EventController@get');
$router->post('/event', 'EventController@add');
$router->put('/event/{id}', 'EventController@update');
$router->delete('/event/{id}', 'EventController@delete');

/**
 * Result
 */
$router->get('/result/{id}', 'ResultController@get');
$router->post('/result', 'ResultController@add');
$router->put('/result/{id}', 'ResultController@update');
$router->delete('/result/{id}', 'ResultController@delete');