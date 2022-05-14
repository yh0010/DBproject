<?php
require 'format.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Registration</title>
    <link href="style.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<header>
    <h1>Heap Overflow</h1>
</header>

<div class="main-container">
    <div class="fixer-container">
        <h3 style="margin-bottom: 25px;">Members Registration</h3>



    <form method="POST" action="reg_post.php">
        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <div>
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <br>
        <div>
            <label>Email</label>
            <input type="text"  name="email">
        </div>
        <br>
        <div>
            <label>Password</label>
            <input type="text"  name="password">
        </div>
        <br>
        <div>
            <label>City</label>
            <input type="text"  name="city">
        </div>
        <br>
        <div>
            <label>State</label>
            <input type="text"  name="state">
        </div>
        <br>
        <div>
            <label>Country</label>
            <input type="text"  name="country">
        </div>
        <br>
        <div>
            <label>Profile</label>
            <input type="text"  name="profile">
        </div>
        <br>

        <button type="submit">Register</button>

        <p><a href="login.php">Click to Login</a></p>
    </form>

</body>
</html>