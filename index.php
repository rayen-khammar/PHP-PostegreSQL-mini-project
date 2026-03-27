<?php session_start(); ?>
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
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3">
            <strong>Error</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <br>
            <small><?php echo htmlspecialchars($_GET['error']); ?></small>
        </div>
    <?php endif; ?>
    <form action="processLogin.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="username" name="user" class="form-control" id="username">
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    </div>
</body>

</html>