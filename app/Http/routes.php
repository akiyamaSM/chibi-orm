<?php

$router->get('/', 'App\Controllers\HomeController@menu');

$router->get('/customer/edit', 'App\Controllers\CustomerController@edit');
$router->get('/customer/list', 'App\Controllers\CustomerController@listAction');
$router->post('/customer/save', 'App\Controllers\CustomerController@save');

$router->get('/product/edit', 'App\Controllers\ProductController@edit');
$router->get('/product/list', 'App\Controllers\ProductController@listAction');
$router->post('/product/save', 'App\Controllers\ProductController@save');

$router->get('/home/user', 'App\Controllers\HomeController@index');
$router->get('/home/json', 'App\Controllers\HomeController@json');

$router->post('/home', function(){
    echo 'Posted';
});

$router->get('/test', function(){
   $customer = new \App\Models\Customer();
   $customer->name = "Houssain";
});

