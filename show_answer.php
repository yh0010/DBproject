<?php
include("auth_session.php");
include('connectdb.php');
require 'format.inc.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Answers</title>
    <link href="styles.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php echo present_header("CS Answers", $_SESSION['username']); ?>

<div class="content">

<?php

function validate_escape($conn, $data){
    $data = stripslashes($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


//display all questions listed under a certain topic where topicname = ButtonName
if (isset($_SESSION['ButtonName'])) {
    echo '<p><h3>'.$_SESSION['ButtonName'].'</h3></p>';

    $question_title = validate_escape($conn, $_SESSION['ButtonName']);

    $sql_quest = "SELECT * FROM question JOIN webuser USING(uid) WHERE title = '$question_title'";
    $row = mysqli_fetch_row(mysqli_query($conn, $sql_quest));
    echo "$row[3]";
    echo '<h4> Asked by: '.$row[7]."<br>".'Posted by: '.$row[4]."<br>".'User Status: '.$row[14]."<br>".'Points: '.$row[15]."<br></h4>";

    $sql_answer = "SELECT * FROM answer JOIN webuser USING(uid) JOIN question USING(qid) WHERE title = '$question_title' ORDER BY atime DESC";
    $res = mysqli_query($conn, $sql_answer);
    $ret = mysqli_fetch_all($res, MYSQLI_ASSOC);
    if ($res){}else{echo mysqli_error($conn);}

    //give warning when no answer is found, otherwise display answers by timestamp New->Old and list answerer's info
    if (empty($ret)){echo "<h4>No answer is found.</h4>";}
    $count = 1;
    foreach ($ret as $item):
        echo '<p>'.
            $count."<br>".$item['answer']."<br>".
            $item['atime']."<br>".$item['username']."\n".$item['status']."\n".$item['points']
        .'</p>';
        $count += 1;
    endforeach;

    //obtain the next aid and the current qid to use for adding new answer
    $aid = $count;
    $qid = $row[1];

    echo '<div>'.
        '<form method="post">'.
            '<textarea name="answer" cols=50 rows=3 placeholder="Write your new answer here..."></textarea>'.
            '<div><input type="submit" name="ans_submit" value="Submit"></div>'.
        '</form>'.
    '</div>';

    if (isset($_POST['ans_submit'])){
        if (!empty($_POST['answer'])){
            $answer = $_POST['answer'];
            $query = "INSERT INTO answer(aid, qid, uid, answer, atime, thumb_up) 
            VALUES ($aid, $qid, ".$_SESSION['uid'].", '$answer', CURRENT_TIMESTAMP, 0)";
            $query_result   = mysqli_query($conn, $query);
            if ($query_result) {
                // success
                echo 'You have successfully submitted your answer'."<br>"; 
                echo "<button type='button' onclick=\"location.href='show_answer.php';\">Refresh</button>";
              } else {
                // error
                echo 'Error: ' . mysqli_error($conn);
              }
            exit();
        } else {
            echo "Cannot leave it blank";
        }
    }

    //enable similar questions display even when user is currently viewing a specific question, so that user will need not to return back to
    //dashboard to re-search again
    echo "<br>"."<h3>See Similar Questions:</h3>"."<br>";
    if (isset($_SESSION['retTopic'])){$list = $_SESSION['retTopic'];}
    if (isset($_SESSION['DashButton'])){$list = $_SESSION['return'];}



    foreach ($list as $item):
        $question_title_similar = validate($item['title']);
        $question_body_similar = validate($item['body']);
        echo '<p>';
        echo 
        "<form method='post'>
        <input type='submit' name='q_button' value='$question_title_similar'>
        </form>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$question_body_similar."<br>";
        echo '<p>';

    endforeach;}
    if (isset($_POST['q_button'])) {
        $_SESSION['ButtonName'] = $_POST['q_button'];
        header('Location: show_answer.php');
    }
?>
</div>


</body>
</html>
