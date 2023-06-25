<?php

use Supermarket\models\BaseModel;

class Products extends BaseModel {
   public $c_descr;
   public $n_price;
   public $n_id_type_products;
   public $n_id;

   public function __construct() {

   }

   public static function tableName(): string {
      return 'products';
   }

   public function addProduct($c_descr, $n_id_type_products, $n_price) {
      $n_id_type_products = filter_var($n_id_type_products, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $c_descr = filter_var($c_descr, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $n_price = filter_var($n_price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      //$c_descr, $n_id_type_products, $n_price
      $db = new ProductTransactions();
      $inserted = $db->insert_products($c_descr, $n_id_type_products, $n_price);
      if ($inserted) {
         return "Successfully inserted";
      } else {
         return "Something went wrong insertion didnot happen";
      }
   }

   public function viewProducts() {
      $db = new ProductTransactions();
      $sql = "
         SELECT 
            products.n_id,
            products.c_descr,
            products.n_price,
            type_products.c_descr AS c_type_product_descr,
            type_taxes.n_percent
         FROM 
            products 
         INNER JOIN type_products on products.n_id_type_products = type_products.n_id
         INNER JOIN type_taxes on type_taxes.n_id_type_products = type_products.n_id
      GROUP BY 
         products.c_descr,
         products.n_price,
         type_taxes.n_percent,
         type_products.c_descr,
         products.n_id
         ";
      $result = $db->query($sql);
      if ($result) {
         return $result;
      } else {
         return "No results returned";
      }
   }

   public function viewProduct($id) {
      $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

      $db = new ProductTransactions();
      $result = $db->select($id);
      if ($result) {
         return $result;
      } else {
         return "No results returned";
      }
   }

   public function editProduct($id, $event_name, $description) {
      $event_name = filter_var($event_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $description = filter_var($description, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

      $db = new ProductTransactions();
      $result = $db->update($event_name, $description, $id);
      if ($result) {
         return true;
      } else {
         return false;
      }
   }

   public function deleteProduct($id) {
      $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
      $db = new ProductTransactions();
      $result = $db->delete($id);
      if ($result) {
         return "deleted";
      } else {
         return "Something happened event not deleted";
      }
   }
}