<?php
session_start();
include 'classes/api.class.php';

$api = new ComunicacaoAPI;
$cabecalho = array(
    'Content-Type: application/json',
    'Accept: json'
);

$conteudo = json_encode(array('email' => $_POST['email'], 'name' => $_POST['name'], 'cpf' => $_POST['cpf'], 'password' => $_POST['password'], 'passwordConfirmation' => $_POST['password']));

$url = '/customer';

$respostaApi = $api->enviaConteudoParaAPI($cabecalho, $conteudo, $url, 'POST');

$resposta = json_decode($respostaApi, true);

if ($resposta["error"]) {
    $_SESSION["error"] = $resposta["error"];
    header('Location: register.php');
    exit;
}

if ($resposta["customer"])
    $_SESSION["customer"] = $resposta["customer"];

if ($resposta["token"]) {
    $_SESSION["token"] = $resposta["token"];
    header('Location: dashboard.php');
    exit;
}
