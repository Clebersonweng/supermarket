$(document).ready(function () {
   console.log("ready type taxes!");


   $("#c_descr").focus();
   $("#btnCancel").on("click", function (event) {
      event.preventDefault();
      $('form')[0].reset();
      $("#c_descr").focus();
   });

   $('#formTypeTaxes').submit(function (e) {
      $("#btnSaveTaxes").prop("disabled", true);
      e.preventDefault();
      $.ajax({
         url: 'http://localhost:8080/type-taxes',
         type: 'POST',
         data: new FormData(this),
         processData: false,
         contentType: false
      })
         .always(function () {
            $("#btnSaveTaxes").prop("disabled", false);
         }).done(function (response) {
            if ( response.status ) {
               $("#alert").addClass('alert-success').removeClass('d-none').append('Tipo de produto armazenado corretamente');
               $('form')[0].reset();
               setTimeout(() => {
                  $(".alert").alert('close');
                  location.reload();
               }, 3000);
            }
            else {
               $("#alert").addClass('alert-danger').removeClass('d-none').append('Não foi possivel armazenar o tipo de produto.');
            }
         }).fail(function (response) {
            $("#alert").addClass('alert-danger').removeClass('d-none').append('<b>500</b> Ocorreu um erro no servidor.');
         });
   });
});
