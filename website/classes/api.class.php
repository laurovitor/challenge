<?php
session_start();
include 'customer.controller.class.php';

class API
{
    private static $header = array(
        'Content-Type: application/json',
        'Accept: json',
        'Authorization: Bearer ' . $_SESSION["token"]
    );

    public static function authenticate($email, $password)
    {
        if (customerController::authenticate(self::$header, $email, $password))
            return "dashboard";

        return null;
    }

    public static function register($email, $name, $cpf, $password, $passwordConfirmation)
    {
        if (customerController::add(self::$header, $email, $name, $cpf, $password, $passwordConfirmation))
            return "dashboard";

        return "register";
    }

    public static function updateCustomer($email, $name, $cpf)
    {
        customerController::update(self::$header, array($email, $name, $cpf));

        return "dashboard";
    }
}
