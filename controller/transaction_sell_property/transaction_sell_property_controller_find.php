<?php
	require '../../engine/db_config.php';
	$id  = $_POST["id"];
	$sql = "SELECT * FROM transaction_sell WHERE SELLID = '".$id."'"; 
	$result = $mysqli->query($sql);
	$json = [];
	while($row = $result->fetch_assoc()){
		$json[] =[
			'SELLID'=>$row['SELLID'], 
			'CUSTOMERID'=>$row['CUSTOMERID'], 
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
			'EMAIL'=>$row['EMAIL'], 
			'CLUSTERID'=>$row['CLUSTERID'], 
			'CHEQUE'=>$row['CHEQUE'], 
			'PROJECTID'=>$row['PROJECTID'], 
			'PROJECTNAME'=>$row['PROJECTNAME'], 
			'ACCOUNTID'=>$row['ACCOUNTID'], 
			'KAVBLOK'=>$row['KAVBLOK'], 
			'KAVNO'=>$row['KAVNO'], 
			'TYPELB'=>$row['TYPELB'], 
			'TYPELT'=>$row['TYPELT'], 
			'EXCESSLAND'=>$row['EXCESSLAND'], 
			'PRICE'=>$row['PRICE'], 
			'BFTOTAL'=>$row['BFTOTAL'], 
			'BFACCOUNTID'=>$row['BFACCOUNTID'], 
			'BFACCOUNTNAME'=>$row['BFACCOUNTNAME'], 
			'BFDATE'=>$row['BFDATE'], 
			'DPTOTAL'=>$row['DPTOTAL'], 
			'DPACCOUNTID'=>$row['DPACCOUNTID'], 
			'DPACCOUNTNAME'=>$row['DPACCOUNTNAME'], 
			'DPDATE'=>$row['DPDATE'], 
			'PAYTOTAL'=>$row['PAYTOTAL'], 
			'PAYACCOUNTID'=>$row['PAYACCOUNTID'], 
			'PAYACCOUNTNAME'=>$row['PAYACCOUNTNAME'], 
			'PAYDATE'=>$row['PAYDATE'], 
			'TYPE'=>$row['TYPE'], 
			'DATECREATE'=>$row['DATECREATE'], 
			'CREATED'=>$row['CREATED'], 
			'DESCRIPTION'=>$row['DESCRIPTION']
		];
	}
	echo json_encode($json);
?>

