<?php 
include("auth_session.php");
include('connectdb.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Dashboard</title>
</head>
<body>
<div class="form">
    <p>Hey, <?php echo $_SESSION['username']; ?>! <a href="logout.php">Logout</a></p>
    <p>You are now in user dashboard page &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type='button' onclick="location.href='create_question.php';">Ask New Question</button></p>


    <div>
        <form method='post'>
            <textarea name="question" cols=50 rows=3 placeholder="Enter your question here to begin searching..."></textarea>
            <div><input type="submit" name="submit" value="Search"></div>
        </form>
    </div>

    <p>Search by topics:</p>
    <?php 
        $sql_uid = "SELECT uid FROM webuser WHERE username = '".$_SESSION['username']."'";
        $row = mysqli_fetch_row(mysqli_query($conn, $sql_uid));
        $_SESSION['uid'] = $row[0];
    
        $sql = "SELECT topicname FROM topic WHERE parent is NULL";
        $result = mysqli_query($conn, $sql);
        $feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($feedback as $item):
            echo "<form method='post'>
            <input type='submit' name='topic_button' value='".$item['topicname']."'>
            </form>";
        endforeach;

        if (isset($_POST['topic_button'])) {
            $_SESSION['TopicName'] = $_POST['topic_button'];
            header('Location: showAns_byTopic.php');
          }
    ?>

<br>
</div>


<!-- <style>
div {
  background-color: lightgrey;
  width: 300px;
  border: 15px solid green;
  padding: 50px;
  margin: 20px;
}
</style> -->
<?php
//$sql = "SELECT * FROM "
if (isset($_POST['submit'])){
    if (!empty($_POST['question'])){
        $sql_word = "SELECT * FROM `question` WHERE LOCATE('".$_POST['question']."', title) > 0 
        OR LOCATE('".$_POST['question']."', body) > 0";
        $result_word = mysqli_query($conn, $sql_word);
        $return = mysqli_fetch_all($result_word, MYSQLI_ASSOC);
        $_SESSION['return'] = $return;

        if ($result_word) {
          // success
        } else {
          // error
          echo 'Error: ' . mysqli_error($conn);
        }
        echo "<h3>Following questions are found:</h3>";
        foreach ($return as $item):
            echo '<p>';
            echo 
            "<form method='post'>
            <input type='submit' name='quest_button' value='".$item['title']."'>
            </form>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$item['body']."<br>";
            echo '<p>';

        endforeach;
    } else{
        echo 'Please type a question/key word to begin the search';
    }
}

if (isset($_POST['quest_button'])) {
    $_SESSION['ButtonName'] = $_POST['quest_button'];
    $_SESSION['DashButton'] = 'Y';
    header('Location: show_answer.php');
  } else {unset($_SESSION['DashButton']);}
?>

</body>
</html>