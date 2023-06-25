<?php

use Supermarket\models\BaseModel;

require '../DatabaseTransactions.php';

class Sales extends BaseModel {
   public $total;
   public $totalTaxes;
   public $n_price;
   public $n_id_product;
   public $n_id;
   private $db;
   public function __construct() {

   }

   public static function tableName(): string {
      return 'sales';
   }

   public function addSales($data) {
      $data_decode = json_decode($data, true);

      $db = new DatabaseTransactions();
      $grand_total = 0;
      $total_taxes = 0;

      $inserted = false;
      foreach ($data_decode as $value) {
         $grand_total += round($value["price"] * $value["quantity"], 8);
         $total_taxes += round(($value["price"] * ($value["percent_tax"] / 100)), 8);
      }
      //pelo certo seria a cabeceira e recorrer os detalles dos items
      $resultSale = $db->insertSales($client = 'ocasional', $total_taxes, $grand_total);
      
      if($resultSale) {
         $sale_id = $resultSale["n_id"];
         //sales detail
         foreach ($data_decode as $value) {
            $subtotal = $value["price"] * $value["quantity"];
            $inserted = $db->insertSalesDetail($sale_id, $value["productId"],$value["quantity"], $value["taxesByItem"],$subtotal); 
         }
      }     

      if ($inserted) {
         return "Successfully inserted";
      } else {
         return "Something went wrong insertion didnot happen";
      }
   }

   public function viewSales() {
      $db = new DatabaseTransactions();
      $result = $db->select("sales");
      if ($result) {
         return $result;
      } else {
         return "No results returned";
      }
   }
}