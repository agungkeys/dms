<?php
	require '../../engine/db_config.php';
	$id  = $_POST["id"];
	$sql = "SELECT * FROM category WHERE CATEGORYID = '".$id."'";
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
  	echo json_encode($data);
?>