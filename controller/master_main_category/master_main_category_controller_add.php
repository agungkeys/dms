<?php
	require '../../engine/db_config.php';

	$post = $_POST;
	$sql = "INSERT INTO maincategory (
		MAINCATEGORYNAME, COLOR, DESCRIPTION, GROUPS
	)
	VALUES (
		'".$post['maincategoryname']."',
		'".$post['color']."',
		'".$post['maincategoryinfo']."',
		'".$post['group']."'
	)";
	$result = $mysqli->query($sql);
	$sql = "SELECT * FROM maincategory Order by DATECREATE desc LIMIT 1"; 
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
	echo json_encode($data);
?>


