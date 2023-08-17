<?php
  session_start();
  include $_SERVER['DOCUMENT_ROOT']."/src/dbconnect.php";
  
  $username = $dbconnect->real_escape_string($_POST['username-or-email']);
  $password = $dbconnect->real_escape_string($_POST['password']);

  # $stmt = $dbconnect->prepare("SELECT * FROM user WHERE userID=?");
  # $stmt->bind_param("i", $userID);

  $stmt = $dbconnect->prepare("SELECT * FROM users WHERE username=? OR email=?");
  $stmt->bind_param("ss", $username, $email);
  $stmt->execute();
  $results = $stmt->get_result();
  
  if (!$results->num_rows) header("Location: /signin?error=fail");
  else {
    $user_aa = $results->fetch_assoc();

    $hash_password = $user_aa['password'];

    if (password_verify($password, $hash_password)) {
      $_SESSION['logged_in']['user_id'] = $user_aa['user_id'];
      $_SESSION['logged_in']['security'] = $user_aa['security'];

      if (!$user_aa['security']) header("Location: /account");
      else header("Location: /?page=adminpanel");

    } else header("Location: /signin?error=fail");
  }
?>

   