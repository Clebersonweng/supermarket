
<div class="card text-center">
   <div class="card-header">
      <?php require "views/layout/_submenu.php"; ?>
   </div>
   <div class="card-body p-0 ">
      <div class="tab-content mt-2">
         <div id="list" class="tab-pane fade in active show">
            <table class="table table-striped table-hover" id="listTypeProducts">
               <thead>
                  <tr class="d-flex">
                     <th class="col-1">#</th>
                     <th class="col-10">Tipo de produto</th>
                     <th class="col-1">Eventos</th>
                  </tr>
               </thead>
               <tbody class="scroll">
                  <?php foreach ($data as $type) :?>
                     <tr class="d-flex" index="<?= $type->n_id?>">
                        <td class="col-1 text-left"><?= $type->n_id?></td>
                        <td class="col-10 text-left"><?= $type->descr?></td>
                        <td class="col-1 text-center">
                           <button type="button" class="btn btn-info btn-sm modificar" title="Modificar" data-id="<?= $type->n_id?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                           <button type="button" class="btn btn-danger btn-sm eliminar " title="Eliminar" data-id="<?= $type->n_id?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
         <div id="new" class="tab-pane fade">
            <?= view('type-product._form') ?>
         </div>
      </div>
   </div>
</div>