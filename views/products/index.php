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
                     <th scope="col">Descrição</th>
                  </tr>
               </thead>
               <tbody>
                  
               </tbody>
            </table>
         </div>

         <div id="new" class="tab-pane fade">
            <form id="formTypeProducts" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
               enctype="multipart/form-data">
               <div class="col-md-12 m-2 text-center">
                  <div class="form-group row">
                     <label class="col-sm-1 col-form-label" for="exampleFormControlInput1">Tipo</label>
                     <div class="col-md-6">
                        <input type="text" class="form-control" id="c_descr" name="c_descr"
                           placeholder="Higiene pessoal" required>
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