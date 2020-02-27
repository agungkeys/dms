<?php
	require '../../engine/db_config.php';

	$post = $_POST;
	$sql = "INSERT INTO user (
		USERNAME, 
		FULLNAME, 
		USER_EMAIL, 
		USER_PASSWORD, 
		LEVEL
	)
	VALUES (
		'".$post['username']."',
		'".$post['fullname']."',
		'".$post['email']."',
		'".base64_encode($post['password'])."',
		'".$post['level']."'
	)";
	$result = $mysqli->query($sql);
	$sql = "SELECT * FROM user Order by DateCreate desc LIMIT 1"; 
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
	echo json_encode($data);
?>