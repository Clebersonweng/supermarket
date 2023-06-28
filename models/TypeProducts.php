<?php

namespace Supermarket\models;

use Supermarket\models\BaseModel;

class TypeProducts extends BaseModel {
   public $n_id;
   public $descr;

   public static function tableName(): string {
      return 'type_products';
   }

   public static function getById($table,$id): string {
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

   public static function get_all() {
      $result = self::get([],true);

      if (!$result) {
         return ['data'=>[],'status'=>false];
      }
      return ['data'=> $result,'status'=>true];
   }

}
