<?php
/**
 * User: Warlof Tutsimo <loic.leuilliot@gmail.com>
 * Date: 21/04/2017
 * Time: 23:12
 */

Route::group([
    'namespace' => 'Warlof\Seat\SeatWeather\Http\Controllers',
    'middleware' => ['web', 'auth', 'bouncer:superuser'],
    'prefix'     => 'seat-weather',
], function(){

    Route::get('/', [
        'as' => 'seat-weather.configuration',
        'uses' => 'ConfigurationController@getConfiguration',
    ]);

    Route::post('/', [
        'as' => 'seat-weather.configuration.post',
        'uses' => 'ConfigurationController@postConfiguration',
    ]);

});
