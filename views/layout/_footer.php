<?php
   $js = '';
   if (isset($jsFiles)) {
      foreach ($jsFiles as $key => $file) {
         $js .= `<script src="/assets/js/$file"></script>`;
      }
   }
?>

      <footer class="footer fixed-bottom d-flex justify-content-center">
         Copyright &copy <?= date('Y'); ?> All rights reserved   
         <script src="/assets/js/j_jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
         <script src="/assets/js/j_bootstrap.min.js"></script>
         <script src="/assets/js/j_menu.js"></script>
         <script src="/assets/js/j_type_products.js"></script>
         <script src="/assets/js/j_type_taxes.js"></script>
         <script src="/assets/js/j_products.js"></script>
         <script src="/assets/js/j_sales.js"></script>
         <?= $js ?>
      </footer>
   </body>

 </html>