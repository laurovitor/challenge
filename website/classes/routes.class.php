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
                    self::redirectToLocation(API::authenticate($_POST['email'], $_POST['password']));
                    break;
                case 'signup':
                    self::redirectToLocation(API::register($_POST['email'], $_POST['name'], $_POST['cpf'], $_POST['password'], $_POST['password']));
                    break;
                case 'signout':
                    self::redirectToLocation(API::logout());
                    break;
                case 'updateCustomer':
                    self::redirectToLocation(API::updateCustomer($_POST['email'], $_POST['name'], $_POST['cpf']));
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

    public static function redirectToLocation($url)
    {
        header('Location: ' . $url);
        exit;
    }

    private static function routeIndex()
    {
        return "home";
    }

    private static function routeDashboard()
    {
        return "dashboard";
    }

    private static function error404()
    {
        return "404";
    }

    private static function routeCustomer()
    {
        return null;
    }

    private static function routeUsers()
    {
        return null;
    }

    private static function routeOrders()
    {
        return null;
    }

    private static function routeProducts()
    {
        return null;
    }
}
