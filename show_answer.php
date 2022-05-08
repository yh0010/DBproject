<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Home</title>
</head>
<body>
<button type='button' onclick="location.href='dashboard.php';">Return to dashboard</button>

<?php
include("auth_session.php");
include('connectdb.php');

if (isset($_SESSION['ButtonName'])) {
    echo '<p>'.$_SESSION['ButtonName'].'</p>';
    //$_SESSION['other_quest'] = 'Y';
    $sql_quest = "SELECT * FROM question JOIN webuser USING(uid) WHERE title = '".$_SESSION['ButtonName']."'";
    $row = mysqli_fetch_row(mysqli_query($conn, $sql_quest));
    echo 'Asked by: '.$row[7]."<br>";
    echo 'Posted by: '.$row[4]."<br>";
    echo 'User Status: '.$row[14]."<br>";
    echo 'Points: '.$row[15]."<br>";

    $sql_answer = "SELECT * FROM answer JOIN webuser USING(uid) JOIN question USING(qid) WHERE title = '".$_SESSION['ButtonName']."'";
    $res = mysqli_query($conn, $sql_answer);
    $ret = mysqli_fetch_all($res, MYSQLI_ASSOC);
    if ($res){}else{echo mysqli_error($conn);}

    foreach ($ret as $item):
        echo '<p>'.
            $item['aid']."<br>".$item['answer']."<br>".
            $item['atime']."<br>".$item['username']."\n".$item['status']."\n".$item['points']
        .'</p>';
        $aid = $item['aid'];
        $qid = $item['qid'];
    endforeach;
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
            VALUES ($aid+1, $qid, ".$_SESSION['uid'].", '$answer', CURRENT_TIMESTAMP, 0)";
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
    echo "<br>"."<h3>See Similar Questions:</h3>"."<br>";
    if (isset($_SESSION['retTopic'])){$list = $_SESSION['retTopic'];}
    if (isset($_SESSION['DashButton'])){$list = $_SESSION['return'];}
    foreach ($list as $item):
        echo '<p>';
        echo 
        "<form method='post'>
        <input type='submit' name='q_button' value='".$item['title']."'>
        </form>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$item['body']."<br>";
        echo '<p>';

    endforeach;}
    if (isset($_POST['q_button'])) {
        $_SESSION['ButtonName'] = $_POST['q_button'];
        header('Location: show_answer.php');
    }
?>
</body>
</html>
