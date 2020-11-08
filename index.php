<?php
//общие настройки
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//подключение файлов системы
require_once ($_SERVER["DOCUMENT_ROOT"] . '/components/Router.php');
require_once ($_SERVER["DOCUMENT_ROOT"] . '/components/Db.php');
require_once ($_SERVER["DOCUMENT_ROOT"] . '/components/Auth.php');

require_once ($_SERVER["DOCUMENT_ROOT"] . '/components/Helpers.php');

//вызов Router
$router =  new Router();
$router->run();
