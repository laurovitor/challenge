<?php
session_start();

class customerController
{
    private static $header = array(
        'Content-Type: application/json',
        'Accept: json',
        'Authorization: Bearer ' . $_SESSION["token"]
    );

    public static function authenticate($email, $password)
    {
        $content = json_encode(array('email' => $email, 'password' => $password));
        $url = '/customer/authenticate';
        $answer = Communication::SendContentToAPI(self::$header, $content, $url, 'POST');

        $answer = json_decode($answer, true);
        if ($answer["error"])
            $_SESSION["error"] = $answer["error"];

        if ($answer["customer"])
            $_SESSION["customer"] = $answer["customer"];

        if ($answer["token"]) {
            $_SESSION["token"] = $answer["token"];
            return true;
        }

        return false;
    }

    public static function logout()
    {
        unset($_SESSION["token"]);
        return true;
    }

    public static function get($id)
    {
        return false;
    }

    public static function list()
    {
        return array();
    }

    public static function add($email, $name, $cpf, $password, $passwordConfirmation)
    {
        $content = json_encode(array('email' => $email, 'name' => $name, 'cpf' => $cpf, 'password' => $password, 'passwordConfirmation' => $passwordConfirmation));
        $url = '/customer';
        $answer = Communication::SendContentToAPI(self::$header, $content, $url, 'POST');

        $answer = json_decode($answer, true);

        if ($answer["error"])
            $_SESSION["error"] = $answer["error"];

        if ($answer["token"]) {
            $_SESSION["token"] = $answer["token"];
            $_SESSION["customer"] = $answer["customer"];
            return true;
        }

        return false;
    }

    public static function update($customerArray)
    {
        $content = array_diff($customerArray, $_SESSION['customer']);
        $content = json_encode($content);

        $url = '/customer/' . $_SESSION['customer']['_id'];

        $answer = Communication::SendContentToAPI(self::$header, $content, $url, 'PATCH');

        $answer = json_decode($answer, true);

        if ($answer["error"])
            $_SESSION["error"] = $answer["error"];

        if ($answer["success"]) {
            $_SESSION["success"] = $answer["success"];
            $_SESSION["customer"] = $answer["customer"];
            return true;
        }

        return false;
    }
}
