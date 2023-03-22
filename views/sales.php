<?php require "../app/models/products.php"; ?>
<?php require "../app/models/sales.php"; ?>
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
                     <th scope="col">Cliente</th>
                     <th scope="col">Total Impostos</th>
                     <th scope="col">Total Geral</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $types = new Sales();
                  $result = $types->viewSales();
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
                     <td><?php echo $row['c_client']; ?></td>
                     <td><?php echo round($row['n_total_taxes'], 2); ?></td>
                     <td><?php echo round($row['n_grand_total'], 2); ?></td>
                  </tr>
                  <?php endforeach;
                  } ?>
               </tbody>
            </table>
         </div>
         <div id="new" class="tab-pane fade">

            <form class="m-1" id="formSales" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
               method="post" enctype="multipart/form-data">
               <div class="form-row">
                  <div class="form-group col-md-4">
                     <label for="n_id_product_sale">Produto</label>
                     <select class="form-control" id="n_id_product_sale" required>
                        <option value=""> </option>
                        <?php
                        $products = new Products;
                        $result = $products->viewProducts();
                        foreach ($result as $row) : ?>
                        <option value="<?php echo $row['n_id']; ?>" data-price="<?php echo $row['n_price']; ?>"
                           data-taxes="<?php echo $row['n_percent']; ?>">
                           <?php echo $row['c_descr']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <div class="form-group col-md-1">
                     <label for="n_price">Preço</label>
                     <input type="number" class="form-control text-right" id="n_price" step="0.01" placeholder="0"
                        min="1" required readonly>
                  </div>
                  <div class="form-group col-md-1">
                     <label for="n_quantity">Quantidade</label>
                     <input type="number" class="form-control text-right" id="n_quantity" min="0" max="100000"
                        placeholder="quantidade" required>
                  </div>
                  <div class="form-group col-md-1 d-flex justify-content-bottom mt-4 pt-2">
                     <label for="inputPassword4">&nbsp;</label>
                     <button class="btn btn-primary" type="button" id="btn_add_item">ADD</button>
                  </div>
               </div>
            </form>

            <table class="table table-striped p-0" id="tableItems">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Produto</th>
                     <th scope="col">Preço</th>
                     <th scope="col">Quantidade</th>
                     <th scope="col">Impostos</th>
                     <th scope="col">Subtotal</th>
                  </tr>
               </thead>
               <tbody id="salesDetail"></tbody>
               <tfoot class="mt-2">
                  <tr>
                     <th colspan="5" scope="col">Valor dos impostos</th>
                     <td id="taxes_total">0</td>
                  </tr>
                  <tr>
                     <th colspan="5" scope="row">Total</th>
                     <td id="grand_total">0</td>
                  </tr>
               </tfoot>
            </table>
            <form id="formTableData" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
               enctype="multipart/form-data">
               <div class="form-row m-2"> <button class="btn btn-danger mr-2" id="btnCancelSale">Cancelar</button>
                  <button class="btn btn-primary" type="submit" id="btnSave">Guardar</button>
               </div>
            </form>

            <?php
            if (isset($_POST["c_table_data"])) {
               $data = filter_var($_POST["c_table_data"]);

               $sales = new Sales();
               $result = $sales->addSales($data);
            }
            ?>
         </div>
      </div>
   </div>
</div>
<?php include "includes/Footer.php"; ?>