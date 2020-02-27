<?php
	require '../../engine/db_config.php';

	$post = $_POST;
	$sql = "INSERT INTO customer ( FULLNAME, KTP, NPWP, ADDRESS, ZIPCODE, IDPROVINCE, NAMEPROVINCE, IDKABUPATEN, NAMEKABUPATEN, IDKECAMATAN, NAMEKECAMATAN, IDKELURAHAN, NAMEKELURAHAN, TELPHOME, TELPOFFICE, TELPHP, EMAIL, NOTE ) VALUES (
		'".$post['fullname']."',
		'".$post['ktp']."',
		'".$post['npwp']."',
		'".$post['address']."',
		'".$post['zipcode']."',
		'".$post['idprovince']."',
		'".$post['province']."',
		'".$post['idkabupaten']."',
		'".$post['kabupaten']."',
		'".$post['idkecamatan']."',
		'".$post['kecamatan']."',
		'".$post['idkelurahan']."',
		'".$post['kelurahan']."',
		'".$post['telphome']."',
		'".$post['telpoffice']."',
		'".$post['telphp']."',
		'".$post['email']."',
		'".$post['note']."'
	)";
	$result = $mysqli->query($sql);
	$sql = "SELECT * FROM customer Order by DATECREATE desc LIMIT 1"; 
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
	echo json_encode($data);
?>