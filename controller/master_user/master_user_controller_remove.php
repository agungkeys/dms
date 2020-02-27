<?php
	require '../../engine/db_config.php';
	$username  = $_POST["username"];
	$sql = "DELETE FROM user WHERE USERNAME = '".$username."'";
	$result = $mysqli->query($sql);
	echo json_encode([$username]);
?>