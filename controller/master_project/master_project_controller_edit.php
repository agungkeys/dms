<?php
  require '../../engine/db_config.php';

  $timezone = "Asia/Singapore";
  date_default_timezone_set($timezone);
  $date = date('Y-m-d H:i:s');
  $sql = "UPDATE project SET  
    PROJECTNAME     = '".$_POST["projectname"]."', 
    DESCRIPTION    = '".$_POST["projectdescription"]."', 
    DATECREATE = '".$date."' WHERE PROJECTID = '".$_POST["id"]."'";
  $result = $mysqli->query($sql);
  $sql = "SELECT * FROM project WHERE PROJECTID = '".$_POST["id"]."'"; 
  $result = $mysqli->query($sql);
  $data = $result->fetch_assoc();
  echo json_encode($data);
?>