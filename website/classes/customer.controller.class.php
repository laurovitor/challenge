<?php
session_start();
include 'communication.class.php';

class customerController
{
    public static function authenticate($email, $password)
    {
        return false;
    }

    public static function logout()
    {
        return false;
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
        return false;
    }

    public static function update($id)
    {
        return false;
    }
}
