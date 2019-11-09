<?php
require "api.class.php";
class Routes
{
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
                default:
                    $url = self::error404();
                    break;
            }
        } else {
            if ($url == null)
                $url = self::routeIndex();

            if ($_SESSION["token"])
                $url = self::routeDashboard();

            if (file_exists("../pages/" . $url . ".php"))
                return $url;
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
