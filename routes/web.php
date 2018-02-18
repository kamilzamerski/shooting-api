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
$router->group(['middleware' => 'cors.options'], function () use ($router) {
    $router->options('{all:.*}', function () {
        return response('');
    });

    $router->get('/', function () use ($router) {
        return $router->app->version();
    });

    /**
     * Shooter
     */
    $router->get('/shooter', 'ShooterController@all');
    $router->get('/shooter/{id}', 'ShooterController@get');
    $router->post('/shooter', 'ShooterController@add');
    $router->put('/shooter/{id}', 'ShooterController@put');
    $router->delete('/shooter/{id}', 'ShooterController@remove');

    /**
     * Club
     */
    $router->get('/club', 'ClubController@all');
    $router->get('/club/{id}', 'ClubController@get');
    $router->post('/club', 'ClubController@add');
    $router->put('/club/{id}', 'ClubController@put');
    $router->delete('/club/{id}', 'ClubController@remove');

    /**
     * Event
     */
    $router->get('/event', 'EventController@all');
    $router->get('/event/{id}', 'EventController@get');
    $router->post('/event', 'EventController@add');
    $router->put('/event/{id}', 'EventController@put');
    $router->delete('/event/{id}', 'EventController@remove');

    /**
     * Result
     */
    $router->get('/result', 'ResultController@all');
    $router->get('/result/{id}', 'ResultController@get');
    $router->post('/result', 'ResultController@add');
    $router->put('/result/{id}', 'ResultController@put');
    $router->delete('/result/{id}', 'ResultController@remove');

    /**
     * Routes for resource member
     */
    $router->get('member', 'MemberController@all');
    $router->get('member/{id}', 'MemberController@get');
    $router->post('member', 'MemberController@add');
    $router->put('member/{id}', 'MemberController@put');
    $router->delete('member/{id}', 'MemberController@remove');
});