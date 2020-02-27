<?php
	require '../../engine/db_config.php';

	$post = $_POST;
	$sql = "INSERT INTO category (
		MAINCATEGORYID, CATEGORYNAME, DESCRIPTION
	)
	VALUES (
		'".$post['maincategoryid']."',
		'".$post['categoryname']."',
		'".$post['categoryinfo']."'
	)";
	$result = $mysqli->query($sql);
	$sql = "SELECT * FROM category Order by DateCreate desc LIMIT 1"; 
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
	echo json_encode($data);
?>


