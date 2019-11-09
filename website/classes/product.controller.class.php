<?php
session_start();

class productController
{
    private static $header = array(
        'Content-Type: application/json',
        'Accept: json',
        'Authorization: Bearer ' . $_SESSION["token"]
    );

    public static function get($id)
    {
        return "dashboard/product";
    }

    public static function list()
    {
        return "dashboard/products";
    }

    public static function add()
    {
        return "dashboard/products";
    }

    public static function update($id)
    {
        return "dashboard/products";
    }
    public static function delete($id)
    {
        return "dashboard/products";
    }
}
