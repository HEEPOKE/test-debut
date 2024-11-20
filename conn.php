<?php

$server_name = "localhost";
$username = "username";
$password = "password";
$database = "database_name";

$conn = new mysqli($server_name, $username, $password, $database);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}
