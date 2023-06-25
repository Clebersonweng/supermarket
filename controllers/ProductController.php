<?php

namespace Supermarket\Controllers;
use Supermarket\App\App;
use Exception;

class ProductController {
   public static function index() {
      //$tasks = App::get('db')->selectAll('tasks', Task::class);
      
      try {
         $content = partial('products.index');

         return view('layout.main', ['content'=>$content]);
      }
      catch (Exception $e) {
         require "views/500.php";
      }
   }
}
