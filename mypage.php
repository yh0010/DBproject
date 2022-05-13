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
    <title><?php echo $_SESSION['username']; ?>'s page</title>
    <link href="styles.css" type="text/css" rel="stylesheet"/>
</head>
<body>

<?php echo present_header("CS Answers", $_SESSION['username']); ?>


<?php


$drop_view = "drop view if exists thumb_ups";
$get_thumb_ups = "create view thumb_ups as(
select uid, sum(thumb_up) as total_thumb_up
from answer
group by uid
);";
$update_status = "update webuser join thumb_ups on webuser.uid = thumb_ups.uid
set points = total_thumb_up,  status = (case
										  when total_thumb_up >= 1000
										  then 'Expert'
										  when total_thumb_up < 1000 and total_thumb_up >=500
										  then 'Advanced'
										  when total_thumb_up < 500
										  then 'Basic'
										end) 
where webuser.points != thumb_ups.total_thumb_up and webuser.uid <> 0;";

mysqli_query($conn, $drop_view);
mysqli_query($conn, $get_thumb_ups);
mysqli_query($conn, $update_status);


$stmt = $conn->prepare("SELECT email, city, state, country, status, points, profile FROM webuser WHERE username = '$username' ");
$stmt->execute();
$stmt->store_result();
$num_of_rows = $stmt->num_rows;
if ($num_of_rows != 1) {
    echo "Fetching user information is failed. ";
    return;
}
$stmt->bind_result($email, $city, $state, $country, $status, $points, $profile);

$stmt->fetch();
$email = htmlspecialchars($email);
$city = htmlspecialchars($city);
$state = htmlspecialchars($state);
$country = htmlspecialchars($country);
$status = htmlspecialchars($status);
$points = htmlspecialchars($points);
$profile = htmlspecialchars($profile);


?>

<div class="content">
    <?php if (isset($_GET['error'])) { ?>

        <p class="error"><?php echo $_GET['error']; ?></p>

    <?php } ?>
    <div class="row">
        <div class="profile-row">
            <p><span>Username </span>: <?php echo $username; ?></p>
        </div>
        <div class="profile-row">
            <p><span>Email </span>: <?php echo $email; ?></p>
        </div>
        <div class="profile-row">
            <p><span>Location </span>: <?php echo $city, ', ', $state, ', ', $country; ?></p>
        </div>
        <div class="profile-row">
            <p><span>Status</span>: <?php echo $status; ?></p>
        </div>
        <div class="profile-row">
            <p><span>Points </span>: <?php echo $points; ?></p>
        </div>
        <div class="profile-row">
            <p><span>Questions </span>: <a href="myquestions.php">all questions</a></p>
        </div>
        <div class="profile-row">
            <p><span>Answers </span>: <a href="myanswers.php">all answers</a></p>
        </div>


    </div>


    <p>About Me <a href="edit_profile.php">edit</a></p>

    <?php
    if (empty($profile)){
        echo "<p style='color: #CBCBCB; '>The profile is empty now. Click edit to add one. </p>";
    }
    else{
        echo "<p>$profile</p>";
    }

    ?>



</div>

</body>
</html>