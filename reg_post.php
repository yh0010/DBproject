<?php
require('connectdb.php');

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['city'])
    && isset($_POST['state']) && isset($_POST['country'])) {
    function validate($conn, $data){
        $data = stripslashes($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }
    $username = validate($conn, $_POST['username']);
    $email = validate($conn, $_POST['email']);
    $password = validate($conn, $_POST['password']);
    $city = validate($conn, $_POST['city']);
    $state = validate($conn, $_POST['state']);
    $country = validate($conn, $_POST['country']);
    $profile = validate($conn, $_POST['profile']);


    // check if all fields except profile is entered
    if (empty($username) || empty($email) || empty($password) || empty($city) || empty($state)
        || empty($country)) {
        header("Location: registration.php?error=Every field except profile is required");
        exit();
    }
    else {
        // check if the username is already in the database
        $check_query =  "SELECT * FROM webuser WHERE BINARY username = '$username'";
        $check_result = mysqli_query($conn, $check_query);
        $feedback = mysqli_fetch_all($check_result, MYSQLI_ASSOC);

        if ($feedback){
            header("Location: registration.php?error=The username is already used, please enter another one.");
            exit();
        }

        // insert data into the webuser table in database
        $query    = "INSERT into webuser (username, email, password, city, state, country, profile, status, points)
                     VALUES ('$username', '$email','$password', '$city', '$state', '$country', '$profile', 'Basic', 0)";
        $result   = mysqli_query($conn, $query);
        if ($result) {
            header("Location: index.php?error=You are registered successfully.");
            exit();
        }
        else {
            header("Location: registration.php?error=Registration is failed.");
            exit();
        }

    }
}
else{
    header("Location: registration.php");

    exit();
}