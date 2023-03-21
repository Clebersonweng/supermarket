<?php
class PDOConfig extends PDO
{

   private $engine;
   private $host;
   private $database;
   private $user;
   private $pass;
   private $port;
   private $db;


   public function __construct()
   {
      $this->engine = 'pgsql';
      $this->host = '127.0.0.1';
      $this->database = 'supermarket';
      $this->user = 'postgres';
      $this->pass = 'root';
      $this->port = '5432';
      $dsn = $this->engine . ':dbname=' . $this->database . ';host=' . $this->host . ';port=' . $this->port;
      parent::__construct($dsn, $this->user, $this->pass);
   }
}