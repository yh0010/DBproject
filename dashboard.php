<?php
include("auth_session.php");
include('connectdb.php');
require 'format.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Dashboard</title>
    <link href="styles.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php echo present_header($_SESSION['headerName'], $_SESSION['username']); ?>

<div class="content">
    <div class="form">
    <form action='create_question.php' method="post">
    <p>
        <?php echo "Didn't find what you are looking for? "; ?>
        
        <input type="submit" name='create_quest' value="Ask New Question"</p>
    </form>


        <br><p>
        <form method='post'>
            <textarea name="question" cols=50 rows=3
                      placeholder="Enter your question here to begin searching..."></textarea>
            <div><input type="submit" name="submit" value="Search"></div>
        </form>
    </div>

    <br><p>Search by topics:</p><br>
    <?php
    //we need to obtain user id for later use. user id is stored into session array.
    $sql_uid = "SELECT uid FROM webuser WHERE username = '" . $_SESSION['username'] . "'";
    $row = mysqli_fetch_row(mysqli_query($conn, $sql_uid));
    $_SESSION['uid'] = $row[0];

    //obtain 1st level topic from the topic hierarchy
    $sql = "SELECT topicname FROM topic WHERE parent is NULL";
    $result = mysqli_query($conn, $sql);
    $feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    //enable topic name itself becomes a button
    foreach ($feedback as $item):
        echo "<form class = 'topics_form' method='post'>
            <input type='submit' name='topic_button' value='" . $item['topicname'] . "'>
            </form>";
    endforeach;

    //when topic is being clicked, direct user to another page
    if (isset($_POST['topic_button'])) {
        $_SESSION['TopicName'] = $_POST['topic_button'];
        header('Location: showAns_byTopic.php');
    }
    ?>

<?php
//above is topic selection search. This is typing search.
//when submit button is clicked, begin string comparison searching from database.
if (isset($_POST['submit'])) {
    if (!empty($_POST['question'])) {
        $sql_word = "SELECT * FROM `question` WHERE LOCATE('" . $_POST['question'] . "', title) > 0 
        OR LOCATE('" . $_POST['question'] . "', body) > 0";
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
        if (empty($return )){echo "No question is found under this keyword";}
        foreach ($return as $item):
            echo '<p>';
            echo
                "<form method='post'>
            <input type='submit' class='link-button' name='quest_button' value='" . $item['title'] . "'>
            </form>" . $item['body'] . "<br>";
            echo '<p>';

        endforeach;
    } else {
        echo "<p class='message'>Please type a question/key word to begin the search</p>";
    }
}

//direct user to another page when using typing search
if (isset($_POST['quest_button'])) {
    $_SESSION['ButtonName'] = $_POST['quest_button'];
    $_SESSION['DashButton'] = 'Y';
    header('Location: show_answer.php');
} else {
    unset($_SESSION['DashButton']);
}
?>
</div>

</body>
</html>