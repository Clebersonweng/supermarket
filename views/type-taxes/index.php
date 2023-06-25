<div class="card text-center">
   <div class="card-header">
   <?php require "views/layout/_submenu.php"; ?>
   </div>
   <div class="card-body p-0">
      <div class="tab-content mt-2">
         <div id="list" class="tab-pane fade in active show">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Tipo de imposto</th>
                     <th scope="col">Porcentagem</th>
                  </tr>
               </thead>
               <tbody>     
                  <?php foreach ($data as $type) :?>
                     <tr>
                        <td><?php echo $type['n_id'] ?></td>
                        <td><?php echo $type['c_type_product_descr'] ?></td>
                        <td><?php echo $type['n_percent'] ?></td>
                     </tr>
                  <?php endforeach; ?>           
               </tbody>
            </table>
         </div>
         <div id="new" class="tab-pane fade">
            <form id="formTypeTaxes" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
               enctype="multipart/form-data">
               <div class="col-md-12 m-2 text-center">
                  <div class="form-group row">
                     <label class=" col-sm-1 col-form-label" for="n_id_type_product">Tipo</label>
                     <div class="col-md-3">
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
                     <label class="col-sm-1 col-form-label" for="n_percent">Porcentagem</label>
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
         </div>
      </div>
   </div>
</div>