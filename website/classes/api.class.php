<?php
session_start();
include 'communication.class.php';

class API
{
    private static $header = array(
        'Content-Type: application/json',
        'Accept: json',
        'Authorization: Bearer ' . $_SESSION["token"]
    );
    private static $communication = new Communication;


    public static function authenticate($email, $password)
    {
        $content = json_encode(array('email' => $email, 'password' => $password));
        $url = '/customer/authenticate';
        $answer = self::$communication->SendContentToAPI(self::$header, $content, $url, 'POST');

        $answer = json_decode($answer, true);
        if ($answer["error"])
            $_SESSION["error"] = $answer["error"];

        if ($answer["customer"])
            $_SESSION["customer"] = $answer["customer"];

        if ($answer["token"]) {
            $_SESSION["token"] = $answer["token"];
            return "dashboard";
        }

        return null;
    }

    public static function register($email, $name, $cpf, $password, $passwordConfirmation)
    {
        $content = json_encode(array('email' => $email, 'name' => $name, 'cpf' => $cpf, 'password' => $password, 'passwordConfirmation' => $passwordConfirmation));
        $url = '/customer';
        $answer = self::$communication->SendContentToAPI(self::$header, $content, $url, 'POST');

        $answer = json_decode($answer, true);

        if ($answer["error"]) {
            $_SESSION["error"] = $answer["error"];
            return "register";
        }

        if ($answer["token"]) {
            if ($answer["customer"])
                $_SESSION["customer"] = $answer["customer"];

            $_SESSION["token"] = $answer["token"];
            return "dashboard";
        }

        return null;
    }

    public static function updateCustomer($email, $name, $cpf)
    {
        $content = array_diff(array('email' => $email, 'name' => $name, 'cpf' => $cpf), $_SESSION['customer']);
        $content = json_encode($content);

        $url = '/customer/' . $_SESSION['customer']['_id'];

        $answer = self::$communication->SendContentToAPI(self::$header, $content, $url, 'PATCH');

        $answer = json_decode($answer, true);

        if ($answer["error"])
            $_SESSION["error"] = $answer["error"];

        if ($answer["success"])
            $_SESSION["success"] = $answer["success"];

        if ($answer["customer"])
            $_SESSION["customer"] = $answer["customer"];

        return "dashboard";
    }
}
