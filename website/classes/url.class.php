<?php
class Url
{
    private static $url = null;
    private static $baseUrl = null;

    public static function getBase()
    {
        if (self::$baseUrl != null)
            return self::$baseUrl;

        global $_SERVER;
        $startUrl = strlen($_SERVER["DOCUMENT_ROOT"]);
        $excludeUrl = substr($_SERVER["SCRIPT_FILENAME"], $startUrl, -9);
        if ($excludeUrl[0] == "/")
            self::$baseUrl = $excludeUrl;
        else
            self::$baseUrl = "/" . $excludeUrl;
        return self::$baseUrl;
    }

    public static function getURL($id)
    {
        if (self::$url == null)
            self::getURLList();

        if (isset(self::$url[$id]))
            return self::$url[$id];

        return null;
    }

    private static function getURLList()
    {
        global $_SERVER;
        $startUrl = strlen($_SERVER["DOCUMENT_ROOT"]) - 1;
        $excludeUrl = substr($_SERVER["SCRIPT_FILENAME"], $startUrl, -10);
        $request = $_SERVER['REQUEST_URI'];
        $request = substr($request, strlen($excludeUrl));
        $urlTmp = explode("?", $request);
        $request = $urlTmp[0];
        $urlExplodida = explode("/", $request);

        $retorna = array();

        for ($a = 0; $a <= count($urlExplodida); $a++) {
            if (isset($urlExplodida[$a]) and $urlExplodida[$a] != "") {
                array_push($retorna, $urlExplodida[$a]);
            }
        }
        self::$url = $retorna;
    }
}
