<?php
session_start();
error_reporting(0);

define('DB_HOST','localhost');
define('DB_USER', 'u1005343_rifadam');
define('DB_PASS', 'perpustakaan1234');
define('DB_NAME', 'u1005343_perpustakaan');

try{
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e){
    exit("Error: " . $e->getMessage());
}


