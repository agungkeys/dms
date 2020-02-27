<?php
	require '../../engine/db_config.php';

	$sql = "SELECT CUSTOMERID, FULLNAME FROM customer";
	// $sql = "SELECT IDKATSKPD, NAMEKATSKPD FROM kategori_skpd WHERE NAMEKATSKPD LIKE '%".$_GET['q']."%' LIMIT 50";
	$result = $mysqli->query($sql);

	$json = [];
	while($row = $result->fetch_assoc()){
	    $json[] = ['id'=>$row['CUSTOMERID'], 'text'=>$row['FULLNAME']];
	}

	echo json_encode($json);
?>