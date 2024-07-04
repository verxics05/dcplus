<?php
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION["user_is_signin"]) && $_SESSION["user_is_signin"] == true) {

    $return = $_GET["return"];
    session_destroy();
    header("Location: {$return}");
    exit();
    
  } else {
    exit();
  }
?>