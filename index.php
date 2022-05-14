<?php
require 'format.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Login</title>
    <link href="style.css" type="text/css" rel="stylesheet"/>
</head>
<body>

<header>
    <h1>Heap Overflow</h1>
</header>

<div class="main-container">
    <div class="fixer-container">
        <h3 style="margin-bottom: 25px;">Members Login</h3>
        <form method="POST" action="login.php">

            <?php if (isset($_GET['error'])) { ?>

                <p class="error"><?php echo $_GET['error']; ?></p>

            <?php } ?>


            <div>
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <br>
            <div>
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <br>

            <button type="submit">Login</button>

        </form>

        <p>Do not have an account? <a href="registration.php">Create one here!</a></p>
    </div>
</div>
</body>
</html>