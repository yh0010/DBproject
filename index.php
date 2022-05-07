<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
<form method="POST" action="login.php">
    <?php if (isset($_GET['error'])) { ?>

    <p class="error"><?php echo $_GET['error']; ?></p>

    <?php } ?>
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text"  name="username"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="text"  name="password"></td>
        </tr>
    </table>
    <button type="submit">Login</button>

</form>

<p>Do not have an account? <a href="registration.php">Create one here!</a></p>
</body>
</html>
