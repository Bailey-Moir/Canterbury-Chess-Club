<?php

    include("dbconnect.php");

    $username = mysqli_real_escape_string($dbconnect, $_POST['username']);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);
                      
    $result = $mysqli->query("SELECT id FROM user WHERE username = '$username'");
    $result2 = $mysqli->query("SELECT id FROM user WHERE email = '$username'");

    if(mysqli_num_rows($result) > 0 or mysqli_num_rows($result2) > 0) {

    ?>
    <div class="alter alert-danger" role="alert" style="color: rgb(255, 0, 0); padding-bottom: 10px;    ">
        Useranme or Password is already in use, please use something else
    </div>
    <?php }

    $stmt = $dbconnect->prepare("INSERT INTO user (email, username, password) VALUES (?, ?, ?)");
    $stmt -> bind_param("sss", $email, $username, $password);
    $stmt -> execute();

    header("Location: signin.php");
?>