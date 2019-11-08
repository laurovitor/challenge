<?php
session_start();
include 'classes/api.class.php';

$api = new ComunicacaoAPI;
$cabecalho = array(
    'Content-Type: application/json',
    'Accept: json'
);
$conteudo = json_encode(array('email' => $_POST['email'], 'password' => $_POST['password']));

$url = '/customer/authenticate';

$respostaApi = $api->enviaConteudoParaAPI($cabecalho, $conteudo, $url, 'POST');

$resposta = json_decode($respostaApi, true);
if ($resposta["error"]) {
    $_SESSION["error"] = $resposta["error"];
    header('Location: index.php');
    exit;
}

if ($resposta["customer"])
    $_SESSION["customer"] = $resposta["customer"];

if ($resposta["token"]) {
    $_SESSION["token"] = $resposta["token"];
    header('Location: dashboard.php');
    exit;
}