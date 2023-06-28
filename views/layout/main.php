<!DOCTYPE html>
<html>
   <head>
      <?php require "_header.php"; ?>
   </head>
   <body>
      <?php require "_navigation.php"; ?>
      <div class="wrapper">
         <div class="container-fluid">
            <?= view('layout._alert') ?>
            <?= $content ?>
         </div>
      </div>
      <?php require "_footer.php"; ?>
   </body>

</html>