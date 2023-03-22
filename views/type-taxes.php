<?php require "../app/models/typeTaxes.php"; ?>
<?php require "../app/models/typeProducts.php"; ?>
<?php include "includes/Header.php"; ?>

<?php include "includes/Navigation.php"; ?>

<div class="card text-center">
   <div class="card-header">
      <?php include "includes/Submenu.php"; ?>
   </div>
   <div class="card-body p-0">
      <?php isset($content) ? $content : '' ?>
      <div class="tab-content mt-2">
         <div id="list" class="tab-pane fade in active show">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Tipo de produto</th>
                     <th scope="col">Porcentagem</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $types = new TypeTaxes();
                  $result = $types->viewTypeTaxes();
                  if (is_string($result)) {
                  ?>
                  <tr>
                     <td colspan="3"> Sem dados </td>
                  </tr>
                  <?php
                  } else {
                     foreach ($result as $row) : ?>
                  <tr>
                     <th scope="row"><?php echo $row['n_id']; ?></th>
                     <td><?php echo $row['c_type_product_descr']; ?></td>
                     <td><?php echo $row['n_percent']; ?></td>
                  </tr>
                  <?php endforeach;
                  } ?>
               </tbody>
            </table>
         </div>
         <div id="new" class="tab-pane fade">
            <form id="formTypeTaxes" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
               enctype="multipart/form-data">
               <div class="col-md-12 m-2 text-center">
                  <div class="form-group row">
                     <label class=" col-sm-1 col-form-label" for="exampleFormControlInput1">Tipo</label>
                     <div class="col-md-3">
                        <select class="form-control" id="n_id_type_product" name="n_id_type_product" required>
                           <?php
                           $typeProduct = new TypeProducts;
                           $result = $typeProduct->viewTypeProducts();
                           foreach ($result as $row) : ?>
                           <option value="<?php echo $row['n_id']; ?>"><?php echo $row['c_descr']; ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-1 col-form-label" for="exampleFormControlInput1">Porcentagem</label>
                     <div class="col-md-2">
                        <input type="number" class="form-control" step="0.01" id="n_percent" name="n_percent"
                           placeholder="5" max="100" min="0" required>
                     </div>
                  </div>

                  <div class=" row">
                     <div class="col-md-4 text-center">
                        <button class="btn btn-danger mr-2" id="btn_cancelar">Cancelar</button>
                        <button class="btn btn-primary" type="submit" id="btnSaveTaxes">Guardar</button>
                     </div>
                  </div>
            </form>
            <?php
            if (isset($_POST["n_id_type_product"])) {
               $n_id_type_product = filter_var($_POST["n_id_type_product"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               $n_percent = filter_var($_POST["n_percent"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               $types = new TypeTaxes();
               $result = $types->addTypeTaxes($n_id_type_product, $n_percent);
               print_r($result);
               die('ok');
            }
            ?>
         </div>
      </div>
   </div>
</div>
<?php include "includes/Footer.php"; ?>