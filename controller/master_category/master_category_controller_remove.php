<?php
	require '../../engine/db_config.php';
	$id  = $_POST["id"];
	$sql = "DELETE FROM category WHERE CATEGORYID = '".$id."'";
	$result = $mysqli->query($sql);
	echo json_encode([$id]);
?>