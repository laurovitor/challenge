<?php
session_start();
include 'api.php';

$api = new ComunicacaoAPI;
$cabecalho = array(
    'Content-Type: application/json',
    'Accept: json',
    'Authorization: Bearer ' . $_SESSION['token']
);

$resultado = array_diff(array('email' => $_POST['email'], 'name' => $_POST['name'], 'cpf' => $_POST['cpf']), $_SESSION['customer']);

$conteudo = json_encode($resultado);

$url = 'http://' . $_ENV['API_URL'] . ':' . $_ENV['API_PORT'] . '/customer/' . $_SESSION['customer']['_id'];

$respostaApi = $api->enviaConteudoParaAPI($cabecalho, $conteudo, $url, 'PATCH');

$resposta = json_decode($respostaApi, true);

if ($resposta["error"])
    $_SESSION["error"] = $resposta["error"];

if ($resposta["success"])
    $_SESSION["success"] = $resposta["success"];

if ($resposta["customer"])
    $_SESSION["customer"] = $resposta["customer"];

header('Location: dashboard.php');
exit;