<?php
require "api.class.php";
class Routes
{
    private static $url = null;

    public static function routeURL()
    {
        if (Url::getURL(0) == "api") {
            switch (Url::getURL(1)) {
                case 'signin':
                    API::authenticate($_POST['email'], $_POST['password']);
                    break;
                case 'signup':
                    API::register($_POST['email'], $_POST['name'], $_POST['cpf'], $_POST['password'], $_POST['password']);
                    break;
                case 'signout':
                    unset($_SESSION["token"]);
                    break;
                case 'updateCustomer':
                    API::updateCustomer($_POST['email'], $_POST['name'], $_POST['cpf']);
                    break;
            }
        } else {
            if (self::$url == null)
                self::$url = self::routeIndex();

            if ($_SESSION["token"])
                self::$url = self::routeDashboard();

            if (file_exists("../pages/" . self::$url . ".php"))
                return self::$url;
            else
                return self::error404();
        }
    }

    public static function routeIndex()
    {
        return "home";
    }

    public static function routeDashboard()
    {
        return "dashboard";
    }

    public static function error404()
    {
        return "404";
    }

    public static function routeCustomer()
    {
        return null;
    }

    public static function routeUsers()
    {
        return null;
    }

    public static function routeOrders()
    {
        return null;
    }

    public static function routeProducts()
    {
        return null;
    }
}
