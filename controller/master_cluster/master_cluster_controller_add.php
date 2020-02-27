<?php
	require '../../engine/db_config.php';

	$post = $_POST;
	$sql = "INSERT INTO cluster ( PROJECTID, PROJECTNAME, KAVBLOK, KAVNO, TYPELB, TYPELT, EXCESSLAND, DESCRIPTION ) VALUES (
		'".$post['projectid']."',
		'".$post['projectname']."',
		'".$post['kavblok']."',
		'".$post['kavno']."',
		'".$post['typelb']."',
		'".$post['typelt']."',
		'".$post['landexcess']."',
		'".$post['description']."'
	)";
	$result = $mysqli->query($sql);
	$sql = "SELECT * FROM cluster Order by DATECREATE desc LIMIT 1"; 
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
	echo json_encode($data);
?>
