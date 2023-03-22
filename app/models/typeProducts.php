<?php

require '../DatabaseTransactions.php';

class TypeProducts
{
   public $c_descr;
   private $db;
   public function __construct()
   {
   }

   public function addTypeProduct($c_descr)
   {
      $c_descr = filter_var($c_descr, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $db = new DatabaseTransactions();
      $inserted = $db->insertTypeProducts($c_descr);
      if ($inserted) {
         return "Successfully inserted";
      } else {
         return "Something went wrong insertion didnot happen";
      }
   }

   public function viewTypeProducts()
   {
      $db = new DatabaseTransactions();
      $result = $db->select("type_products");
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