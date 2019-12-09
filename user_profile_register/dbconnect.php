<?php
$host = "localhost";
$username = "admin";
$password = "admin";
$database = "medbase";

$dbconnect = new PDO("mysql:host=$host; dbname=$database",$username, $password);
$dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!$dbconnect){
    die("something went wrong.Database failed to connect!" . errorInfo($dbconnect));
}
$select_db = define('MYSQL_DATABASE','medbase');
if (!$select_db){
    die("cannot locate the database!" . errorInfo($dbconnect));
}

?>
