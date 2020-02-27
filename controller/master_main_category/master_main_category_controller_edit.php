<?php
  require '../../engine/db_config.php';

  $timezone = "Asia/Singapore";
  date_default_timezone_set($timezone);
  $date = date('Y-m-d H:i:s');
  $sql = "UPDATE maincategory SET  
    MAINCATEGORYNAME     = '".$_POST["maincategoryname"]."', 
    DESCRIPTION    = '".$_POST["maincategoryinfo"]."',
    COLOR    = '".$_POST["color"]."',
    GROUPS    = '".$_POST["group"]."',
    DateCreate = '".$date."' WHERE MAINCATEGORYID = '".$_POST["id"]."'";
  $result = $mysqli->query($sql);
  $sql = "SELECT * FROM maincategory WHERE MAINCATEGORYID = '".$_POST["id"]."'"; 
  $result = $mysqli->query($sql);
  $data = $result->fetch_assoc();
  echo json_encode($data);
?>