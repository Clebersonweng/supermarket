<?php

function view(string $viewName, $context = []) {
   extract($context);
   $filePath = str_replace('.', '/', $viewName);

   $file = "views/{$filePath}.php";

   if ( is_file($file) ) {
      require $file;
   } else {
      //throw new Exception("Not found the view", 1);
      require "views/404.php";
   }
  
}

function partial(string $viewName, $data = []) {
   
   $filePath = str_replace('.', '/', $viewName);
   $file =  "views/{$filePath}.php";

   extract($data);
   ob_start();

   if ( is_file($file) ) {
      include("views/{$filePath}.php");
   } else {
      throw new Exception("Not found the view", 1);
      require "views/404.php";
   }
   
   return ob_get_clean();;
}
