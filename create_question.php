<!-- 
In this file, user can create new question in which the new question will be store into database and can be viewed through
dashboard searching.
User would need to provid both the question title and body before contintue to next step.
User will need to select tags for the question. The tags will later be added into 'belongs' table, this part is incomplete. -->

<?php
include('connectdb.php');
include("auth_session.php");
require 'format.inc.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>New_Question</title>
    <link href="style.css" type="text/css" rel="stylesheet"/>
</head>
<body>

<?php echo present_header($_SESSION['headerName'], $_SESSION['username']); ?>
<div class="content">
</form>
<h2>Please select tags first to begin..</h2>
        <?php
            $mysqli = NEW mysqli('localhost', 'elaina2','123123', 'project');
            $set = $mysqli->query("SELECT tid, topicname FROM topic WHERE tid < 7");
        ?>
    <div>

        <select id=s1  name="1st-lvl-topic" onchange='reload()' class='form-control';>
        <option value="0">Select tag</option>
        
            <?php
            while ($row = $set->fetch_assoc()){
                $topic_name = $row['topicname'];
                echo "<option value='$topic_name'>$topic_name</option>";
            }
            ?>
        </select>
    
        <?php
        if (!empty($_GET['cat'])){
            $_SESSION['cat'] = $cat = $_GET['cat'];

        }
        $query = "SELECT topicname FROM topic WHERE parent=(SELECT tid FROM topic WHERE topicname = ?)";
        if ($stmt = $conn->prepare($query)){
            $stmt->bind_param('s', $cat);
            $stmt->execute();
            $r_set = $stmt->get_result();
        } 
        ?>
        <SELECT id=s2 onchange='reload2()' name=2nd-lvl-topic class='form-control';>
        <option value="0">Select tag</option>
            <?php while ($row = $r_set->fetch_assoc()){
                $topic_name = $row['topicname'];
                echo "<option value='$topic_name'>$topic_name</option>";
            }?>
        </SELECT>
    
 
    <?php
    if (!empty($_GET['cat2'])){
        $_SESSION['cat2'] = $cat2 = $_GET['cat2'];

    }
    if ($stmt = $conn->prepare($query)){
        $stmt->bind_param('s', $cat2);
        $stmt->execute();
        $r_set2 = $stmt->get_result();
    }
    ?>

    <SELECT id=s3  onchange='reload3()' name="3rd-lvl-topic" class='form-control';>
            <option value="0">Select tag</option>
            <?php while ($row = $r_set2->fetch_assoc()){
                echo "<option value=$row[topicname]>$row[topicname]</option>";
            }?>

    </SELECT>
    <?php
    if (!empty($_GET['cat3'])){
        $_SESSION['cat3'] = $cat3 = $_GET['cat3'];

    }
    ?>
    </div>
   
    <script>
        function reload(){
            var v1=document.getElementById('s1').value;
            self.location='create_question.php?cat=' + v1;
        }
        function reload2(){
            var v2=document.getElementById('s2').value;
            self.location='create_question.php?cat2=' +v2;
        }
        function reload3(){
            var v3=document.getElementById('s3').value;
            self.location='create_question.php?cat3=' +v3;
        }
    </script>

    <?php 
        if (!empty($_SESSION['cat'])){echo 'selected: '.$_SESSION['cat'].' ';}
        if (!empty($_SESSION['cat2'])){echo $_SESSION['cat2'].' ';}
        if (!empty($_SESSION['cat3'])){echo $_SESSION['cat3'];}
        
    ?>
    
    <form method='post'>
        <br><h2>Question Title</h2>
            <h5>Be specific and imagine you are asking a question to another person</h5>
            <textarea cols=80 rows=2 class="form-control" id="title" name="title" placeholder="e.g. Is there an R function for finding the index? [include question mark]"></textarea>
        <h2>Body</h2>
            <h5>Include all the information someone would need to answer your question</h5>
            <textarea name="body" cols=100 rows=20 class="form-control" ></textarea>

    <div><br><input type="submit" name="submit" value="Submit"></div>



<?php

    if (isset($_POST['submit'])){
        if (empty($_POST['title']) || empty($_POST['body'])){
            echo '<br>'.'Please fill out title and body before continue';
            exit();
        } else {
            $title = $_POST['title'];
            $body = $_POST['body'];

            $sql = "INSERT INTO question(uid, title, body, qtime, resolved) 
            VALUES (".$_SESSION['uid'].", '$title', '$body', CURRENT_TIMESTAMP, 'N')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                if (!empty($_SESSION['cat'])){
                    $sql_tag1 = "insert into belongs values ((select qid from question where qid = (select max(qid) from question)), (select tid from topic where topicname = '".$_SESSION['cat']."'))";
                    $result1 = mysqli_query($conn, $sql_tag1);
                    unset($_SESSION['cat']);
                    if ($result1){}else{echo 'Error1: ' . mysqli_error($conn);}
                }
                if (!empty($_SESSION['cat2'])){
                    $sql_tag2 = "insert into belongs values ((select qid from question where qid = (select max(qid) from question)), (select tid from topic where topicname = '".$_SESSION['cat2']."'))";
                    $result2 = mysqli_query($conn, $sql_tag2);
                    unset($_SESSION['cat2']);
                    if ($result2){}else{echo 'Error2: ' . mysqli_error($conn);}
                }
                if (!empty($_SESSION['cat3'])){
                    $sql_tag3 = "insert into belongs values ((select qid from question where qid = (select max(qid) from question)), (select tid from topic where topicname = '".$_SESSION['cat3']."'))";
                    $result3 = mysqli_query($conn, $sql_tag3);
                    unset($_SESSION['cat3']);
                    if ($result3){}else{echo 'Error3: ' . mysqli_error($conn);}
                }

                echo '<br>'."Your question is successfully posted!";
            }
            else {
                echo 'Failed to post';
                echo 'Error: ' . mysqli_error($conn);
                exit();
            }
        }
    }
?>
</div>
</body>
</html>