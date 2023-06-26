<div class="card text-center">
   <div class="card-header">
      <?php require "views/layout/_submenu.php"; ?>
   </div>
   <div class="card-body p-0">
      <div class="tab-content mt-2">
         <div id="list" class="tab-pane fade in active show">
            <table class="table table-striped table-hover">
               <thead>
                  <tr class="d-flex">
                     <th class="col-1">#</th>
                     <th class="col-3">Descrição</th>
                     <th class="col-1">Preço</th>
                     <th class="col-4">Tipo de produto</th>
                     <th class="col-3">Porcentagem</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($data as $product) :?>
                     <tr class="d-flex">
                        <td class="col-1"><?= $product['n_id']?></td>
                        <td class="col-3 text-left"><?= $product['c_descr']?></td>
                        <td class="col-1 text-right"><?= $product['n_price']?></td>
                        <td class="col-4 text-left" ><?= $product['c_type_product_descr']?></td>
                        <td class="col-3 text-right" ><?= $product['n_percent']?></td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>

         <div id="new" class="tab-pane fade">
            <form id="formProducts" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
               enctype="multipart/form-data">
               <div class="col-md-12 m-2 text-center">
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label" for="n_id_type_products">Tipo de produto : </label>
                     <div class="col-md-6">
                        <select class="select form-control" id="n_id_type_products" name="n_id_type_products" required>
                              <option value=""></option>
                              <?php foreach ($typeProducts as $type) :?>
                                    <option value="<?= $type['n_id'] ?>"><?= $type['descr'] ?></option>
                                 </tr>
                              <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label" for="exampleFormControlInput1">Descriçāo : </label>
                     <div class="col-md-7">
                        <input type="text" class="form-control" id="c_descr" name="c_descr"
                           placeholder="descriçāo" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label" for="n_price">Preço : </label>
                     <div class="col-md-2">
                        <input type="text" class="form-control" id="n_price" name="n_price"
                           placeholder="preço" required>
                     </div>
                  </div>

                  <div class=" row">
                     <div class="col-md-4 text-center">
                        <button class="btn btn-danger mr-2" id="btnCancel">Cancelar</button>
                        <button class="btn btn-primary" type="submit" id="btnSave"> Guardar</button>
                     </div>
                  </div>
               </div>

            </form>
         </div>
      </div>
   </div>
</div>