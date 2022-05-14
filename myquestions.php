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
    <title><?php echo $_SESSION['username']; ?>'s questions</title>
    <link href="styles.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php echo present_header($_SESSION['headerName'], $_SESSION['username']); ?>

<div class="content">


<?php
$stmt = $conn->prepare("SELECT title,body,qtime,resolved FROM webuser natural join question WHERE username = '$username' ");
$stmt->execute();
$stmt->store_result();
$num_of_rows = $stmt->num_rows;
if ($num_of_rows == 0) {
    echo "${username} do not have any questions.";
    return;
}
else{
    echo "<p>All questions posted by $username: </p>";
}
$stmt->bind_result($title, $body, $qtime, $resolved);

?>
<form method="POST">
    <table border = 1>
        <tr>
            <th>Question Title</th>
            <th>Question Body</th>
            <th>Posted Time</th>
            <th>Resolved</th>
        </tr>

        <?php

        while($stmt->fetch()) {
            $title = htmlspecialchars($title);
            $body = htmlspecialchars($body);
            $qtime = htmlspecialchars($qtime);
            $resolved = htmlspecialchars($resolved);

            echo "<tr>";
            echo "<td><input type='submit' class='link-button' name='question_title_button' value='$title'></td>";
            echo "<td> $body </td>";
            echo "<td> $qtime </td>";
            echo "<td> $resolved </td>";
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
