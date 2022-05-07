<?php
//session_start();

include 'connectdb.php';


if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    if (empty($username)) {
        header("Location: index.php?error=Username is required");
        exit();
    }
    else if(empty($password)){
        header("Location: index.php?error=Password is required");
        exit();
    }
    else{
        $stmt = $conn->prepare("SELECT * FROM webuser WHERE username = '$username' and password = '$password'");
        $stmt->execute();
        $stmt->store_result();
        $num_of_rows = $stmt->num_rows;
        if ($num_of_rows == 1) {
            header("Location: home.php");
            exit();
        }
        else{
            header("Location: index.php?error=Incorrect username or password");
            exit();
        }

    }

}
else{

    header("Location: index.php");

    exit();
}





