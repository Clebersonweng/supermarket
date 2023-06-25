<?php

namespace Supermarket\models;

use Supermarket\models\BaseModel;

class TypeTaxes extends BaseModel
{
   public $nId;
   public $nIdTypeProducts;
   public $nPercent;

   public function __construct()
   {
   }

   public static function tableName(): string
   {
      return 'type_taxes';
   }

   public function validate(): bool
   {
      if (!strlen($this->nIdTypeProducts)) {
         $this->setErrors('Descrição', '"Descrição" é um campo obrigatório.');
      }

      if (!strlen($this->nPercent)) {
         $this->setErrors('Descrição', '"Descrição" é um campo obrigatório.');
      }
      return empty($this->getErrors());
   }

   /**
    * @return int|null
    */
    public function getn_id() {
      return $this->n_id;
   }
   
   public function setn_id($id) {
      $this->n_id = $id;
   }

   /**
    * @return int|null
    */
   public function getnIdTypeProducts()
   {
      return $this->nIdTypeProducts;
   }

   public function setnIdTypeProducts($type)
   {
      $this->nIdTypeProducts = $type;
   }

   public function getNPercent()
   {
      return $this->nIdTypeProducts;
   }

   public function setNPercent($percent)
   {
      $this->nPercent = $percent;
   }

   public static function getAll()
   {
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
}
