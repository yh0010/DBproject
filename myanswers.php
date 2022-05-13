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
    <title><?php echo $_SESSION['username']; ?>'s answers</title>
    <link href="styles.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php echo present_header("CS Answers", $_SESSION['username']); ?>

<div class="content">

<?php
$stmt = $conn->prepare("SELECT title,answer,atime,thumb_up FROM webuser natural join answer natural join question WHERE username = '$username' ");
$stmt->execute();
$stmt->store_result();
$num_of_rows = $stmt->num_rows;
if ($num_of_rows == 0) {
    echo "${username} do not have any answers.";
    return;
}
else{
    echo "<p>All answers posted by $username: </p>";
}
$stmt->bind_result($title, $answer, $atime, $thumb_up);

?>
<form method="POST">
    <table border = 1>
        <tr>
            <th>Question Title</th>
            <th>My Answer</th>
            <th>Answered Time</th>
            <th>Thumb ups</th>
        </tr>

        <?php

        while($stmt->fetch()) {
            $title = htmlspecialchars($title);
            $answer = htmlspecialchars($answer);
            $atime = htmlspecialchars($atime);
            $thumb_up = htmlspecialchars($thumb_up);

            echo "<tr>";
            echo "<td><input type='submit' name='question_title_button' value='$title'></td>";
            echo "<td> $answer </td>";
            echo "<td> $atime </td>";
            echo "<td> $thumb_up </td>";
            echo "</tr>";

        }


        $stmt->close();
        $conn->close();

        if (isset($_POST['question_title_button'])) {
            $_SESSION['ButtonName'] = $_POST['question_title_button'];
            header('Location: show_answer.php');
        }

        ?>

    </table>
</form>
</div>
</body>
</html>
