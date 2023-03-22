<?php

require '../DatabaseTransactions.php';

class TypeTaxes
{
   public $n_type_product;
   public $n_percent;
   private $db;
   public function __construct()
   {
   }

   public function addTypeTaxes($n_type_product, $n_percent)
   {
      $n_type_product = filter_var($n_type_product, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $n_percent = filter_var($n_percent, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $db = new DatabaseTransactions();
      $inserted = $db->insertTypeTaxes($n_type_product, $n_percent);
      if ($inserted) {
         return "Successfully inserted";
      } else {
         return "Something went wrong insertion didnot happen";
      }
   }

   public function viewTypeTaxes()
   {
      $db = new DatabaseTransactions();
      $sql = "
         SELECT 
            type_taxes.n_id,
            type_products.c_descr AS c_type_product_descr,
            type_taxes.n_percent
         FROM 
            type_taxes
            inner join type_products on type_products.n_id = type_taxes.n_id_type_products
      ";
      $result = $db->query($sql);
      if ($result) {
         return $result;
      } else {
         return "No results returned";
      }
   }

   public function viewEvent($id)
   {
      $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

      $db = new DatabaseTransactions();
      $result = $db->select($id);
      if ($result) {
         return $result;
      } else {
         return "No results returned";
      }
   }

   public function editEvent($id, $event_name, $description)
   {
      $event_name = filter_var($event_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $description = filter_var($description, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

      $db = new DatabaseTransactions();
      $result = $db->update($event_name, $description, $id);
      if ($result) {
         return true;
      } else {
         return false;
      }
   }

   public function deleteEvent($id)
   {
      $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
      $db = new DatabaseTransactions();
      $result = $db->delete($id);
      if ($result) {
         return "deleted";
      } else {
         return "Something happened event not deleted";
      }
   }
}