<?php
require '../../engine/db_config.php';

$sql = "SELECT MAINCATEGORYID, MAINCATEGORYNAME FROM maincategory WHERE GROUPS = 'Cost'";

$result = $mysqli->query($sql);

$json = [];
while($row = $result->fetch_assoc()){
    $json[] = ['id'=>$row['MAINCATEGORYID'], 'text'=>$row['MAINCATEGORYNAME']];
}

echo json_encode($json);
?>