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
         echo "ERROR: Could not connect. " . mysqli_connect_error();
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

   public function update($event_name, $description, $id)
   {
      $sql = "UPDATE events set event_name = ?, description = ? WHERE id = ?";
      try {
         $connection = $this->connection();
         $statement = $connection->prepare($sql);
         $statement->bindParam(1, $event_name, PDO::PARAM_STR);
         $statement->bindParam(2, $description, PDO::PARAM_STR);
         $statement->bindParam(3, $id, PDO::PARAM_INT);
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
      $sql = "DELETE FROM events WHERE id = ?";
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