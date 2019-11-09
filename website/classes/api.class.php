<?php
include 'customer.controller.class.php';

class API
{
    public static function authenticate($email, $password)
    {
        if (customerController::authenticate($email, $password))
            return "dashboard";

        return null;
    }

    public static function register($email, $name, $cpf, $password, $passwordConfirmation)
    {
        if (customerController::add($email, $name, $cpf, $password, $passwordConfirmation))
            return "dashboard";

        return "register";
    }

    public static function updateCustomer($email, $name, $cpf)
    {
        customerController::update(array($email, $name, $cpf));

        return "dashboard";
    }

    public static function logout()
    {
        customerController::logout();
        return null;
    }
}
