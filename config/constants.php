<?php
//Session start
session_start();
define('SITEURL','http://localhost/car-purchase/');
define('LOCALHOST','localhost') ;//Defining constants
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','car-purchase');

$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); //Database Connection
$db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());





?>