<!-- Bailey -->
<?php
  session_start();
  $_SESSION['logged_in'] = NULL;
  $_SESSION['admin'] = NULL;
  header("Location: /");
?>

   