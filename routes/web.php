<?php

/** @var \Laravel\Lumen\Routing\Router $router */


/**
 * Auth and Register
 */
$router->post('/register', 'Api\Auth\RegisterController@register');
$router->post('/auth', 'Api\Auth\AuthController@auth');
$router->post('/logout', 'Api\Auth\AuthController@logout');
$router->get('/me', 'Api\Auth\AuthController@me');


$router->group(['middleware' => 'auth_micro'], function () use ($router) {
    /**
     * Resources
     */
    $router->get('/resources', 'Api\ResourceController@index');

    /**
     * Users
     */
    $router->get('/users/{id}/permissions', 'Api\PermissionUserController@getPermissionsUser');
    $router->post('/users/permissions', 'Api\PermissionUserController@addPermissionUser');
    $router->delete('/users/permissions', 'Api\PermissionUserController@removePermissionUser');
    $router->get('/users', 'Api\UserController@index');
    $router->get('/users/{id}', 'Api\UserController@show');
    $router->put('/users/{id}', 'Api\UserController@update');
    $router->delete('/users/{identify}', 'Api\UserController@destroy');

    /**
     * bars
     */
    $router->post('/bars/{id}/evaluations', 'Api\EvaluationController@store');
    $router->get('/bars', [
        'middleware' => 'permission:visualizar_bares', 'uses' => 'Api\BarController@index',
    ]);
    $router->get('/bars/{id}', [
        'middleware' => 'permission:visualizar_bar', 'uses' => 'Api\BarController@show',
    ]);
    $router->post('/bars', [
        'middleware' => 'permission:editar_bar', 'uses' => 'Api\BarController@store',
    ]);
    $router->put('/bars/{id}', [
        'middleware' => 'permission:editar_bar', 'uses' => 'Api\BarController@update',
    ]);
    $router->delete('/bars/{id}', [
        'middleware' => 'permission:deletar_bar', 'uses' => 'Api\BarController@destroy',
    ]);

    /**
     * categories
     */
    $router->get('/categories', [
        'middleware' => 'permission:visualizar_categorias', 'uses' => 'Api\CategoryController@index',
    ]);
    $router->get('/categories/{id}', [
        'middleware' => 'permission:visualizar_categoria', 'uses' => 'Api\CategoryController@show',
    ]);
    $router->get('/categories/bar/{bar_id}', [
        'middleware' => 'permission:visualizar_categorias', 'uses' => 'Api\CategoryController@barCategories',
    ]);
    $router->post('/categories', [
        'middleware' => 'permission:editar_categoria', 'uses' => 'Api\CategoryController@store',
    ]);
    $router->put('/categories/{id}', [
        'middleware' => 'permission:editar_categoria', 'uses' => 'Api\CategoryController@update',
    ]);
    $router->delete('/categories/{id}', [
        'middleware' => 'permission:deletar_categoria', 'uses' => 'Api\CategoryController@destroy',
    ]);

    /**
     * products
     */
    $router->get('/products', [
        'middleware' => 'permission:visualizar_produtos', 'uses' => 'Api\ProductController@index',
    ]);
    $router->get('/products/{id}', [
        'middleware' => 'permission:visualizar_produto', 'uses' => 'Api\ProductController@show',
    ]);
    $router->get('/products/bar/{bar_id}', [
        'middleware' => 'permission:visualizar_produtos', 'uses' => 'Api\ProductController@barProducts',
    ]);
    $router->post('/products', [
        'middleware' => 'permission:editar_produto', 'uses' => 'Api\ProductController@store',
    ]);
    $router->put('/products/{id}', [
        'middleware' => 'permission:editar_produto', 'uses' => 'Api\ProductController@update',
    ]);
    $router->delete('/products/{id}', [
        'middleware' => 'permission:deletar_produto', 'uses' => 'Api\ProductController@destroy',
    ]);

    /**
     * user favorites products
     */
    $router->get('/products/favorites/bar/{bar_id}/user/{user_id}', [
        'middleware' => 'permission:visualizar_favoritos', 'uses' => 'Api\ProductController@favoritesProducts',
    ]);
    $router->put('/products/favorites/bar/{bar_id}/user/{user_id}', [
        'middleware' => 'permission:editar_favorito', 'uses' => 'Api\ProductController@toggleFavoriteProduct',
    ]);

    /**
     * Payments GETNET
     */
    $router->post('/payments/getnet/process', [
        'middleware' => 'permission:processar_pagamento', 'uses' => 'Api\PaymentGetnetController@processPayment',
    ]);
    $router->get('/payments/getnet/brands', [
        'middleware' => 'permission:listar_bandeiras', 'uses' => 'Api\PaymentGetnetController@getBrands',
    ]);
});


$router->get('/', function () use ($router) {
    // return $router->app->version();
    return response()->json(['message' => 'API Gateway - Success']);
});
