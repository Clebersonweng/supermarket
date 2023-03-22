$(document).ready(function () {
   console.log("ready sales!");

   $("#btn_add_item").on("click", function (event) {
      event.preventDefault();
      add_item();
      $('form')[0].reset();
      $("#n_id_product_sale").focus();
   });

   $("#n_id_product_sale").on("change", function (event) {
      let price = +$("#n_id_product_sale :selected").data('price') || 0;
      if (price > 0) {
         $("#n_price").val(price);
      }
      console.log('price', price);
      $("#n_quantity").focus();
   });

   $("#btnCancel").on("click", function (event) {
      event.preventDefault();
      $('form')[0].reset();
      $("#c_descr").focus();
   });


});

function add_item() {
   let product_id = $("#n_id_product_sale").val();
   let product_descr = $("#n_id_product_sale :selected").text().trim();
   let price = +$("#n_price").val();
   let quantity = +$("#n_quantity").val();

   let percent_tax = +$("#n_id_product_sale :selected").data('taxes'); // 5.29
   let taxes = (price * (percent_tax / 100)); // = 100% seria  8.7 * (5.29/100) => 0.0529
   let subtotal = price * quantity;

   generate_row(product_id, product_descr, price, quantity, taxes, subtotal);
   recalculate_total(taxes, subtotal);
}

function generate_row(product_id, product_descr, price, quantity, taxes, subtotal) {
   const row = `<tr>
      <td scope="col">${product_id}</td>
      <td scope="col">${product_descr}</td>
      <td scope="col">${price.toFixed(2)}</td>
      <td scope="col">${quantity}</td>
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