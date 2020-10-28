<?php

session_name("testMVCR");
session_start();

require_once("model/PandemicStorageStub.php");
require_once("model/PandemicStorageFile.php");
require_once("model/PandemicStorageMySQL.php");
require_once("mysql_config.php");

$PROD_OR_DEV = 'dev';

// $db = new PandemicStorageStub();

$db = new PandemicStorageFile("data/storage.txt");
// $db->reinit();

// $db = new PandemicStorageMySQL(new PDO("mysql:host=".MYSQL_HOST.";port=".MYSQL_PORT.";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASSWORD));

?>