<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); 
    exit();
}
?>
<!DOCTYPE html>
}


<?php include 'navbar.php'; ?>