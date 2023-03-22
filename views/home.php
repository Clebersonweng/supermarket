<!DOCTYPE html>
<html>
<?php include "includes/Header.php"; ?>

<body>
   <div class="container-fluid">
      <?php include "includes/Navigation.php"; ?>
      <?php isset($content) ? $content : '' ?>
      <div class="jumbotron">
         <h1 class="display-4">Bem vindo ao Supermarket</h1>
         <p class="lead">Excelência em vender barato</p>
      </div>
   </div>
   <?php include "includes/Footer.php"; ?>
</body>

</html>