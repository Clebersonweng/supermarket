<?php

require '../DatabaseTransactions.php';

class Sales
{
   public $total;
   public $totalTaxes;
   public $n_price;
   public $n_id_product;
   public $n_id;
   private $db;
   public function __construct()
   {
   }

   public function addSales($n_type_product, $n_percent)
   {
      $n_type_product = filter_var($n_type_product, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $n_percent = filter_var($n_percent, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $db = new DatabaseTransactions();
      $inserted = $db->insertSales($n_type_product);
      if ($inserted) {
         return "Successfully inserted";
      } else {
         return "Something went wrong insertion didnot happen";
      }
   }

   public function viewSales()
   {
      $db = new DatabaseTransactions();
      $result = $db->select("sales");
      if ($result) {
         return $result;
      } else {
         return "No results returned";
      }
   }

   public function viewSale($id)
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

   public function editSale($id, $event_name, $description)
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

   public function deleteSale($id)
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