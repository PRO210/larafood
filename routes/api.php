<?php

Route::post('/auth/register', 'Api\Auth\RegisterController@store');
Route::post('/auth/token', 'Api\Auth\AuthClientController@auth');

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/auth/me', 'Api\Auth\AuthClientController@me');
    Route::post('/auth/logout', 'Api\Auth\AuthClientController@logout');

    Route::post('/auth/v1/orders/{identifyOrder}/evaluations', 'Api\EvaluationApiController@store');

    Route::get('/auth/v1/my-orders', 'Api\OrderApiController@myOrders');
    Route::post('/auth/v1/orders', 'Api\OrderApiController@store');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::get('/tenants/{uuid}', 'TenantApiController@show');
    Route::get('/tenants', 'TenantApiController@index');

    Route::get('/categories/{identify}', 'CategoryApiController@show');
    Route::get('/categories', 'CategoryApiController@categoriesByTenant');

    Route::get('/tables/{identify}', 'TableApiController@show');
    Route::get('/tables', 'TableApiController@tablesByTenant');

    Route::get('/products/{identify}', 'ProductApiController@show');
    Route::get('/products', 'ProductApiController@productsByTenant');

    Route::post('/orders', 'OrderApiController@store');
    Route::get('/orders/{identify}', 'OrderApiController@show');
});
//http://larafood/api/v1/tenants
//http://larafood/api/v1/tenants?token_company=14e500e2-05a5-45af-a603-05c2df3ea4d8
//http://larafood/api/v1/orders
//http://larafood/api/v1/orders?token_company=14e500e2-05a5-45af-a603-05c2df3ea4d8
//http://larafood/api/v1/tables?token_company=14e500e2-05a5-45af-a603-05c2df3ea4d8
//http://larafood/api/v1/tables?token_company=14e500e2-05a5-45af-a603-05c2df3ea4d8
