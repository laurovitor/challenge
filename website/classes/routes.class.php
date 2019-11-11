<?php
include 'customer.controller.class.php';

class Routes
{
    public static function routeURL()
    {
        if (Url::getURL(0) == "api") {
            switch (Url::getURL(1)) {
                case 'customer':
                    switch (Url::getURL(2)) {
                        case 'authenticate':
                            header('Location: ' . customerController::authenticate($_POST['email'], $_POST['password']));
                            break;
                        case 'logout':
                            header('Location: ' . customerController::logout());
                            break;
                        case 'get':
                            header('Location: ' . customerController::get(Url::getURL(3)));
                            break;
                        case 'list':
                            header('Location: ' . customerController::list(Url::getURL(3), Url::getURL(4), Url::getURL(5)));
                            break;
                        case 'add':
                            header('Location: ' . customerController::add($_POST['email'], $_POST['name'], $_POST['cpf'], $_POST['password'], $_POST['password']));
                            break;
                        case 'update':
                            header('Location: ' . customerController::update($_POST['email'], $_POST['name'], $_POST['cpf']));
                            break;
                    }
                    break;
                case 'product':
                    break;
                case 'order':
                    break;
            }
        } else {
            $url = Url::getURL(0);
            if ($url == null)
                $url = self::routeIndex();

            if ($_SESSION["token"])
                $url = self::routeDashboard();

            if (file_exists("pages/" . $url . ".php"))
                return $url;
            else
                return self::error404();
        }
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
