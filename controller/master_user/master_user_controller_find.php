<?php
	require '../../engine/db_config.php';
	$id  = $_POST["username"];
	$sql = "SELECT * FROM user WHERE USERNAME = '".$id."'"; 
	$result = $mysqli->query($sql);
	$json = [];
	while($row = $result->fetch_assoc()){
		$json[] =[
			'USERID'=>$row['USERID'], 
			'USERNAME'=>$row['USERNAME'], 
			'FULLNAME'=>$row['FULLNAME'], 
			'USER_EMAIL'=>$row['USER_EMAIL'], 
			'USER_PASSWORD'=> base64_decode($row['USER_PASSWORD']), 
			'LEVEL'=>$row['LEVEL'], 'DATECREATE'=>$row['DATECREATE']
		];
	}
	echo json_encode($json);
?>