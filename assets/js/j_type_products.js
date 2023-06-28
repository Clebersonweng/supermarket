
$(document).ready(function () {

   $("#btnSave").on("click", function (event) {
      console.log('click save');
      let id = $("#n_id").val();

      if( id.trim() === '') {
         submitForm('formTypeProducts', 'btnSave', 'http://localhost:8080/type-products/save', 'POST')
      }
      else {
         submitForm('formTypeProducts', 'btnSave', 'http://localhost:8080/type-products/update', 'POST')
      }
   });

   $(".modificar").on("click", async function (event) {
      setUpdate();
      let response = await updateData(event,'http://localhost:8080/type-products/getById', 'formTypeProducts');
      setData(response)
   });

   $(".eliminar").on("click", async function (event) {
      console.log("delete!");
      deleteData(event,'http://localhost:8080/type-products/delete','POST');
   });

   $("#btnCancel").on("click", function (event) {
      event.preventDefault();
      $("#c_descr").focus();
      setUpdate(false);
   });



});
