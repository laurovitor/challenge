<form class="form-signup" method="POST" action="/api/customer/add">
    <img class="mb-4" src="<?php echo URL::getBase() ?>images/sys.png" alt="">
    <h1 class="h3 mb-3 font-weight-normal">Faça o cadastro</h1>
    <label for="inputEmail" class="sr-only">Endereço de email</label>
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Seu email" required="" autofocus="">
    <label for="inputName" class="sr-only">Nome</label>
    <input name="name" type="text" id="inputName" class="form-control" placeholder="Seu nome" required="">
    <label for="inputCPF" class="sr-only">CPF</label>
    <input name="cpf" type="text" id="inputCPF" class="form-control" placeholder="Seu cpf" required="">
    <label for="inputPassword" class="sr-only">Senha</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Senha" required="">
    <?php
    if ($_SESSION["error"]) {
        echo '<div class="alert alert-warning" role="alert">' . $_SESSION["error"] . '</div>';
        unset($_SESSION["error"]);
    }
    ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
    <a class="btn btn-lg btn-primary btn-block" href="/">Voltar</a>
    <p class="mt-5 mb-3 text-muted">© 2019</p>
</form>