<?php
  require '../../engine/db_config.php';

  $timezone = "Asia/Singapore";
  date_default_timezone_set($timezone);
  $date = date('Y-m-d H:i:s');
  $sql = "UPDATE cluster SET  
    PROJECTID  = '".$_POST["projectid"]."', 
    PROJECTNAME = '".$_POST["projectname"]."', 
    KAVBLOK = '".$_POST["kavblok"]."', 
    KAVNO = '".$_POST["kavno"]."', 
    TYPELB = '".$_POST["typelb"]."', 
    TYPELT = '".$_POST["typelt"]."', 
    EXCESSLAND = '".$_POST["excessland"]."', 
    DESCRIPTION = '".$_POST["description"]."', 
    DATECREATE = '".$date."' WHERE CLUSTERID = '".$_POST["id"]."'";
  $result = $mysqli->query($sql);
  $sql = "SELECT * FROM cluster WHERE CLUSTERID = '".$_POST["id"]."'"; 
  $result = $mysqli->query($sql);
  $data = $result->fetch_assoc();
  echo json_encode($data);
?>