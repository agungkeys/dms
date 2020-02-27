<?php
	require '../../engine/db_config.php';

	$post = $_POST;
	$sql = "INSERT INTO project (
		PROJECTNAME, 
		DESCRIPTION
	)
	VALUES (
		'".$post['projectname']."',
		'".$post['projectdescription']."'
	)";
	$result = $mysqli->query($sql);
	$sql = "SELECT * FROM project Order by DateCreate desc LIMIT 1"; 
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
	echo json_encode($data);
?>