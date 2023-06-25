<?php

namespace Supermarket\Controllers;

use Supermarket\App\App;
use Exception;

class SaleController {
   public static function index() {
      try {
         $content = partial('sales.index');

         return view('layout.main', ['content'=>$content]);
      } catch (Exception $e) {
         require "views/500.php";
      }
   }
}
