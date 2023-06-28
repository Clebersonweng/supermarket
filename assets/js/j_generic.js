// let URL = window.location.host;
// let CONTROLLER_NAME = (window.location.pathname=='/') ? '' :  window.location.pathname;
$(document).ready(function () {


});

function submitForm(formId, btnSaveId, url, method) {

   $("#" + btnSaveId).prop("disabled", true);

   $.ajax({
      url: url,
      type: method,
      data: $('#'+formId).serialize(),
   })
      .always(function () {
         $("#" + btnSaveId).prop("disabled", false);
      }).done(function (response) {
         let msg = response.msg || 'Nāo foi possivel retornar a mensagem.'
         if (response.status) {

            showMessage({ type: 'success', msg: msg, reload: true });
         }
         else {
            showMessage({ type: 'danger', msg: msg, reload: false });
         }
      }).fail(function (response) {
         showMessage({ type: 'danger', msg: '<b>500</b> Ocorreu um erro no servidor.', reload: false });
      });
}

async function updateData(event, url) {
   if (typeof event.currentTarget !== undefined) {
      let element = event.currentTarget;
      let id = $(element).data('id');

      if (typeof id != 'undefined') {
         let response = await request(url, 'GET', { id: id })
         return response;
      }

   }
};

function clearForm(formId) {
   $('#' + formId)[0].reset();
}

function showMessage(params) {
   $("#alert").addClass('alert-' + params.type).removeClass('d-none');
   $("#alert .text").html('').append(params.msg);

   setTimeout(() => {
      $(".alert").alert('close');
      if (params.reload) {
         location.reload();
      }
   }, 3000);
};

async function request(url, method, data) {
   const result = await $.ajax({
      url: url,
      type: method,
      data: data,
   })
   return result;
}

function setData(jsonData) {
   if (jsonData.status) {
      const formData = jsonData.data;

      $.each(formData, function (key, value) {
         if ($('#' + key).length > 0) {
            $('#' + key).val(value);
         }
         else {
            console.err('No existe el element con el id para setar el valor', key);
         }
      });
   }

}

function setUpdate(update = true) {
   if (update) {
      $("#_new a").html('Modificar');
      $("#_new a").click();
      return;
   }

   $("#_new a").html('Cadastrar');
   $("#_new a").click();
}

async function deleteData(event, url, method, data) {

   if (typeof event.currentTarget !== undefined) {
      let element = event.currentTarget;
      let id = $(element).data('id');

      console.log('id', id)

      if (typeof id != 'undefined') {
         let response = await request(url, method, { n_id: parseInt(id) })
         let msg = response.msg || 'Nāo foi possivel retornar a mensagem.'
         if (response.status) {
            showMessage({ type: 'success', msg: 'Tipo de produto eliminado corretamente', reload: true });
         }
         else {
            showMessage({ type: 'success', msg: msg, reload: false });
         }
      }
   }
}