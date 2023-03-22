<?php
require_once('config.php');

class DatabaseTransactions extends PDOStatement
{
   private $connection;

   public function __construct()
   {
   }

   private function connection()
   {
      $connection = new PDOConfig();
      if ($connection === false) {
         echo "ERROR: Could not connect. " . error_get_last();
      }
      return $connection;
   }

   public function insertTypeProducts($c_descr)
   {
      $sql = "INSERT INTO type_products(c_descr) VALUES (?)";
      try {
         $connection = $this->connection();
         $statement = $connection->prepare($sql);

         $statement->bindParam(1, $c_descr, PDO::PARAM_STR);

         $statement->execute();
         $connection = null;
         return true;
      } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
      }
   }

   public function insertTypeTaxes($n_type, $n_percent)
   {
      $sql = "INSERT INTO type_taxes(n_id_type_products,n_percent) VALUES (?,?)";
      try {
         $connection = $this->connection();
         $statement = $connection->prepare($sql);

         $statement->bindParam(1, $n_type, PDO::PARAM_STR);
         $statement->bindParam(2, $n_percent, PDO::PARAM_STR);

         $statement->execute();
         $connection = null;
         return true;
      } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
      }
   }

   public function insert_products($c_descr, $n_id_type_products, $n_price)
   {
      $sql = "INSERT INTO products(c_descr,n_id_type_products,n_price) VALUES (?,?,?)";
      try {
         $connection = $this->connection();
         $statement = $connection->prepare($sql);

         $statement->bindParam(1, $c_descr, PDO::PARAM_STR);
         $statement->bindParam(2, $n_id_type_products, PDO::PARAM_STR);
         $statement->bindParam(3, $n_price, PDO::PARAM_STR);

         $statement->execute();
         $connection = null;
         return true;
      } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
      }
   }

   public function insertSales($client = 'ocasional', $total_taxes, $grand_total)
   {
      $sql = "INSERT INTO sales(c_client,n_total_taxes,n_grand_total) VALUES (?,?,?)
         RETURNING n_id
      ";
      try {
         $connection = $this->connection();
         $statement = $connection->prepare($sql);

         $statement->bindParam(1, $client, PDO::PARAM_STR);
         $statement->bindParam(2, $total_taxes, PDO::PARAM_STR);
         $statement->bindParam(3, $grand_total, PDO::PARAM_STR);

         $statement->execute();
         $result = $statement->fetch(PDO::FETCH_ASSOC);
         $connection = null;
         return $result;
      } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
      }
   }

   public function insertSalesDetail($n_id_sales, $n_id_products,$n_quantity,$n_taxes_by_item,$n_subtotal)
   {
      $sql = "INSERT INTO sales_detail(n_id_sales,n_id_products,n_quantity,n_taxes_by_item,n_subtotal) VALUES (?,?,?,?,?)";
      try {
         $connection = $this->connection();
         $statement = $connection->prepare($sql);

         $statement->bindParam(1, $n_id_sales, PDO::PARAM_STR);
         $statement->bindParam(2, $n_id_products, PDO::PARAM_STR);
         $statement->bindParam(3, $n_quantity, PDO::PARAM_STR);
         $statement->bindParam(4, $n_taxes_by_item, PDO::PARAM_STR);
         $statement->bindParam(5, $n_subtotal, PDO::PARAM_STR);

         $statement->execute();
         $connection = null;
         return true;
      } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
      }
   }

   public function select($table, $id = null)
   {
      if (isset($id)) {
         $sql = "SELECT * FROM $table WHERE id = :id";
         try {
            $connection = $this->connection();
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $connection = null;
            return $result;
         } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
         }
      } else {
         $sql =  "SELECT * FROM $table";
         try {
            $connection = $this->connection();
            $statement = $connection->query($sql);
            $result = $statement->fetchAll();
            $connection = null;
            return $result;
         } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
         }
      }
   }

   public function update($c_descr, $id)
   {
      $sql = "UPDATE products set c_descr = ? WHERE id = ?";
      try {
         $connection = $this->connection();
         $statement = $connection->prepare($sql);
         $statement->bindParam(1, $c_descr, PDO::PARAM_STR);
         $statement->bindParam(2, $id, PDO::PARAM_INT);
         $statement->execute();
         $connection = null;
         return true;
      } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
      }
   }

   public function delete($id)
   {
      $sql = "DELETE FROM products WHERE id = ?";
      try {
         $connection = $this->connection();
         $statement = $connection->prepare($sql);
         $statement->bindParam(1, $id, PDO::PARAM_INT);
         $statement->execute();
         $connection = null;
         return true;
      } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
      }
   }

   public function query($sql)
   {
      try {
         $connection = $this->connection();
         $statement = $connection->query($sql);
         $result = $statement->fetchAll();
         $connection = null;
         return $result;
      } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
      }
   }
}