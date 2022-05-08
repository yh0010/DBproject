<button type='button' onclick="location.href='dashboard.php';">Return to dashboard</button>

<?php

include("auth_session.php");
include('connectdb.php');


    $sql_topic = "SELECT * FROM question JOIN belongs USING(qid) JOIN topic USING(tid) WHERE topicname = '".$_SESSION['TopicName']."'";
    $res_topic = mysqli_query($conn, $sql_topic);
    $ret_topic = mysqli_fetch_all($res_topic, MYSQLI_ASSOC);
    $_SESSION['retTopic'] = $ret_topic;

    foreach ($ret_topic as $item):
        echo '<p>';
        echo 
        "<form method='post'>
        <input type='submit' name='q_button' value='".$item['title']."'>
        </form>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$item['body']."<br>";
        echo '<p>';

    endforeach;
    if (isset($_POST['q_button'])) {
        $_SESSION['ButtonName'] = $_POST['q_button'];
        header('Location: show_answer.php');
      }

?>