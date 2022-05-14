<?php
include("auth_session.php");
include('connectdb.php');
require 'format.inc.php';
$username = $_SESSION['username'];


?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Edit <?php echo $_SESSION['username']; ?>'s profile</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>

<?php echo present_header($_SESSION['headerName'], $_SESSION['username']); ?>


<div class = "content">
    <?php if (isset($_GET['error'])) { ?>

        <p class="error"><?php echo $_GET['error']; ?></p>

    <?php } ?>
    <form method='POST'>
    <p>Enter your new profile here </p>
        <br>
        <textarea rows = "5" cols = "60" name = "new_profile"></textarea><br>


        <button type="submit">Update</button>
        <button onclick="location.href='mypage.php'" type="button">Cancel</button>
    </form>

</div>

<?php

if (isset($_POST['new_profile'])) {

    function validate($conn, $data){
        $data = stripslashes($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }
    $new_profile = validate($conn, $_POST['new_profile']);


    $update_query    = "update webuser set profile = '$new_profile'";
    $update_result   = mysqli_query($conn, $update_query);
    if ($update_result) {
        header("Location: mypage.php?error=Your profile is updated.");
        exit();
    }
    else {
        header("Location: edit_profile.php?error=Update is failed.");
        exit();
    }


}
?>
</body>
</html>