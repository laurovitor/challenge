<div class="form-dashboard">
  <img class="mb-4" src="<?php echo URL::getBase() ?>images/sys.png" alt="">
  <h1 class="h3 mb-3 font-weight-normal">Dashboard</h1><?php if ($_SESSION['customer']['manager']) echo '<small><font color="red">(ADMIN)</font></small>' ?>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="products-tab" data-toggle="tab" href="#produtos" role="tab" aria-controls="produtos" aria-selected="true">Produtos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="orders-tab" data-toggle="tab" href="#pedidos" role="tab" aria-controls="pedidos" aria-selected="false">Pedidos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="users-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="false">Usuários</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="perfil" aria-selected="false">Perfil</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="produtos" role="tabpanel" aria-labelledby="produtcs-tab">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Primeiro</th>
            <th scope="col">Último</th>
            <th scope="col">Nickname</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="pedidos" role="tabpanel" aria-labelledby="orders-tab">Lista de pedidos</div>
    <div class="tab-pane fade" id="usuarios" role="tabpanel" aria-labelledby="users-tab">Lista de usuários</div>
    <div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="profile-tab">
      <form method="POST" action="api/updateCustomer">
        <div class="form-group">
          <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $_SESSION['customer']['email']; ?>">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <input name="name" type="text" class="form-control" id="inputName" placeholder="Nome" value="<?php echo $_SESSION['customer']['name']; ?>">
          </div>
          <div class="form-group col-md-6">
            <input name="cpf" type="text" class="form-control" id="inputCPF" placeholder="CPF" value="<?php echo $_SESSION['customer']['cpf']; ?>">
          </div>
        </div>
        <button type="submit" class="btn btn-lg btn-primary btn-block">Salvar</button>
        <a class="btn btn-lg btn-primary btn-block" href="api/signout">Deslogar</a>
      </form>

    </div>
  </div>






  <p class="mt-5 mb-3 text-muted">© 2019</p>
</div>