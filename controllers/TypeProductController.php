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

      $typeProducts = $model::get_all();
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

   public function update() {
      $base = new BaseController();
      $n_id = $base->getPost('n_id');
      $descr = $base->getPost('descr');

      if ( empty($n_id) ) {
         echo_json( ['status'=>false,'msg'=>'Campo Id é obrigatorio.']);
      }

      $model = new TypeProducts();
      $model->load(['n_id'=>$n_id,'descr'=>$descr]);

      $response = ['status'=>false,'msg'=>'fail'];

      if ($model->save()) {
         $response =  ['status'=>true,'msg'=>'Dados armazenados com sucesso.'];
      } else {
         throw new Exception("Error Processing save data", 1);
         $response =  ['status'=>false,'msg'=>'Error ao atualizar os dados do tipo de produto.'];
      }

      echo_json($response);
   }

   public function delete() {
      $base = new BaseController();
      $n_id = $base->getPost('n_id');

      if ( empty($n_id) ) {
         echo_json( ['status'=>false,'msg'=>'Campo Id é obrigatorio.']);
      }

      $model = new TypeProducts();
      $model->load(['n_id'=>$n_id]);

      $response = ['status'=>false,'msg'=>'fail'];

      if ( $model->delete() ) {
         $response =  ['status'=>true,'msg'=>'Registro eliminado com sucesso.'];
      } else {
         throw new Exception("Error Processing delete data", 1);
         $response =  ['status'=>false,'msg'=>'Error ao atualizar os dados do tipo de produto.'];
      }

      echo_json($response);
   }

   public static function getById() {
      $id = isset($_GET['id']) ?  $_GET['id'] : '';

      if (empty($id))
      {
         echo_json(['status'=>false,'msg'=>'Sem id do tipo de produto para trazer']);
      }

      $model = new TypeProducts();
      $data = $model::get(['n_id'=>$id]);

      echo_json(['status'=>true,'data'=>$data]);
   }

}
