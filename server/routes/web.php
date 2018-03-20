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

$router->group(['prefix' =>'api'], function() use($router) {
    // USERS
    $router->group(['prefix' => 'users'], function() use($router) {
        $router->get('/', ['as' => 'users', 'uses' => 'UserController@all']);
        $router->post('/', ['as' => 'users', 'uses' => 'UserController@create']);
        $router->get('/{user}', ['as' => 'users.find', 'uses' => 'UserController@find']);
        $router->patch('/{user}', ['as' => 'users', 'uses' => 'UserController@update']);
        $router->delete('/{user}', ['as' => 'users', 'uses' => 'UserController@delete']);
    });

    // CUSTOMERS
    $router->group(['prefix' => 'customers'], function() use($router) {
        $router->get('/', ['as' => 'customers', 'uses' => 'CustomerController@all']);
        $router->post('/', ['as' => 'customers', 'uses' => 'CustomerController@create']);
        $router->get('/{customer}', ['as' => 'customers.find', 'uses' => 'CustomerController@find']);
        $router->patch('/{customer}', ['as' => 'customers', 'uses' => 'CustomerController@update']);
        $router->delete('/{customer}', ['as' => 'customers', 'uses' => 'CustomerController@delete']);
    });

    // ORDERS
    $router->group(['prefix' => 'orders'], function() use($router) {
        $router->get('/', ['as' => 'orders', 'uses' => 'OrderController@all']);
        $router->post('/', ['as' => 'orders', 'uses' => 'OrderController@create']);
        $router->get('/{order}', ['as' => 'orders.find', 'uses' => 'OrderController@find']);
        $router->put('/{order}', ['as' => 'orders.update', 'uses' => 'OrderController@update']);
        $router->delete('/{order}', ['as' => 'orders.delete', 'uses' => 'OrderController@delete']);
    });

    // ENVIRONMENTS
    $router->group(['prefix' => 'environments'], function() use($router) {
        $router->get('/', ['as' => 'environments', 'uses' => 'EnvironmentController@all']);
        $router->post('/', ['as' => 'environments', 'uses' => 'EnvironmentController@create']);
        $router->get('/{environment}', ['as' => 'environments.find', 'uses' => 'EnvironmentController@find']);
        $router->put('/{environment}', ['as' => 'environments.update', 'uses' => 'EnvironmentController@update']);
        $router->delete('/{environment}', ['as' => 'environments.delete', 'uses' => 'EnvironmentController@delete']);
    });

    // ENVIRONMENT_ORDER
    $router->group(['prefix' => 'environments_order'], function() use($router) {
        $router->get('/', ['as' => 'environments_order', 'uses' => 'EnvironmentController@all']);
        $router->post('/{order}', ['as' => 'environments_order', 'uses' => 'EnvironmentController@create']);
        $router->get('/{environment}', ['as' => 'environments_order.find', 'uses' => 'EnvironmentController@find']);
        $router->put('/{environment}', ['as' => 'environments_order.update', 'uses' => 'EnvironmentController@update']);
        $router->delete('/{environment}', ['as' => 'environments_order.delete', 'uses' => 'EnvironmentController@delete']);
    });


    // PRODUCTS
    $router->group(['prefix' => 'products'], function() use($router) {
        $router->get('/', ['as' => 'products', 'uses' => 'ProductController@all']);
        $router->post('/', ['as' => 'products', 'uses' => 'ProductController@create']);
        $router->get('/{product}', ['as' => 'products.find', 'uses' => 'ProductController@find']);
        $router->put('/{product}', ['as' => 'products.update', 'uses' => 'ProductController@update']);
        $router->delete('/{product}', ['as' => 'products.delete', 'uses' => 'ProductController@delete']);
    });

    // ENVIRONMENTPRODUCT
    $router->group(['prefix' => 'environment_product'], function() use($router) {
        $router->get('/', ['as' => 'environment_product', 'uses' => 'EnvironmentProductController@all']);
        $router->post('/{environment}', ['as' => 'environment_product', 'uses' => 'EnvironmentProductController@create']);
        $router->get('/{id}', ['as' => 'environment_product.find', 'uses' => 'EnvironmentProductController@find']);
        $router->put('/{id}', ['as' => 'environment_product.update', 'uses' => 'EnvironmentProductController@update']);
        $router->delete('/{id}', ['as' => 'environment_product.delete', 'uses' => 'EnvironmentProductController@delete']);
    });

});
