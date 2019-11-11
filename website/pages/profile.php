<form method="POST" action="/api/customer/update">
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
    <a class="btn btn-lg btn-primary btn-block" href="/api/customer/logout">Deslogar</a>
</form>