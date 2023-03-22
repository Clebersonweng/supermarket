<?php
require "../app/models/event.php";
require '../DatabaseTransactions.php';


class TypeProducts
{
   public $c_descr;
   public $c_obs;
   private $db;

   public function __construct()
   {
      echo "aqui estouy ";
   }

   public function addEvent($c_descr, $c_obs)
   {
      $c_descr = $_POST['c_descr'];
      echo "DEU CERTO";
      $c_descr = filter_var($c_descr, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $c_obs = filter_var($c_obs, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $db = new DatabaseTransactions();
      $inserted = $db->insert($c_descr, $c_obs);
      if ($inserted) {
         return "Successfully inserted";
      } else {
         return "Something went wrong insertion didnot happen";
      }
   }

   public function viewEvents()
   {
      //header('Content-Type: application/json; charset=utf-8');


      $db = new DatabaseTransactions();
      $result = $db->select('products');
      $response = array('status' => false, 'data' => array(), 'message' => 'No data');

      if ($result) {

         $dataResult = array();
         $event = new Event();
         $result = $event->viewEvents();

         foreach ($result as $row) {
            $dataResult[] = $row;
         }
         $response = array('status' => true, 'data' => $dataResult, 'message' => 'Success');
         return  json_encode($response);
      } else {
         return json_encode($response);
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

   public function editEvent($id, $c_descr, $description)
   {
      $event_namec_descr = filter_var($c_descr, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $description = filter_var($description, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

      $db = new DatabaseTransactions();
      $result = $db->update($c_descr, $description, $id);
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