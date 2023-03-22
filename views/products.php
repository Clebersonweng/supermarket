<?php require "../app/models/products.php"; ?>
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
                     <th scope="col">Produto</th>
                     <th scope="col">Tipo de produto</th>
                     <th scope="col">Preço</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $types = new Products();
                  $result = $types->viewProducts();
                  if (is_string($result)) {
                  ?>
                  <tr>
                     <td colspan="4">Sem dados</td>
                  </tr>
                  <?php
                  } else {
                     foreach ($result as $row) : ?>
                  <tr>
                     <th scope="row"><?php echo $row['n_id']; ?></th>
                     <td><?php echo $row['c_descr']; ?></td>
                     <td><?php echo $row['c_type_product_descr']; ?></td>
                     <td><?php echo round($row['n_price'], 2); ?></td>
                  </tr>
                  <?php endforeach;
                  } ?>
               </tbody>
            </table>
         </div>
         <div id="new" class="tab-pane mb-1 fade">
            <form id="formProducts" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
               enctype="multipart/form-data">
               <div class="form-group row">
                  <label class="col-sm-1 col-form-label" for="exampleFormControlInput1">Produto</label>
                  <div class="col-md-2">
                     <input type="text" class="form-control" id="c_descr" name="c_descr" placeholder="Arroz" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-1 col-form-label" for="exampleFormControlInput1">Tipo</label>
                  <div class="col-md-2">
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
                  <label class="col-sm-1 col-form-label" for="exampleFormControlInput1">Preço</label>
                  <div class="col-md-2">
                     <input type="number" class="form-control" step="0.01" id="n_price" name="n_price" placeholder="5"
                        max="100000" min="0" required>
                  </div>
               </div>

               <div class=" row">
                  <div class="col-md-4 text-center">
                     <button class="btn btn-danger mr-2" id="btn_cancelar">Cancelar</button>
                     <button class="btn btn-primary" type="submit">Guardar</button>
                  </div>
               </div>
            </form>
            <?php
            if (isset($_POST["c_descr"])) {
               $c_descr = filter_var($_POST["c_descr"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               $n_id_type_product = filter_var($_POST["n_id_type_product"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               $n_price = filter_var($_POST["n_price"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

               $types = new Products();
               $result = $types->addProduct($c_descr, $n_id_type_product, $n_price);
               print_r($result);
            }
            ?>
         </div>
      </div>
   </div>
</div>
<?php include "includes/Footer.php"; ?>