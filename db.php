<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "user_management";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Connection Failed");
}

?>