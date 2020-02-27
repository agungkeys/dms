<?php
	require '../../engine/db_config.php';

	// Start Create Sell ID with 'TS'
	$se_id = "SELECT SELLID FROM transaction_sell"; 
	$se_ress = $mysqli->query($se_id);
	$se_json = [];
	while($se_row = $se_ress->fetch_assoc()){
	     $se_json[] = ['kode'=>substr($se_row['SELLID'], 2, 5)];
	}
	if($se_json != null){
		$se_res = json_encode(max($se_json));
		$se_res1 = json_decode($se_res, true);
		$se_res2 = $se_res1['kode'];
		$se_res3 = intval($se_res2);
		$se_res4 = $se_res3+1;
		$se_char = "TS";
		$se_resid = $se_char . sprintf("%05s", $se_res4);
	}else{
		$se_resid = "TS00001";
	}
	// End Create Sell ID with 'TS'

	$post = $_POST;
	$sql = " INSERT INTO transaction_sell ( 
		SELLID,
		CUSTOMERID, 
		FULLNAME, 
		KTP, 
		NPWP, 
		ADDRESS, 
		ZIPCODE, 
		NAMEPROVINCE, 
		NAMEKABUPATEN, 
		NAMEKECAMATAN, 
		NAMEKELURAHAN, 
		TELPHP, 
		EMAIL, 
		IDCLUSTER, 
		PROJECTNAME, 
		KAVBLOK, 
		KAVNO, 
		TYPELB, 
		TYPELT, 
		EXCESSLAND, 
		BFTOTAL, 
		BFACCOUNTID, 
		BFACCOUNTNAME, 
		BFDATE, 
		DPTOTAL, 
		DPACCOUNTID, 
		DPACCOUNTNAME, 
		DPDATE, 
		PAYTOTAL, 
		PAYACCOUNTID, 
		PAYACCOUNTNAME, 
		PAYDATE, 
		TYPE, 
		DATECREATE, 
		CREATED, 
		DESCRIPTION
	) VALUES ( 
		'".$se_resid."', 
		'".$post['customerid']."', 
		'".$post['fullname']."', 
		'".$post['ktp']."', 
		'".$post['npwp']."', 
		'".$post['address']."', 
		'".$post['zipcode']."', 
		'".$post['province']."',
		'".$post['kabupaten']."',
		'".$post['kecamatan']."',
		'".$post['kelurahan']."',
		'".$post['handphone']."',
		'".$post['email']."',
		'".$post['clusterid']."',
		'".$post['projectname']."',
		'".$post['kavblok']."',
		'".$post['kavno']."',
		'".$post['typelb']."',
		'".$post['typelt']."',
		'".$post['excessland']."',
		'".$post['bfTotal']."', 
		'".$post['bfAccountID']."', 
		'".$post['bfAccountName']."', 
		'".$post['bfDate']."', 
		'".$post['dpTotal']."', 
		'".$post['dpAccountID']."', 
		'".$post['dpAccountName']."',
		'".$post['dpDate']."',
		'".$post['payTotal']."',
		'".$post['payAccountID']."',
		'".$post['payAccountName']."',
		'".$post['payDate']."',
		'".$post['type']."',
		'".$post['date']."',
		'".$post['created']."',
		'".$post['description']."'
	) ";
	$result = $mysqli->query($sql);
	$sql = "SELECT * FROM transaction_sell Order by DATECREATE asc LIMIT 1";
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();

	$update_cluster = "UPDATE cluster SET  
    STATUS = 'SOLD' WHERE CLUSTERID = '".$_POST["clusterid"]."'";
  	$result_cluster = $mysqli->query($update_cluster);
  	// $data_cluster = $result_cluster->fetch_assoc();

  	echo json_encode($data);
?>