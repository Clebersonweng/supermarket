$(document).ready(function () {
   $("#n_id_type_product").focus();
   $("#btnCancel").on("click", function (event) {
      event.preventDefault();
      $('form')[0].reset();
      $("#n_id_type_product").focus();
   });

   $('#formProducts').submit(function (e) {
      $("#btn_guardar").prop("disabled", true);
      e.preventDefault();
      $.ajax({
         url: 'products.php',
         type: 'POST',
         data: new FormData(this),
         processData: false,
         contentType: false
      })
         .always(function () {
            $("#btn_guardar").prop("disabled", false);
         }).done(function (response, status) {
            if (status == 'success') {
               $("#alert").addClass('alert-success').removeClass('d-none').append('Produto armazenado corretamente');
               $('form')[0].reset();
            }
            else {
               $("#alert").addClass('alert-danger').removeClass('d-none').append('Não foi possivel armazenar o  produto.');
            }

            setTimeout(() => {
               $(".alert").alert('close');
               location.reload();
            }, 3000);
         }).fail(function (response) {
            $("#alert").addClass('alert-danger').removeClass('d-none').append('<b>500</b> Ocorreu um erro no servidor.');
         });

   });
});