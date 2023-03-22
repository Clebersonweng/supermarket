<?php $pagename = trim(basename($_SERVER['PHP_SELF'])); 
// agregar aqui um id e com base no domain agregar a clase ativa?>

<nav>
   <ul class="nav">
      <li class="nav-item ">
         <a class="nav-link" id="home" <?php if ($pagename == 'home.php') { echo ' class="current"';} ?> href="
            home.php">home</a>
      </li>
      <li class="nav-item">
         <a class="nav-link " id="typeProducts"
            <?php if ($pagename == 'type-products.php') { echo ' class="active"';} ?>
            href="/views/type-products.php">Tipos de produtos</a>
      </li>
      <li class="nav-item">
         <a class="nav-link " id="typeTaxes"
            <?php if ($pagename == 'type-taxes.php') { echo ' class="nav-link active"';} ?>
            href="/views/type-taxes.php">Tipos de impostos</a>
      </li>
      <li class="nav-item">
         <a class="nav-link " id="home" <?php if ($pagename == 'products.php') { echo ' class="active"';} ?>
            href="/views/products.php">Produtos</a>
      </li>
      <li class="nav-item">
         <a class="nav-link " id="home" <?php if ($pagename == 'sales.php') { echo ' class="active"';} ?>
            href="/views/sales.php">Venda</a>
      </li>
   </ul>
</nav>