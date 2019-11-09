<?php
include 'customer.controller.class.php';

class Routes
{
    private static $url = null;

    public static function routeURL()
    {
        if (Url::getURL(0) == "api") {
            switch (Url::getURL(1)) {
                case 'customer':
                    switch (Url::getURL(2)) {
                        case 'authenticate':
                            self::redirectToLocation(customerController::authenticate($_POST['email'], $_POST['password']));
                            break;
                        case 'logout':
                            self::redirectToLocation(customerController::logout());
                            break;
                        case 'get':
                            self::redirectToLocation(customerController::get(Url::getURL(3)));
                            break;
                        case 'list':
                            self::redirectToLocation(customerController::list(Url::getURL(3), Url::getURL(4), Url::getURL(5)));
                            break;
                        case 'register':
                            self::redirectToLocation(customerController::add($_POST['email'], $_POST['name'], $_POST['cpf'], $_POST['password'], $_POST['password']));
                            break;
                        case 'update':
                            self::redirectToLocation(customerController::update($_POST['email'], $_POST['name'], $_POST['cpf']));
                            break;
                    }
                    break;
                case 'product':
                    break;
                case 'order':
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
}
