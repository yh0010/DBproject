<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Registration</title>
</head>
<body>
<h1>Registration</h1>

    <form method="POST" action="reg_post.php">
        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>
        <table>
            <tr>
                <td>Username:</td>
                <td><input type="text"  name="username"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text"  name="email"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="text" name="password"></td>
            </tr>
            <tr>
                <td>City:</td>
                <td><input type="text" name="city"></td>
            </tr>
            <tr>
                <td>State:</td>
                <td><input type="text" name="state"></td>
            </tr>
            <tr>
                <td>Country:</td>
                <td><input type="text" name="country"></td>
            </tr>
            <tr>
                <td>Profile:</td>
                <td><input type="text" name="profile"></td>
            </tr>
        </table>

        <button type="submit">Register</button>
        <p><a href="login.php">Click to Login</a></p>
    </form>

</body>
</html>