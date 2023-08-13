<?php 
    session_start();

    include("../../dbconnect.php");

    $username = mysqli_real_escape_string($dbconnect, $_POST['username-or-email']);
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);

    # $stmt = $dbconnect->prepare("SELECT * FROM user WHERE userID=?");
    # $stmt->bind_param("i", $userID);

    $stmt = $dbconnect->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $results = $stmt->get_result();
    
    if (!$results->num_rows) header("Location: signin.php?error=fail");
    else {
      $user_aa = $results->fetch_assoc();

      $hash_password = $user_aa['password'];

      if (password_verify($password, $hash_password)) {
        $_SESSION['logged_in']['username'] = $username;
        $_SESSION['logged_in']['security'] = $user_aa['security'];

        if (!$user_aa['security']) header("Location: ../../account.php");
        else header("Location: ../../adminpanel.php");

      } else header("Location: signin.php?error=fail");
    }

   