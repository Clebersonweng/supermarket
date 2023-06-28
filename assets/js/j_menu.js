let element;
$(document).ready(function () {
   console.log('jmenu IS ready')
   setActiveMenu();
});

setActiveMenu = () => {
   const path = window.location.pathname;

   $("#nav-main .nav-item").removeClass('active');

   switch (path) {
      case "/type-products": $("#typeProducts").closest('.nav-item').addClass('active'); break;
      case "/type-taxes": $("#typeTaxes").closest('.nav-item').addClass('active'); break;
      case "/products": $("#products").closest('.nav-item').addClass('active'); break;
      case "/sales": $("#sales").closest('.nav-item').addClass('active'); break;
      default: $("#home").closest('.nav-item').addClass('active');
   }
}