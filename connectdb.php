<?php

$servername = "localhost";
$username = "elaina2";
$password = "123123";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

