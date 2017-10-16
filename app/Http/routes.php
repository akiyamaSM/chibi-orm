<?php
$router->get('/home/user', 'App\Controllers\HomeController@index');
$router->get('/home/json', 'App\Controllers\HomeController@json');

$router->post('/home', function(){
    echo 'Posted';
});

$router->get('/test', function(){
   $customer = new \App\Models\Customer();
   $customer->name = "Houssain";
});