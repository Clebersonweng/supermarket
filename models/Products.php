<?php
namespace Supermarket\models;
use Supermarket\models\BaseModel;
class Products extends BaseModel {
   public $n_id;
   public $c_descr;
   public $n_price;
   public $n_id_type_products;

   public function __construct() {

   }

   public static function tableName(): string {
      return 'products';
   }

   public function get_c_descr() {
      return $this->c_descr;
   }

   public function set_c_descr($descr) {
      $this->c_descr = $descr;
   }

   public function get_n_price() {
      return $this->n_price;
   }

   public function set_n_price($price) {
      $this->n_price = $price;
   }

   public function get_n_id_type_products() {
      return $this->n_id_type_products;
   }

   public function set_n_id_type_products($type) {
      $this->n_id_type_products = $type;
   }
   public static function get_all() {
      $sql = '
         SELECT
            products.n_id,
            products.c_descr,
            ROUND(products.n_price,2) AS n_price,
            type_products.descr AS c_type_product_descr,
            type_taxes.n_percent
         FROM
            products
         INNER JOIN type_products on products.n_id_type_products = type_products.n_id
         INNER JOIN type_taxes on type_taxes.n_id_type_products = type_products.n_id
         GROUP BY
            products.c_descr,
            products.n_price,
            type_taxes.n_percent,
            type_products.descr,
            products.n_id
      ';

      $result = self::query($sql);

      if (!$result) {
         return ['data' => [], 'status' => false];
      }
      return ['data' => $result, 'status' => true];
   }
}