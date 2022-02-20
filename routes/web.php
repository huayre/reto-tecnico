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
$router->group(['prefix' => 'api/v1'], function () use ($router) {
    //router participant
    $router->get('participant', 'ParticipantController@index');
    $router->post('participant', 'ParticipantController@store');
    $router->put('participant/{id}', 'ParticipantController@update');
    $router->delete('participant/{id}', 'ParticipantController@delete');
    //routes events
    $router->get('event', 'EventController@index');
    $router->post('event', 'EventController@store');
    //routes inscriptions
    $router->get('inscription', 'EventController@listInscription');
    $router->post('inscription', 'EventController@inscription');
});
