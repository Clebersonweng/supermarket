<?php

$router->get('', 'HomeController@index');

$router->post('type-products', 'TypeProductController@save');
$router->post('type-products', 'TypeProductController@update');
$router->post('type-products', 'TypeProductController@delete');
$router->get('type-products', 'TypeProductController@getById');
$router->get('type-products', 'TypeProductController@index');

//$router->put('type-products', 'TypeProductController@update');
$router->get('type-taxes', 'TypeTaxController@index');
$router->post('type-taxes', 'TypeTaxController@save');
$router->get('products', 'ProductController@index');
$router->post('products', 'ProductController@save');
$router->get('sales', 'SaleController@index');
