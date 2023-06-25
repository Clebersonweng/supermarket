$(document).ready(function () {


   console.log("ready type products!");

   $("#c_descr").focus();
   $("#btn_cancelar").on("click", function (event) {
      event.preventDefault();
      clear();
      $("#c_descr").focus();
   });

   $('#formTypeProducts').submit(function (e) {
      e.preventDefault();
      $("#btn_guardar").prop("disabled", true);

      $.ajax({
         url: 'http://localhost:8080/type-products',
         type: 'POST',
         data: new FormData(this),
         processData: false,
         contentType: false
      })
         .always(function () {
            $("#btn_guardar").prop("disabled", false);
         }).done(function (response, status) {
            if (status == 'success') {
               $("#alert").addClass('alert-success').removeClass('d-none').append('Tipo de produto armazenado corretamente');
               $('form')[0].reset();
            }
            else {
               $("#alert").addClass('alert-danger').removeClass('d-none').append('Não foi possivel armazenar o tipo de produto.');
            }

            setTimeout(() => {
               $(".alert").alert('close');
               location.reload();
            }, 3000);
         }).fail(function (response) {
            $("#alert").addClass('alert-danger').removeClass('d-none').append('<b>500</b> Ocorreu um erro no servidor.');
            setTimeout(() => {
               $(".alert").alert('close');
            }, 3000);
         });

   });
});
