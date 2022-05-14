<?php
include("auth_session.php");
include('connectdb.php');
require 'format.inc.php';
$uid 
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Answers</title>
    <link href="style.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php echo present_header($_SESSION['headerName'], $_SESSION['username']); ?>

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
    $question_title = validate_escape($conn, $_SESSION['ButtonName']);
    $sql_solved = "Select qid, uid, resolved from question where qid = (SELECT qid FROM question WHERE title = '$question_title')";
    $r_row = mysqli_fetch_row(mysqli_query($conn, $sql_solved));

        if ($r_row[1] == $_SESSION['uid']){
            echo '<form method="post">'.
            '<input type="submit" name="sol_submit" value="Solved">'.
            '<input type="submit" name="sol_submit" value="Unsolved">'.
        '</form>';
        }
    echo '<h2>'.'['.$r_row[2].']'.'</h2>';
    
    if (isset($_POST['sol_submit'])){
        $sol = $_POST['sol_submit'];
        $sql_change_sol = "UPDATE question
        SET
            resolved = '$sol',
            qtime = qtime
        WHERE
            qid = $r_row[0]";
        $res_change_sol = mysqli_query($conn, $sql_change_sol);
        header('Location: show_answer.php');
    }
     
    echo '<p><h3>'.$question_title.'</h3></p>';


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
        $nam = $item['username'];
        $aid_real = $item['aid'];
        if ($r_row[1] == $_SESSION['uid']){
            echo "<form method='post'><input type='submit' name='upvote_button' value=vote($aid_real)$nam>"."\n".$item['thumb_up']."</form>";
        }
        echo '<p>'.
        "<br>".$count."<form method='post'><input type='submit' name='upvote_button' value=vote($aid_real)$nam>"."\n".$item['thumb_up']."</form>"
            .$item['answer'].
            $item['atime']."<br>".$item['username']."\n".$item['status']."\n".$item['points']
        .'</p>';
        $count += 1;
    endforeach;
    //obtain the next aid and the current qid to use for adding new answer
    $aid = $count;
    $qid = $row[1];

    if (isset($_POST['upvote_button'])){
        $vote_nam = substr($_POST['upvote_button'], 7);
        $vote_aid = $_POST['upvote_button'][5];
    //(select uid from webuser where username = '$vote_nam')
        $sql_check_vote = "SELECT * FROM vote_track WHERE uid = ".$_SESSION['uid']." and qid = $qid and aid = $vote_aid";
        $res_check_vote  = mysqli_fetch_all(mysqli_query($conn, $sql_check_vote));

        if (empty($res_check_vote)){
        $sql_vote = "UPDATE answer
        SET
            thumb_up = thumb_up+1,
            atime = atime
        WHERE
            aid = $vote_aid and qid = $qid";
        $res_vote  = mysqli_query($conn, $sql_vote);
        if ($res_vote){
            $sql_vote_track = "INSERT INTO vote_track VALUES (".$_SESSION['uid'].", $qid, $vote_aid)";
            mysqli_query($conn, $sql_vote_track);
            header('Location: show_answer.php');
        }
        else {echo 'Error: ' . mysqli_error($conn);}
    }
    }

    
    echo '<div>'.
    "<br>".'<form method="post">'.
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
        echo("<script>location.href = 'show_answer.php';</script>");
    }
?>
</div>


</body>
</html>
