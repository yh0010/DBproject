<button type='button' onclick="location.href='dashboard.php';">Return to dashboard</button>

<?php

include("auth_session.php");
include('connectdb.php');

    echo '<h2>'.$_SESSION['TopicName'].'</h2>';

    $sql_topic = "SELECT * FROM question JOIN belongs USING(qid) JOIN topic USING(tid) WHERE topicname = '".$_SESSION['TopicName']."'";
    $sql_subtopic = "SELECT * FROM topic WHERE parent = (SELECT tid FROM topic WHERE topicname = '".$_SESSION['TopicName']."')";
    $res_topic = mysqli_query($conn, $sql_topic);
    $res_subtopic = mysqli_query($conn, $sql_subtopic);
    $ret_topic = mysqli_fetch_all($res_topic, MYSQLI_ASSOC);
    $ret_subtopic = mysqli_fetch_all($res_subtopic, MYSQLI_ASSOC);
    $_SESSION['retTopic'] = $ret_topic;


    if (empty($ret_topic)){echo "No question is found.";}
    foreach ($ret_topic as $item):
        echo '<p>';
        echo 
        "<form method='post'>
        <input type='submit' name='1st_lvl_button' value='".$item['title']."'>
        </form>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$item['body']."<br>";
        echo '<p>';

    endforeach;
    
    echo "<h3>Subtopics:</h3>";
    if (empty($ret_subtopic)){echo "No more subtopics";}
    foreach ($ret_subtopic as $item):

        echo 
        "<form method='post'>
        <input type='submit' name='2nd_lvl_button' value='".$item['topicname']."'>
        </form>";
    
    endforeach;
    //echo "sub topic button: ".$_POST['2nd_lvl_button'];

    if (isset($_POST['1st_lvl_button'])) {
        $_SESSION['ButtonName'] = $_POST['1st_lvl_button'];
        header('Location: show_answer.php');
      }
    elseif (isset($_POST['2nd_lvl_button'])){
        $_SESSION['TopicName'] = $_POST['2nd_lvl_button'];
        header('Location: showAns_byTopic.php');
    }
?>