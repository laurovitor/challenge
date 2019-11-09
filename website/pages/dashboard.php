<div class="form-dashboard">
  <img class="mb-4" src="<?php echo URL::getBase() ?>images/sys.png" alt="">
  <h1 class="h3 mb-3 font-weight-normal">Dashboard</h1><?php if ($_SESSION['customer']['manager']) echo '<small><font color="red">(ADMIN)</font></small>' ?>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link <?php if (Url::getURL(1) == "products" || Url::getURL(1) == null) echo "active" ?>" id="products-tab" data-toggle="tab" href="#produtos" role="tab" aria-controls="produtos" aria-selected="true">Produtos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if (Url::getURL(1) == "orders") echo "active" ?>" id="orders-tab" data-toggle="tab" href="#pedidos" role="tab" aria-controls="pedidos" aria-selected="false">Pedidos</a>
    </li>
    <?php if ($_SESSION['customer']['manager']) { ?>
      <li class="nav-item">
        <a class="nav-link <?php if (Url::getURL(1) == "users") echo "active" ?>" id="users-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="false">Usuários</a>
      </li>
    <?php } ?>
    <li class="nav-item">
      <a class="nav-link <?php if (Url::getURL(1) == "profile") echo "active" ?>" id="profile-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="perfil" aria-selected="false">Perfil</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="produtos" role="tabpanel" aria-labelledby="produtcs-tab">
      <?php include "products.php" ?>
    </div>
    <div class="tab-pane fade" id="pedidos" role="tabpanel" aria-labelledby="orders-tab">
      <?php include "orders.php" ?>
    </div>
    <?php if ($_SESSION['customer']['manager']) { ?>
      <div class="tab-pane fade" id="usuarios" role="tabpanel" aria-labelledby="users-tab">
        <?php include "users.php" ?>
      </div>
    <?php } ?>
    <div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="profile-tab">
      <?php include "profile.php" ?>
    </div>
  </div>
  <p class="mt-5 mb-3 text-muted">© 2019</p>
</div>