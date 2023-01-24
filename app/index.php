<?php

    define("ROOT", __DIR__ . "/");

    header('Content-Type: text/html; charset=utf-8');
    error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('allow_url_fopen', 1);
    date_default_timezone_set('Europe/Budapest');

    require_once ROOT . "../vendor/autoload.php";
    require_once ROOT . "include/connection.class.php";
    require_once ROOT . "include/functions.php";
    require_once ROOT . "config.php";
    
    $sql = new Connection($_setting['sql_hostname'], $_setting['sql_username'], $_setting['sql_password'], $_setting['sql_database']);
	
    $url = urlExplode();

    //api
    if (isset($url[1]) && $url[0] == "api" && file_exists(ROOT . "api/" . $sql->escape($url[1]) . ".php")){
        require_once (ROOT . "api/" . $sql->escape($url[1]) . ".php");
    }