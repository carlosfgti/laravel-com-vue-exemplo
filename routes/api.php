<?php

// Routes prefix, version API
$this->group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function() {

    // API Products
	$this->apiResource('products', 'ProductController');
   
});