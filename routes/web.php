<?php

/** @var \Laravel\Lumen\Routing\Router $router */


/**
 * Auth and Register
 */
$router->post('/register', 'Api\Auth\RegisterController@register');
$router->post('/resendCode', 'Api\Auth\RegisterController@resendCode');
$router->post('/auth', 'Api\Auth\AuthController@auth');
$router->post('/logout', 'Api\Auth\AuthController@logout');
$router->get('/me', 'Api\Auth\AuthController@me');
$router->put('/users/cell-confirmed/{identify}', 'Api\UserController@updateCellConfirmed');


$router->group(['middleware' => 'chk_user_auth'], function () use ($router) {
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
    $router->get('/users/{identify}', 'Api\UserController@show');
    $router->put('/users/{identify}', 'Api\UserController@update');
    $router->delete('/users/{identify}', 'Api\UserController@destroy');
    $router->get('/users/address/{identify}', 'Api\UserController@getAddress');
    $router->put('/users/address/{identify}', 'Api\UserController@updateAddress');

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
     * Orders
     */
    $router->get('orders/{order_id}', [
        'middleware' => 'permission:visualizar_ordem', 'uses' => 'Api\OrderController@show',
    ]);
    $router->get('orders/user/{identify}/bar/{bar_id}', [
        'middleware' => 'permission:visualizar_ordens', 'uses' => 'Api\OrderController@index',
    ]);
    $router->post('orders', [
        'middleware' => 'permission:editar_ordem', 'uses' => 'Api\OrderController@store',
    ]);

    /**
     * Payments
     */
    $router->get('/payments/others', [
        'middleware' => 'permission:processar_pagamento', 'uses' => 'Api\PaymentOtherController@index',
    ]);
    $router->get('/payments/getnet/card/{card_id}', [
        'middleware' => 'permission:recuperar_cartao', 'uses' => 'Api\PaymentGetnetController@getCardById',
    ]);
    $router->get('/payments/getnet/card/customer/{customer_id}', [
        'middleware' => 'permission:recuperar_cartao', 'uses' => 'Api\PaymentGetnetController@getCardByCustomerId',
    ]);
    $router->post('/payments/getnet/card', [
        'middleware' => 'permission:salvar_cartao', 'uses' => 'Api\PaymentGetnetController@saveCard',
    ]);
    // $router->post('/payments/getnet/process-payment', [
    //     'middleware' => 'permission:processar_pagamento', 'uses' => 'Api\PaymentGetnetController@processPayment',
    // ]);
    // $router->post('/payments/getnet/process-pix', [
    //     'middleware' => 'permission:processar_pagamento', 'uses' => 'Api\PaymentGetnetController@processPix',
    // ]);
    $router->delete('/payments/getnet/card/{card_id}', [
        'middleware' => 'permission:recuperar_cartao', 'uses' => 'Api\PaymentGetnetController@removeCardById',
    ]);
    $router->get('/payments/getnet/others', [
        'middleware' => 'permission:recuperar_cartao', 'uses' => 'Api\PaymentGetnetController@getOthers',
    ]);
    $router->get('/payments/getnet/brands', [
        'middleware' => 'permission:listar_bandeiras', 'uses' => 'Api\PaymentGetnetController@getBrands',
    ]);
});

/**
 * GETNET - URL de CALLBACK cadastrada
 */
$router->get('/payments/getnet/callback', 'Api\PaymentGetnetController@getCallback');

$router->get('/', function () use ($router) {
    // return $router->app->version();
    return response()->json(['message' => 'API Gateway - Success']);
});
