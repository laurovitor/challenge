<?php
session_start();
include 'comunicacao.class.php';

class API
{
    private function cabecalho($token = null)
    {
        return array(
            'Content-Type: application/json',
            'Accept: json',
            'Authorization: Bearer ' . $token
        );
    }

    private function comunicacao()
    {
        return new Comunicacao;
    }

    public function authenticate($email, $password)
    {
        $conteudo = json_encode(array('email' => $email, 'password' => $password));
        $url = '/customer/authenticate';
        $resposta = $this->comunicacao()->enviaConteudoParaAPI($this->cabecalho(), $conteudo, $url, 'POST');

        $resposta = json_decode($resposta, true);
        if ($resposta["error"])
            $_SESSION["error"] = $resposta["error"];

        if ($resposta["customer"])
            $_SESSION["customer"] = $resposta["customer"];

        if ($resposta["token"]) {
            $_SESSION["token"] = $resposta["token"];
            return "dashboard";
        }

        return null;
    }

    public function register($email, $name, $cpf, $password, $passwordConfirmation)
    {
        $conteudo = json_encode(array('email' => $email, 'name' => $name, 'cpf' => $cpf, 'password' => $password, 'passwordConfirmation' => $passwordConfirmation));
        $url = '/customer';
        $resposta = $this->comunicacao()->enviaConteudoParaAPI($this->cabecalho(), $conteudo, $url, 'POST');

        $resposta = json_decode($resposta, true);

        if ($resposta["error"]) {
            $_SESSION["error"] = $resposta["error"];
            return "register";
        }

        if ($resposta["token"]) {
            if ($resposta["customer"])
                $_SESSION["customer"] = $resposta["customer"];

            $_SESSION["token"] = $resposta["token"];
            return "dashboard";
        }

        return null;
    }

    public function updateCustomer($email, $name, $cpf)
    {
        $conteudo = array_diff(array('email' => $email, 'name' => $name, 'cpf' => $cpf), $_SESSION['customer']);
        $conteudo = json_encode($conteudo);

        $url = '/customer/' . $_SESSION['customer']['_id'];

        $resposta = $this->comunicacao()->enviaConteudoParaAPI($this->cabecalho(), $conteudo, $url, 'PATCH');

        $resposta = json_decode($resposta, true);

        if ($resposta["error"])
            $_SESSION["error"] = $resposta["error"];

        if ($resposta["success"])
            $_SESSION["success"] = $resposta["success"];

        if ($resposta["customer"])
            $_SESSION["customer"] = $resposta["customer"];

        return "dashboard";
    }
}
