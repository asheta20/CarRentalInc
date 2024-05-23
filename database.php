<?php
//connection to the database
$host = "localhost";
$db_name = "carrental_db";
$username = "root";
$password= "erisat123";

$mysqli = new mysqli(hostname: $host, username: $username,password: $password, database: $db_name);

if($mysqli->connect_errno){
    die("Connection error: " . $mysqli->connect_errno);
}

return $mysqli;
?>