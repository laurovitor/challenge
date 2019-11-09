<?php
require "api.class.php";
class Routes
{
    public static function routeURL()
    {
        $url = null;

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
                    $url = "404";
                    break;
            }
        } else {
            if ($url == null)
                $url = "home";

            if ($_SESSION["token"])
                $url = "dashboard";

            if (file_exists("../pages/" . $url . ".php"))
                return $url;
            else
                return "404";
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
