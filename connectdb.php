<?php

$servername = "localhost";
$username = "root";
$password = "mysqldbSECRET";
$dbname = "question_answering";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

