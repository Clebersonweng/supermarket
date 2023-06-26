<?php

namespace Supermarket\Controllers;
use Exception;
use Supermarket\controllers\BaseController;
use Supermarket\models\Products;
use Supermarket\models\TypeTaxes;

class ProductController {
   public static function index() {


      try {
         $model = new Products();
         $products = $model::get_all();

         $modelTypeTaxes = new TypeTaxes();
         $typeProducts = $modelTypeTaxes::getTypeProducts();
         // todo check if data is successfull for render in the view
         $result = (object) $products['data'];

         // $jsonData = json_encode($typeProducts['data'],true,JSON_FORCE_OBJECT);
         $content = partial('products.index', ['data' => $result,'typeProducts'=>$typeProducts]);
         return view('layout.main', ['content' => $content]);
      } catch (Exception $e) {
         require "views/500.php";
      }
   }

   public static function save() {

      //o nome do input na view deve estar igual ao do model para ele poder setar o valor via post e poder fazer o load no model
      $base = new BaseController();
      $base->getPost('n_id_type_products');
      $base->getPost('c_descr');
      $base->getPost('n_price');

      $model = new Products();
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
