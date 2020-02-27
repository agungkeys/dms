<?php
	require '../../engine/db_config.php';
	$id  = $_POST["id"];
	$sql = "DELETE FROM cluster WHERE CLUSTERID = '".$id."'";
	$result = $mysqli->query($sql);
	echo json_encode([$id]);
?>