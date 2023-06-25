<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/src/config/database.php';

class CrudQuerys {
   public function get($table, $id = null) {
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

   public function create(array $cols, string $table) {
      $columns = implode(',', array_values($cols));
      $values = "?";

      foreach ($cols as $key => $col) {
         if ($key > 1) {
            $values .= ",?";
         }
      }
      $sql = "INSERT INTO $table({$columns}) VALUES ($values)";

     
      try {
         $database = new Database();

         $connection = $database->connection();
         $statement = $connection->prepare($sql);
         $count = 1;
         foreach ($cols as $key => $value) {
            $statement->bindParam($count, $value, PDO::PARAM_STR);
            $count++;
         }

         $statement->execute();
         $connection = null;
         return true;
      } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
      }
   }

   public function update(array $columns, string $table, int $id) {
      try {
         $cols = "";
         $database = new Database();
         $connection = $database->connection();

         foreach ($columns as $key => $col) {
            if ($key === 1) {
               $cols .= $col . " = ?";
            } else {
               $cols .= ", " . $col . " = ?";
            }
         }
         $sql = "UPDATE products set $cols WHERE id = ?";

         $statement = $connection->prepare($sql);

         foreach ($columns as $key => $col) {
            $statement->bindParam($key, $col, PDO::PARAM_STR);
         }
         $index_id = count($columns) + 1;
         $statement->bindParam($index_id, $id, PDO::PARAM_INT);
         $statement->execute();
         $connection = null;
         return true;
      } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
      }
   }

   public function delete(string $table, int $id): bool {
      $sql = "DELETE FROM ? WHERE id = ?";
      try {
         $database = new Database();

         $connection = $database->connection();
         $statement = $connection->prepare($sql);
         $statement->bindParam(1, $table, PDO::PARAM_STR);
         $statement->bindParam(2, $id, PDO::PARAM_INT);
         $statement->execute();
         $connection = null;
         return true;
      } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
      }
   }
}
