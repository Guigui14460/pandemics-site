<?php

session_name("twProject");
session_start();

// settings and config
require_once("mysql_config.php");
require_once("private_settings.php");

// database related object
require_once("model/Database.php");
require_once("model/PandemicStorageMySQL.php");
require_once("model/UserStorageMySQL.php");

$pdo = new PDO("mysql:host=".MYSQL_HOST.";port=".MYSQL_PORT.";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASSWORD);
$db = new Database();
$db->addStorage("pandemics", new PandemicStorageMySQL($pdo));
$db->addStorage("users", new UserStorageMySQL($pdo));

?>