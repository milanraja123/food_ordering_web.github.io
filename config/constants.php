<?php

session_start();

define('SITEURL', 'http://localhost/Restaurent/');

$server = "localhost";
$username = "root";
$password = "";
$database = "food";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("Sorry unable to connect to database. " . mysqli_connect_error());
}
