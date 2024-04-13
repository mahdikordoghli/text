<?php
$servername = "127.0.0.1";
$username = "mahdi";
$password = "000";
$dbname = "userdb";


$mysqli = new mysqli($servername, $username, $password, $dbname);


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
