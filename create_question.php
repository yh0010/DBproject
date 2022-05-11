<!-- 
In this file, user can create new question in which the new question will be store into database and can be viewed through
dashboard searching.
User would need to provid both the question title and body before contintue to next step.
User will need to select tags for the question. The tags will later be added into 'belongs' table, this part is incomplete. -->

<?php
include('connectdb.php');
include("auth_session.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>New_Question</title>
</head>
<body>
    <button type='button' onclick="location.href='dashboard.php';">Return to dashboard</button>
    <p><a href="logout.php">Logout</a></p><br><a href="select_tag.php">select tags</a>
    
    <form method='post'>
        <h3>Question Title</h3>
            <h5>Be specific and imagine you are asking a question to another person</h5>
            <textarea cols=80 rows=2 class="form-control" id="title" name="title" placeholder="e.g. Is there an R function for finding the index? [include question mark]"></textarea>
        <h3>Body</h3>
            <h5>Include all the information someone would need to answer your question</h5>
            <textarea name="body" cols=100 rows=40 class="form-control" ></textarea>

    <div><input type="submit" name="submit" value="Next: Select tags"></div>
</body>
</html>

<?php

    if (isset($_POST['submit'])){
        if (empty($_POST['title']) || empty($_POST['body'])){
            echo 'Please fill out title and body before submit';
            exit();
        } else {
            $title = $_POST['title'];
            $body = $_POST['body'];

            $sql = "INSERT INTO question(uid, title, body, qtime, resolved) 
            VALUES (".$_SESSION['uid'].", '$title', '$body', CURRENT_TIMESTAMP, 'N')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header('Location:select_tag.php');
                exit();
            }
            else {
                echo 'Unsuccesfully post';
                exit();
            }
        }
    }
?>


