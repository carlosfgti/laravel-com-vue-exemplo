<?php

// Routes prefix, version API
$this->group(['prefix' => 'v1'], function() {

    // Rota de autenticação
    $this->post('auth', 'Auth\ApiLoginController@authenticate');
$this->apiResource('teste', 'Api\v1\ProductController');
    // Atualização do TOKEN
    $this->post('auth-refresh', 'Auth\ApiLoginController@refreshToken');

    // Rotas autenticadas por token JWT
    $this->group(['middleware' => 'jwt.auth'], function () {
        // Retorna o usuário autenticado pelo token
        $this->get('me', 'Auth\ApiLoginController@getAuthenticatedUser');

        
        // API Products
	    $this->apiResource('products', 'Api\v1\ProductController');
    });
   
});