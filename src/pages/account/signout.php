<?php
  session_start();
  $_SESSION['logged_in'] = NULL;
  header("Location: /");
?>

   