<?php

namespace Supermarket\models;

use Supermarket\models\BaseModel;

class TypeProducts extends BaseModel {
   public $n_id;
   public $descr;

   public static function tableName(): string {
      return 'type_products';
   }

   public function __construct() {
      
   }
   // so agrega se for fazer um overrinding
   // public function validate(): bool {
   //    if (!strlen($this->descr)) {
   //       $this->setErrors('Descrição', '"Descrição" é um campo obrigatório.');
   //    }
   //    return empty($this->getErrors());
   // }
   
   /**
    * @return int|null
    */
   public function get_n_id() {
      return $this->n_id;
   }
   
   public function set_n_id($id) {
      $this->n_id = $id;
   }

   /**
    * @return int|null
    */
   public function get_descr() {
      return $this->descr;
   }
   
   public function set_descr($descr) {
      $this->descr = $descr;
   }

   public static function getAll() {
      $result = self::get([],true);

      if (!$result) {
         return ['data'=>[],'status'=>false];
      } 
      return ['data'=> $result,'status'=>true];
   }

   public function viewEvent($id) {
      // $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

      // $result = $this->get($id);
      // if ($result) {
      //    return $result;
      // } else {
      //    return "No results returned";
      // }
   }

   public function editEvent($id, $event_name, $description): bool {
      // $c_descr = filter_var($description, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      // $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

      // $result = $this->update(['c_descr' => $c_descr], "type_products", $id);
      // if ($result) {
      //    return true;
      // } else {
      //    return false;
      // }
      return true;
   }

   public function deleteTypeProducts($id): bool {
      // $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
      // $result = $this->delete("type_products", $id);

      // if ($result) {
      //    return true;
      // } else {
      //    return false;
      // }
      return true;
   }
}
