<?php session_start(); 
require_once 'autoload.php';
$user = $_POST["user"];
$password = $_POST["password"];

$bdd=ConnexionBD::getInstance();
$query="SELECT * FROM users WHERE name=? AND password=?";
$response=$bdd->prepare($query);
$response->execute([$user,$password]);
$result=$response->fetch();
if(!$result) {
    header("Location:index.php?error= عاود ثبت");
    exit();
}
else {
    $role = $result['role'];
    $_SESSION['user']=$user;
    $_SESSION['role']=$role;
    header("Location: home.php");
    exit();
}
?>
