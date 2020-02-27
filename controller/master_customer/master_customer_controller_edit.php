<?php
  require '../../engine/db_config.php';

  $timezone = "Asia/Singapore";
  date_default_timezone_set($timezone);
  $date = date('Y-m-d H:i:s');
  $sql = "UPDATE customer SET  
    FULLNAME  = '".$_POST["fullname"]."', 
    KTP = '".$_POST["ktp"]."', 
    NPWP = '".$_POST["npwp"]."', 
    ADDRESS = '".$_POST["address"]."', 
    ZIPCODE = '".$_POST["zipcode"]."', 
    NAMEPROVINCE  = '".$_POST["province"]."', 
    NAMEKABUPATEN = '".$_POST["kabupaten"]."', 
    NAMEKECAMATAN = '".$_POST["kecamatan"]."', 
    NAMEKELURAHAN = '".$_POST["kelurahan"]."', 
    TELPHOME  = '".$_POST["telphome"]."', 
    TELPOFFICE  = '".$_POST["telpoffice"]."', 
    TELPHP  = '".$_POST["telphp"]."', 
    EMAIL = '".$_POST["email"]."', 
    NOTE  = '".$_POST["note"]."', 
    DATECREATE = '".$date."' WHERE CUSTOMERID = '".$_POST["id"]."'";
  $result = $mysqli->query($sql);
  $sql = "SELECT * FROM customer WHERE CUSTOMERID = '".$_POST["id"]."'"; 
  $result = $mysqli->query($sql);
  $data = $result->fetch_assoc();
  echo json_encode($data);
?>
