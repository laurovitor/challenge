<?php
session_start();
include 'api.php';

$api = new ComunicacaoAPI;
$cabecalho = array(
    'Content-Type: application/json',
    'Accept: json'
);

$conteudo = json_encode(array('email' => $_POST['email'], 'name' => $_POST['name'], 'cpf' => $_POST['cpf'], 'password' => $_POST['password'], 'passwordConfirmation' => $_POST['password']));

$url = 'http://' . $_ENV['API_URL'] . ':' . $_ENV['API_PORT'] . '/customer/customer';

$respostaApi = $api->enviaConteudoParaAPI($cabecalho, $conteudo, $url, 'POST');

$resposta = json_decode($respostaApi, true);

var_dump($resposta);
/*
if ($resposta["error"]) {
    $_SESSION["error"] = $resposta["error"];
    header('Location: register.php');
    exit;
}
*/