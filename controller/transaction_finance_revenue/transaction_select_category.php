<?php
require '../../engine/db_config.php';

$sql = "SELECT CATEGORYID, CATEGORYNAME FROM category WHERE MAINCATEGORYID = ".$_GET['cat']."";
// $sql = "SELECT IDKATSKPD, NAMEKATSKPD FROM kategori_skpd WHERE NAMEKATSKPD LIKE '%".$_GET['q']."%' LIMIT 50";
$result = $mysqli->query($sql);

$json = [];
while($row = $result->fetch_assoc()){
    $json[] = ['id'=>$row['CATEGORYID'], 'text'=>$row['CATEGORYNAME']];
}

echo json_encode($json);
?>