<?php
	require '../../engine/db_config.php';
	$post 	= $_POST;
	if($post == null){
		$sql = "SELECT PROJECTID, PROJECTNAME FROM project";
		// $sql = "SELECT IDKATSKPD, NAMEKATSKPD FROM kategori_skpd WHERE NAMEKATSKPD LIKE '%".$_GET['q']."%' LIMIT 50";
		$result = $mysqli->query($sql);

		$json = [];
		while($row = $result->fetch_assoc()){
		    $json[] = ['id'=>$row['PROJECTID'], 'text'=>$row['PROJECTNAME']];
		}
	}else{
		$resid  = $post['id'];
        $sql 	= "SELECT * FROM project WHERE PROJECTID = '".$resid."'";
        $result = $mysqli->query($sql);
        $json 	= $result->fetch_assoc();
	}	

	echo json_encode($json);
?>