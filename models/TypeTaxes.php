<?php

namespace Supermarket\models;

use Supermarket\models\BaseModel;
use Exception;
class TypeTaxes extends BaseModel
{
   public $n_id;
   public $n_id_type_products;
   public $n_percent;

   public function __construct() {

   }

   public static function tableName(): string {
      return 'type_taxes';
   }

   public function validate(): bool {
      if (!strlen($this->n_id_type_products)) {
         $this->setErrors('Tipo de produto', 'Id do tipo de produto é um campo obrigatório.');
      }

      if (!strlen($this->n_percent)) {
         $this->setErrors('Porcentagem', '"Porcentagem" é um campo obrigatório.');
      }
      return empty($this->getErrors());
   }

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
   public function get_n_id_type_products() {
      return $this->n_id_type_products;
   }

   public function set_n_id_type_products($type) {
      $this->n_id_type_products = $type;
   }

   public function get_n_percent() {
      return $this->n_percent;
   }

   public function set_n_percent($percent) {
      $this->n_percent = $percent;
   }

   public static function getAll() {
      $sql = 'SELECT 
                  type_taxes.n_id,
                  type_products.n_id AS n_type_product_id,
                  type_products.descr AS c_type_product_descr,
                  type_taxes.n_percent
               FROM 
                  type_taxes
               INNER JOIN type_products ON type_products.n_id = type_taxes.n_id_type_products
            ';
      $result = self::query($sql);

      if (!$result) {
         return ['data' => [], 'status' => false];
      }
      return ['data' => $result, 'status' => true];
   }
   
   public static function getTypeProducts() {
      try {
         $sql = '
            SELECT 
               *
            FROM 
               type_products
            ';
         
         $result = self::query($sql);

         return $result;

      } catch (\Throwable $th) {
         throw new Exception("Error Processing type tax get type products", 1);
      }    
   }
}
