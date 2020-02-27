<?php
	require '../../engine/db_config.php';

	$post = $_POST;
	$sql = "INSERT INTO account (
		ACCOUNTNAME, 
		ACCOUNTBANKNO, 
		ACCOUNTBANKNAME
	)
	VALUES (
		'".$post['accountname']."',
		'".$post['accountbankno']."',
		'".$post['accountbankname']."'
	)";
	$result = $mysqli->query($sql);
	$sql = "SELECT * FROM account Order by DateCreate desc LIMIT 1"; 
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
	echo json_encode($data);
?>