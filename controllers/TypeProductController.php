<?php

namespace Supermarket\Controllers;

use Exception;
use Supermarket\models\TypeProducts;
use Supermarket\controllers\BaseController;
class TypeProductController extends BaseController {

   public function __construct() {
      parent::__construct();
   }
   public static function index() {
      $model = new TypeProducts();

      $typeProducts = $model::getAll();
      // todo check if data is successfull for render in the view
      $result = (object) $typeProducts['data'];
      try {
         // $jsonData = json_encode($typeProducts['data'],true,JSON_FORCE_OBJECT);
         $content = partial('type-product.index', ['data' => $result]);
         return view('layout.main', ['content' => $content]);
      } catch (Exception $e) {
         require "views/500.php";
      }
   }

   public static function save() {

      //o nome do input na view deve estar igual ao do model para ele poder setar o valor via post e poder fazer o load no model
      $base = new BaseController();
      $base->getPost('descr');

      $model = new TypeProducts();
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

   public static function update() {
      header('Access-Control-Allow-Origin: *');
      header('Content-type: application/json');
      //$descr = $_POST['c_descr'];
      if( file_get_contents('php://input') != '' && count($_POST) == 0 ){
			$_POST = (array)json_decode(file_get_contents('php://input'), true);
		}
         $response = array();
         $response[0] = array(
            'id' => '1',
            'put'=> 'value1',
            'put2'=> $_POST
         );

      echo json_encode($response);  
      die("ok");
   }

}
