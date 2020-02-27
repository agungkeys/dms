<?php
  require '../../engine/db_config.php';

  $timezone = "Asia/Singapore";
  date_default_timezone_set($timezone);
  $date = date('Y-m-d H:i:s');
  $sql = "UPDATE user SET  
    FULLNAME     = '".$_POST["fullname"]."', 
    USER_EMAIL    = '".$_POST["email"]."', 
    USER_PASSWORD = '".base64_encode($_POST["password"])."', 
    LEVEL         = '".$_POST["level"]."', 
    DATECREATE = '".$date."' WHERE USERNAME = '".$_POST["username"]."'";
  $result = $mysqli->query($sql);
  $sql = "SELECT * FROM user WHERE USERNAME = '".$_POST["username"]."'"; 
  $result = $mysqli->query($sql);
  $data = $result->fetch_assoc();
  echo json_encode($data);
?>