/*
This page uses for tag selection, its not completed yet.
*/
<?php
include('connectdb.php');
include("auth_session.php");
?>
<button type='button' onclick="location.href='create_question.php';">Return to question</button>
</form>
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
        $cat = $_GET['cat'];}
        $query = "SELECT topicname FROM topic WHERE parent=(SELECT tid FROM topic WHERE topicname = ?)";
        if ($stmt = $conn->prepare($query)){
            $stmt->bind_param('s', $cat);
            $stmt->execute();
            $r_set = $stmt->get_result();
        } ?>

        <SELECT id=s2 onchange='reload2()' name=2nd-lvl-topic class='form-control';>
        <option value="0">Select tag</option>
            <?php while ($row = $r_set->fetch_assoc()){
                echo "<option value=$row[topicname]>$row[topicname]</option>";
            }?>
        </SELECT>
    
 
    <?php
    if (!empty($_GET['cat2'])){
        $cat2 = $_GET['cat2'];}
    if ($stmt = $conn->prepare($query)){
        $stmt->bind_param('s', $cat2);
        $stmt->execute();
        $r_set2 = $stmt->get_result();
    } 
    ?>

    <SELECT id=s3  name="3rd-lvl-topic" class='form-control';>
            <option value="0">Select tag</option>
            <?php while ($row = $r_set2->fetch_assoc()){
                echo "<option value=$row[topicname]>$row[topicname]</option>";
            }?>

    </SELECT>
    </div>
   
    <script>
        function reload(){
            var v1=document.getElementById('s1').value;
            //document.write(v1);
            self.location='select_tag.php?cat=' + v1;
        }
        function reload2(){
            var v2=document.getElementById('s2').value;
            document.write(v2);
            self.location='select_tag.php?cat2=' + v2;
        }
    </script>