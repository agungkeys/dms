<?php
	require '../../engine/db_config.php';
	$id  = $_POST["id"];
	$sql = "SELECT * FROM customer WHERE CUSTOMERID = '".$id."'"; 
	$result = $mysqli->query($sql);
	$json = [];
	while($row = $result->fetch_assoc()){
		$json[] =[
			'FULLNAME'=>$row['FULLNAME'], 
			'KTP'=>$row['KTP'], 
			'NPWP'=>$row['NPWP'], 
			'ADDRESS'=>$row['ADDRESS'], 
			'ZIPCODE'=>$row['ZIPCODE'], 
			'NAMEPROVINCE'=>$row['NAMEPROVINCE'], 
			'NAMEKABUPATEN'=>$row['NAMEKABUPATEN'], 
			'NAMEKECAMATAN'=>$row['NAMEKECAMATAN'], 
			'NAMEKELURAHAN'=>$row['NAMEKELURAHAN'], 
			'TELPHP'=>$row['TELPHP'], 
			'EMAIL'=>$row['EMAIL']
		];
	}
	echo json_encode($json);
?>


