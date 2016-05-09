<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//Route::group(['namespace' => '\App\Api\Controllers',], function() {
    /*Route::get('accounts/update/{id}', [
        'uses' => '\App\Api\Controllers\AccountsController@update',
        'as'   => 'update'
    ]);*/
//});

/*
 * API Routes
 */

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group([
        'namespace' => 'App\Api\Controllers',
    ], function ($api) {
        $api->get('get/{id}', [
            'uses' => 'AccountsController@get',
            'as'   => 'get'
        ]);

        $api->get('find', [
            'uses' => 'AccountsController@find',
            'as'   => 'find'
        ]);

        $api->post('create', [
            'uses' => 'AccountsController@create',
            'as'   => 'create'
        ]);

        $api->patch('update/{id}', [
            'uses' => 'AccountsController@update',
            'as'   => 'update'
        ]);

        $api->delete('delete/{id}', [
            'uses' => 'AccountsController@delete',
            'as'   => 'delete'
        ]);
    });
});