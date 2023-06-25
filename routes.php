<?php

$router->get('', 'HomeController@index');
$router->get('type-products', 'TypeProductController@index');
$router->post('type-products', 'TypeProductController@save');
//$router->put('type-products', 'TypeProductController@update');
$router->get('type-taxes', 'TypeTaxController@index');
$router->get('products', 'ProductController@index');
$router->get('sales', 'SaleController@index');
