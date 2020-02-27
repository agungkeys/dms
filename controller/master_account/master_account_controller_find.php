<?php
	require '../../engine/db_config.php';
	$id  = $_POST["id"];
	$sql = "SELECT * FROM account WHERE ACCOUNTID = '".$id."'";
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
  	echo json_encode($data);
?>