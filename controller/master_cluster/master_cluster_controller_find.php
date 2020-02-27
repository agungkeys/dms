<?php
	require '../../engine/db_config.php';
	$id  = $_POST["id"];
	$sql = "SELECT * FROM cluster WHERE CLUSTERID = '".$id."'"; 
	$result = $mysqli->query($sql);
	$json = [];
	while($row = $result->fetch_assoc()){
		$json[] =[
			'CLUSTERID'=>$row['CLUSTERID'], 
			'PROJECTID'=>$row['PROJECTID'], 
			'PROJECTNAME'=>$row['PROJECTNAME'], 
			'KAVBLOK'=>$row['KAVBLOK'], 
			'KAVNO'=>$row['KAVNO'], 
			'TYPELB'=>$row['TYPELB'], 
			'TYPELT'=>$row['TYPELT'], 
			'EXCESSLAND'=>$row['EXCESSLAND'], 
			'DESCRIPTION'=>$row['DESCRIPTION'], 
			'DATECREATE'=>$row['DATECREATE'],
		];
	}
	echo json_encode($json);
?>
