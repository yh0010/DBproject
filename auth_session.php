<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
$_SESSION['headerName'] = 'Heap Overflow';
?>
