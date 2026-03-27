<?php session_start(); 
if (!isset($_SESSION['user']) || !isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();}
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

<body>
    <div class="container" >
    <p> Hello, PHP Lovers! Welcome to your administration Platform </p>
    <?php if($_SESSION['role'] == 'admin') : ?>
        <a href="admin.php" class="btn btn-primary">Students List</a>
    <?php else : ?>
        <a href="normal.php" class="btn btn-primary">Students List</a>
    <?php endif; ?>
    </div>
</body>

</html>