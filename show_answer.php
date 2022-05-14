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
<?php echo present_header($_SESSION['headerName'], $_SESSION['username']); ?>

<div class="content">

    <?php

    function validate_escape($conn, $data)
    {
        $data = stripslashes($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }

    function validate($data)
    {
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

        if ($r_row[1] == $_SESSION['uid']) {
            echo '<form method="post">' .
                '<input type="submit" name="sol_submit" value="Solved">' .
                '<input type="submit" name="sol_submit" value="Unsolved">' .
                '</form>';
        }
        echo '<h2>' . '[' . $r_row[2] . ']' . '</h2>';

        if (isset($_POST['sol_submit'])) {
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


        $sql_quest = "SELECT * FROM question JOIN webuser USING(uid) WHERE title = '$question_title'";
        $row = mysqli_fetch_row(mysqli_query($conn, $sql_quest));


        echo "<div class='question'>";
        echo "<h3>$question_title</h3><p>$row[3]</p>";// show the question's title and body
        echo "<div class='container'><div id='left-80'></div><div id='right-20'>";
        echo "<div class='post-info-row'><p><span>Asked by </span>: $row[7]</p></div>";
        echo "<div class='post-info-row'><p><span>Posted at </span>: $row[4]</p></div>";
        echo "<div class='post-info-row'><p><span>User Status </span>: $row[14]</p></div>";
        echo "<div class='post-info-row'><p><span>Points </span>: $row[15]</p></div>";
        echo "</div></div></div>";


        $sql_answer = "SELECT * FROM answer JOIN webuser USING(uid) JOIN question USING(qid) WHERE title = '$question_title' ORDER BY atime DESC";
        $res = mysqli_query($conn, $sql_answer);
        $ret = mysqli_fetch_all($res, MYSQLI_ASSOC);
        if ($res) {
        } else {
            echo mysqli_error($conn);
        }

        //assign current qid to variable $qid
        $qid = $row[1];

        //give warning when no answer is found, otherwise display answers by timestamp New->Old and list answerer's info
        if (empty($ret)) {
            echo "<h4>No answer is found.</h4>";
        }

        if (isset($_GET['error'])) { ?>

    <p class="error"><?php echo $_GET['error']; ?></p>
    

    <?php }
        echo "<div class='answer'>";
        echo "<h3>Answers:</h3>";
        $sql_check_best = "SELECT best FROM question WHERE qid = $qid AND best is not null";
        $res_best = mysqli_fetch_row(mysqli_query($conn, $sql_check_best));
        if (!empty($res_best)){
            echo "Select Best Answer:"."<br>";
            $sql_display_best = "SELECT answer FROM answer JOIN webuser USING(uid) JOIN question USING(qid) WHERE title = '$question_title' AND aid = $res_best[0]";
            $res__display_best = mysqli_fetch_row(mysqli_query($conn, $sql_display_best));
            echo $res__display_best[0];
        }

        $count = 1;
        foreach ($ret as $item):
            $nam = $item['username'];
            $aid_real = $item['aid'];
            echo "<hr>";
            if ($r_row[1] == $_SESSION['uid']){
            echo "<form method='post'>
            <input type='submit' class='form-control' name='best_button' value='choose best answer($aid_real)'>
            </form>";
        }

            echo "<div class='container'><div id='left-10'>";
            echo "<form method='post'><button type='submit' name='upvote_button' value=vote($aid_real)$nam><img src='thumbup.jpg' height='20'></button>" . "\n" . $item['thumb_up'] . "</form>";
            echo "</div><div id='right-90'>".$item['answer']."</div></div>";
            echo "<div class='container'><div id='left-80'></div><div id='right-20'>";
            echo "<div class='post-info-row'><p><span>Answered by </span>: " . $item['username'] . "</p></div>";
            echo "<div class='post-info-row'><p><span>Posted at </span>: " . $item['atime'] . "</p></div>";
            echo "<div class='post-info-row'><p><span>User Status </span>: " . $item['status'] . "</p></div>";
            echo "<div class='post-info-row'><p><span>Points </span>: " . $item['points'] . "</p></div>";
            echo "</div></div>";


            $count += 1;
        endforeach;
        
        //assign next-in-line aid to variable $aid
        $aid = $count;

        if (isset($_POST['best_button']) && ($r_row[1] == $_SESSION['uid'])) {
            $best_aid = $_POST['best_button'][-2];
            echo "You have chosen ".$best_aid. " as your best answer";
            $sql_best = "UPDATE question
            SET
                best = $best_aid,
                qtime = qtime
            WHERE
                qid = $r_row[0]";
            $res_best = mysqli_query($conn, $sql_best);
            echo("<script>location.href = 'show_answer.php';</script>");
        }


        if (isset($_POST['upvote_button'])) {
            $vote_nam = substr($_POST['upvote_button'], 7);
            $vote_aid = $_POST['upvote_button'][5];

            $sql_check_vote = "SELECT * FROM vote_track WHERE uid = " . $_SESSION['uid'] . " and qid = $qid and aid = $vote_aid";
            $res_check_vote = mysqli_fetch_all(mysqli_query($conn, $sql_check_vote));

            if (empty($res_check_vote)) {
                $sql_vote = "UPDATE answer
        SET
            thumb_up = thumb_up+1,
            atime = atime
        WHERE
            aid = $vote_aid and qid = $qid";
                $res_vote = mysqli_query($conn, $sql_vote);
                if ($res_vote) {
                    $sql_vote_track = "INSERT INTO vote_track VALUES (" . $_SESSION['uid'] . ", $qid, $vote_aid)";
                    mysqli_query($conn, $sql_vote_track);
                    header('Location: show_answer.php');
                } else {
                    echo 'Error: ' . mysqli_error($conn);
                }
            }
            else{
                echo "<p class='message'> You have already voted this answer.</p>";
            }
        }


        echo '<div>' .
            "<br>" . '<form method="post">' .
            '<textarea name="answer" cols=50 rows=3 placeholder="Write your new answer here..."></textarea>' .
            '<div><input type="submit" name="ans_submit" value="Submit"></div>' .
            '</form>' .
            '</div>';

        if (isset($_POST['ans_submit'])) {
            if (!empty($_POST['answer'])) {
                $answer = $_POST['answer'];
                $query = "INSERT INTO answer(aid, qid, uid, answer, atime, thumb_up) 
            VALUES ($aid, $qid, " . $_SESSION['uid'] . ", '$answer', CURRENT_TIMESTAMP, 0)";
                $query_result = mysqli_query($conn, $query);
                if ($query_result) {
                    // success
                    echo 'You have successfully submitted your answer' . "<br>";
                    echo "<button type='button' onclick=\"location.href='show_answer.php';\">Refresh</button>";
                } else {
                    // error
                    echo 'Error: ' . mysqli_error($conn);
                }
                exit();
            } else {
                echo "<p class='message'>You cannot submit blank answer</p>";
            }
        }

        //enable similar questions display even when user is currently viewing a specific question, so that user will need not to return back to
        //dashboard to re-search again
        echo "<br>" . "<h3>See Similar Questions:</h3>" . "<br>";
        if (isset($_SESSION['retTopic'])) {
            $list = $_SESSION['retTopic'];
        }
        if (isset($_SESSION['DashButton'])) {
            $list = $_SESSION['return'];
        }


        if (empty($list)) {
            echo 'No similar questions.';
            exit();
        }

        foreach ($list as $item):
            $question_title_similar = validate($item['title']);
            $question_body_similar = validate($item['body']);
            echo '<p>';
            echo
                "<form method='post'>
        <input type='submit' class='link-button' name='q_button' value='$question_title_similar'>
        </form>" . $question_body_similar . "<br>";
            echo '<p>';

        endforeach;
    }
    if (isset($_POST['q_button'])) {
        $_SESSION['ButtonName'] = $_POST['q_button'];
        echo("<script>location.href = 'show_answer.php';</script>");
    }
    ?>
</div>


</body>
</html>
