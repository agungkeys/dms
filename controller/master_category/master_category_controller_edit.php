<?php
  require '../../engine/db_config.php';

  $timezone = "Asia/Singapore";
  date_default_timezone_set($timezone);
  $date = date('Y-m-d H:i:s');
  $sql = "UPDATE category SET  
    MAINCATEGORYID     = '".$_POST["maincategoryid"]."', 
    CATEGORYNAME     = '".$_POST["categoryname"]."', 
    DESCRIPTION    = '".$_POST["categoryinfo"]."',
    DateCreate = '".$date."' WHERE CATEGORYID = '".$_POST["id"]."'";
  $result = $mysqli->query($sql);
  $sql = "SELECT * FROM category WHERE CATEGORYID = '".$_POST["id"]."'"; 
  $result = $mysqli->query($sql);
  $data = $result->fetch_assoc();
  echo json_encode($data);
?>