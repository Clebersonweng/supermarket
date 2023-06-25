<?php

namespace Supermarket\Controllers;
use Supermarket\App\App;
use Supermarket\models\TypeTaxes;
use Exception;

class TypeTaxController {
   public static function index() {
      $model = new TypeTaxes();
      $response = $model::getAll();
      // todo check if data is successfull for render in the view
      $result = $response['data'];

      try {
         $content = partial('type-taxes.index',['data' => $result]);

         return view('layout.main', ['content'=>$content]);
      }
      catch (Exception $e) {
         require "views/500.php";
      }
   }
}
