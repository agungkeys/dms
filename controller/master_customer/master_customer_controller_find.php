<?php
	require '../../engine/db_config.php';
	$id  = $_POST["id"];
	$sql = "SELECT * FROM customer WHERE CUSTOMERID = '".$id."'"; 
	$result = $mysqli->query($sql);
	$json = [];
	while($row = $result->fetch_assoc()){
		$json[] =[
			'CUSTOMERID'=>$row['CUSTOMERID'], 
			'FULLNAME'=>$row['FULLNAME'], 
			'KTP'=>$row['KTP'], 
			'NPWP'=>$row['NPWP'], 
			'ADDRESS'=>$row['ADDRESS'], 
			'ZIPCODE'=>$row['ZIPCODE'], 
			'IDPROVINCE'=>$row['IDPROVINCE'], 
			'NAMEPROVINCE'=>$row['NAMEPROVINCE'], 
			'IDKABUPATEN'=>$row['IDKABUPATEN'], 
			'NAMEKABUPATEN'=>$row['NAMEKABUPATEN'], 
			'IDKECAMATAN'=>$row['IDKECAMATAN'], 
			'NAMEKECAMATAN'=>$row['NAMEKECAMATAN'], 
			'IDKELURAHAN'=>$row['IDKELURAHAN'], 
			'NAMEKELURAHAN'=>$row['NAMEKELURAHAN'], 
			'TELPHOME'=>$row['TELPHOME'], 
			'TELPOFFICE'=>$row['TELPOFFICE'], 
			'TELPHP'=>$row['TELPHP'], 
			'EMAIL'=>$row['EMAIL'], 
			'NOTE'=>$row['NOTE'], 
			'DATECREATE'=>$row['DATECREATE'],
		];
	}
	echo json_encode($json);
?>


