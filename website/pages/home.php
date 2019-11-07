<form class="form-signin" method="POST" action="api/signin">
    <img class="mb-4" src="images/sys.png" alt="">
    <h1 class="h3 mb-3 font-weight-normal">Faça login</h1>
    <label for="inputEmail" class="sr-only">Endereço de email</label>
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Seu email" required="" autofocus="">
    <label for="inputPassword" class="sr-only">Senha</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Senha" required="">
    <?php
    if ($_SESSION["error"]) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION["error"] . '</div>';
        unset($_SESSION["error"]);
    }
    ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    <a class="btn btn-lg btn-primary btn-block" href="register">Cadastro</a>
    <p class="mt-5 mb-3 text-muted">© 2019</p>
</form>