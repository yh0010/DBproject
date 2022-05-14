<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Login</title>
</head>
<body>

<form method="POST" action="login.php">

<h1>Login</h1>
    <?php if (isset($_GET['error'])) { ?>

    <p class="error"><?php echo $_GET['error']; ?></p>

    <?php } ?>
    
    <div>
      <label>Username: </label>
      <input type="text" name="username">
    </div>
    <br>
    <div>
      <label>Password: </label>
      <input type="password" name="password">
    </div>
    <br>
    <input type="submit" name="submit" value="Submit" class="btn btn-dark w-10">
    <p>Do not have an account? <a href="registration.php">Create one here!</a></p>
</form>





</body>
</html>