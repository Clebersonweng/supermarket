<form id="formTypeProducts" method="post">
   <div class="col-md-12 m-2 text-center">
      <div class="form-group row">
         <label class="col-sm-1 col-form-label" for="descr">Tipo</label>
         <div class="col-md-6">
            <input type="text" class="form-control" id="descr" name="descr"
               placeholder="Higiene pessoal" required>
         </div>
      </div>
      <?= view('layout._buttons') ?>
   </div>
   <input type="text" class="" id="n_id" name="n_id" >
</form>