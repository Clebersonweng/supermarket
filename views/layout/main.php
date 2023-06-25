<!DOCTYPE html>
<html>
   <head>
      <?php require "_header.php"; ?>
   </head>
   <body>
      <?php require "_navigation.php"; ?>
      <div class="wrapper">
         <div class="container-fluid">
            <div class="alert d-none z-index-2 mt-3" role="alert" id="alert" style="position:absolute;z-index:50;width:98%"></div>
            <?= $content ?>
         </div>
      </div>
      <?php require "_footer.php"; ?>
   </body>

</html>