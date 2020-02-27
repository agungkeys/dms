<?php
	require '../../engine/db_config.php';
	$sql = "SELECT COUNT(STATUS) TOTAL FROM cluster WHERE STATUS = 'SOLD'";
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
  	echo json_encode($data);
?>