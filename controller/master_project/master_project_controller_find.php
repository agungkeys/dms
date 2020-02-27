<?php
	require '../../engine/db_config.php';
	$id  = $_POST["id"];
	$sql = "SELECT * FROM project WHERE PROJECTID = '".$id."'"; 
	$result = $mysqli->query($sql);
	$json = [];
	while($row = $result->fetch_assoc()){
		$json[] =[
			'PROJECTID'=>$row['PROJECTID'], 
			'PROJECTNAME'=>$row['PROJECTNAME'], 
			'PROJECTDESCRIPTION'=>$row['DESCRIPTION'], 
			'DATECREATE'=>$row['DATECREATE']
		];
	}
	echo json_encode($json);
?>