let dataItems = [];
$(document).ready(function () {


   $("#btn_add_item").on("click", function (event) {
      event.preventDefault();
      if (is_valid_form()) {
         add_item();
         $('form')[0].reset();
         $("#n_id_product_sale").focus();
      } else {
         $("#alert").addClass('alert-danger').removeClass('d-none').append('Obrigatorio agregar o produto e a quantidade para guardar o item.');
         setTimeout(() => {
            $("#alert").addClass('d-none');
         }, 3000);
      }
   });

   $("#n_id_product_sale").on("change", function (event) {
      let price = +$("#n_id_product_sale :selected").data('price') || 0;
      if (price > 0) {
         $("#n_price").val(price);
      }
      $("#n_quantity").focus();
   });

   $("#btnCancelSale").on("click", function (event) {
      event.preventDefault();
      $('form')[0].reset();
      dataItems = [];
      $("#tableItems tbody").empty();
      $("#taxes_total").empty();
      $("#grand_total").empty();
      $("#c_descr").focus();
   });

   $('#formTableData').submit(function (e) {
      e.preventDefault();
      if ($("#salesDetail tr").length < 1) {
         $("#alert").addClass('alert-danger').removeClass('d-none').append('Deve conter ao menos um item para guardar a compra.');
         setTimeout(() => {
            $("#alert").addClass('d-none');
         }, 3000);
         return;
      }
      $("#btnSave").prop("disabled", true);
      const detailItems = new FormData();
      detailItems.append("c_table_data", JSON.stringify(dataItems));
      $.ajax({
         url: 'sales.php',
         type: 'POST',
         data: detailItems,
         processData: false,
         contentType: false
      })
         .always(function () {
            $("#btnSave").prop("disabled", false);
         }).done(function (response, status) {
            if (status == 'success') {
               $("#alert").addClass('alert-success').removeClass('d-none').append('Venda armazenada corretamente');
               $('form')[0].reset();
            }
            else {
               $("#alert").addClass('alert-danger').removeClass('d-none').append('Não foi possível armazenar a venda.');
            }

            setTimeout(() => {
               $("#alert").addClass('d-none');
               location.reload();
            }, 3000);
         }).fail(function (response) {
            $("#alert").addClass('alert-danger').removeClass('d-none').append('<b>500</b> Ocorreu um erro no servidor.');
         });
   });
});

function is_valid_form() {
   let prod_id = $("#n_id_product_sale").val() || '';
   let n_price = $("#n_price").val() || '';
   let n_quantity = $("#n_quantity").val() || '';

   if (prod_id != '' && n_price != '' && n_quantity != '') {
      return true;
   }
   return false;
};

function add_item() {
   let product_id = $("#n_id_product_sale").val();
   let product_descr = $("#n_id_product_sale :selected").text().trim();
   let price = +$("#n_price").val();
   let quantity = +$("#n_quantity").val();

   let percent_tax = +$("#n_id_product_sale :selected").data('taxes'); // 5.29
   let taxes = (price * (percent_tax / 100)); // = 100% seria  8.7 * (5.29/100) => 0.0529
   let subtotal = price * quantity;
   let exists_id = dataItems.find(x => x.productId === product_id)
   if (exists_id) {
     // $("#alert").addClass('alert-danger').removeClass('d-none').append('Item ja agregado.');
      let new_quantity = exists_id.quantity + quantity;
      exists_id.quantity = new_quantity;
      $('#tableItems tbody tr').each((i, row)=>{
         const rowCellProd = $(row).find(`td:nth-child(1)`);
         const rowCellQuant = $(row).find(`td:nth-child(4)`);
         
         const prod_id = rowCellProd.text(); 
         if(prod_id === product_id){
            rowCellQuant.text(new_quantity);  
         }
       });
   }
   else {
      generate_row(product_id, product_descr, price, quantity, taxes, subtotal);
   }
   recalculate_total(taxes, subtotal);
   //to send data table for the server
   let items = { productId: product_id, price: price, quantity: quantity, taxesByItem: taxes, subtotal: subtotal, percent_tax: percent_tax }
   $("#c_table_data").val(JSON.stringify(items));
   dataItems.push(items);
}

function generate_row(product_id, product_descr, price, quantity, taxes, subtotal) {
   let cant_rows = $("#salesDetail tr").length;
   let index = ++cant_rows;

   const row = `<tr index="${index}">
      <td scope="col" class="product_id">${product_id}</td>
      <td scope="col">${product_descr}</td>
      <td scope="col">${price.toFixed(2)}</td>
      <td scope="col" class="quantity">${quantity}</td>
      <td scope="col">${taxes.toFixed(2)}</td>
      <td scope="col">${subtotal.toFixed(2)}</td>
   </tr>`;

   $("#salesDetail").append(row);
}

function recalculate_total(newValueTax, newValueSubtotal) {
   let total_tax_old = +$("#taxes_total").text();
   let grand_total_old = +$("#grand_total").text();

   let new_total = grand_total_old + newValueSubtotal;
   let new_total_tax = total_tax_old + newValueTax;

   $("#taxes_total").html(new_total_tax.toFixed(2));
   $("#grand_total").html(new_total.toFixed(2));
}