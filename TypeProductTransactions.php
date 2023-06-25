<?php

require '../config/database.php';

class TypeProductTransactions
{
   public function insert($c_descr)
   {
      $sql = "INSERT INTO type_products(c_descr) VALUES (?)";
      try {
         $database = new Database();

         $connection = $database->connection();
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

   public function update(string $c_descr,$n_price, $id)
   {
      $sql = "UPDATE products set c_descr = ?,n_price=? WHERE id = ?";
      try {
         $database = new Database();

         $connection = $database->connection();
         $statement = $connection->prepare($sql);
         $statement->bindParam(1, $c_descr, PDO::PARAM_STR);
         $statement->bindParam(2, $n_price, PDO::PARAM_STR);
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
      $sql = "DELETE FROM products WHERE id = ?";
      try {
         $database = new Database();

         $connection = $database->connection();
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

   public function select($table, $id = null)
   {
      $database = new Database();
      $connection = $database->connection();

      if (isset($id)) {
         $sql = "SELECT * FROM $table WHERE id = :id";
         try {
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
         $sql = "SELECT * FROM $table";
         try {
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
}