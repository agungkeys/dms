<?php
	require '../../engine/db_config.php';
	$sql = "SELECT SUM(AMOUNT) TOTAL FROM transaction WHERE GROUPS = 'Revenue' AND TYPE = 'Credit'";
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
  	echo json_encode($data);
?>