<?php
require '../../engine/db_config.php';

$sql = "SELECT CLUSTERID, PROJECTID, CONCAT(PROJECTNAME, ' ', KAVBLOK, ' ', KAVNO) AS MERGE_TITLE FROM cluster WHERE STATUS != 'SOLD' AND PROJECTID = ".$_GET['id']."";
// $sql = "SELECT IDKATSKPD, NAMEKATSKPD FROM kategori_skpd WHERE NAMEKATSKPD LIKE '%".$_GET['q']."%' LIMIT 50";
$result = $mysqli->query($sql);

$json = [];
while($row = $result->fetch_assoc()){
    $json[] = ['id'=>$row['CLUSTERID'], 'text'=>$row['MERGE_TITLE']];
}

echo json_encode($json);
?>