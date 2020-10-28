<?php

session_name("testMVCR");
session_start();

require_once("model/AnimalStorageStub.php");
require_once("model/AnimalStorageFile.php");
require_once("model/AnimalStorageMySQL.php");
require_once("mysql_config.php");

// $db = new AnimalStorageStub();

$db = new AnimalStorageFile("data/storage.txt");
// $db->reinit();

// $db = new AnimalStorageMySQL(new PDO("mysql:host=".MYSQL_HOST.";port=".MYSQL_PORT.";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASSWORD));

?>