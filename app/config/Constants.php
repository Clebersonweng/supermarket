<?php

$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
$appDirectory = __DIR__ . '/..';
$viewDirectory = $rootDirectory . '/views';

//   /Users/cleberson/Documents/proyectos/php/supermarket
if (! defined('ROOTPATH')) {
   define('ROOTPATH', realpath($rootDirectory . '\\/ ') . DIRECTORY_SEPARATOR);
}

// /Users/cleberson/Documents/proyectos/php/supermarket/app/
if (! defined('APP_PATH')) {
   define('APP_PATH', realpath(rtrim($appDirectory, '\\/ ')) . DIRECTORY_SEPARATOR);
}

if (! defined('VIEW_PATH')) {
   define('VIEW_PATH', realpath(rtrim($viewDirectory, '\\/ ')) . DIRECTORY_SEPARATOR);
}


