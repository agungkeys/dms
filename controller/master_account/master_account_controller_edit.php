<?php
  require '../../engine/db_config.php';

  $timezone = "Asia/Singapore";
  date_default_timezone_set($timezone);
  $date = date('Y-m-d H:i:s');
  $sql = "UPDATE account SET  
    ACCOUNTNAME     = '".$_POST["accountname"]."', 
    ACCOUNTBANKNO    = '".$_POST["accountbankno"]."',
    ACCOUNTBANKNAME    = '".$_POST["accountbankname"]."',
    DateCreate = '".$date."' WHERE ACCOUNTID = '".$_POST["id"]."'";
  $result = $mysqli->query($sql);
  $sql = "SELECT * FROM account WHERE ACCOUNTID = '".$_POST["id"]."'"; 
  $result = $mysqli->query($sql);
  $data = $result->fetch_assoc();
  echo json_encode($data);
?>