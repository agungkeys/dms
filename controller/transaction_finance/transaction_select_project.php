<?php
	require '../../engine/db_config.php';

	$post = $_POST;
	if($post == null){
		$sql = "SELECT PROJECTID, PROJECTNAME FROM project";
		// $sql = "SELECT IDKATSKPD, NAMEKATSKPD FROM kategori_skpd WHERE NAMEKATSKPD LIKE '%".$_GET['q']."%' LIMIT 50";
		$result = $mysqli->query($sql);

		$json = [];
		while($row = $result->fetch_assoc()){
		    $json[] = ['id'=>$row['PROJECTID'], 'text'=>$row['PROJECTNAME']];
		}
	}else{
		$resid  = $post['1'];
		$sql = "SELECT PROJECTID, PROJECTNAME FROM project WHERE PROJECTID ='".$resid."'";
		// $sql = "SELECT IDKATSKPD, NAMEKATSKPD FROM kategori_skpd WHERE NAMEKATSKPD LIKE '%".$_GET['q']."%' LIMIT 50";
		$result = $mysqli->query($sql);

		$json = [];
		while($row = $result->fetch_assoc()){
		    $json[] = ['id'=>$row['PROJECTID'], 'text'=>$row['PROJECTNAME']];
		}
	}
	echo json_encode($json);
?>