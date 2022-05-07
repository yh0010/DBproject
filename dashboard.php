<?php
include("auth_session.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Dashboard</title>
</head>
<body>
<div class="form">
    <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
    <p>You are now user dashboard page.</p>
    <p><a href="logout.php">Logout</a></p>
</div>

</body>
</html>
