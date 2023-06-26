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

      $typeProducts = $model::getTypeProducts();
      // print_r($typeProducts);die;
      try {
         $content = partial('type-taxes.index',['data' => $result,'typeProducts'=>$typeProducts]);

         return view('layout.main', ['content'=>$content]);
      }
      catch (Exception $e) {
         require "views/500.php";
      }
   }

   public static function save() {
      $base = new BaseController();
      $base->getPost('n_id_type_products');
      $base->getPost('n_percent');

      $model = new TypeTaxes();
      $model->load($_POST);

      $new = $model->isNewRecord();
      $response = ['status'=>false,'msg'=>'fail'];

      if ($model->save()) {
         if ($new) {
            $response =  ['status'=>true,'msg'=>'Dados armazenados com sucesso.'];
         } else {
            throw new Exception("Error Processing save data", 1);
            $response =  ['status'=>false,'msg'=>'Error ao armazenar os dados do tipo de produto.'];
         }
      }
      echo_json($response);
   }
}
