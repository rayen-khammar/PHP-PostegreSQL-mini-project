<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); 
    exit();
}
?>
<!DOCTYPE html>
<?php $mode = $_COOKIE['mode'] ?? 'dark'; ?>
<html data-bs-theme="dark" lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php include 'navbar.php'; ?>