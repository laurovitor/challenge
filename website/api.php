<?php
session_start();

$api = Url::getURL(1);

switch ($api) {
    case 'signin':
        echo "Autenticação";
        break;
    case 'signup':
        echo "Registro";
        break;


    default:
        echo "API";
        break;
}
