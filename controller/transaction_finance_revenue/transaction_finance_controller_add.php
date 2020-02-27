<?php
	require '../../engine/db_config.php';
	
	// Start Create ID with 'TR'
	$sq = "SELECT TRANSACTIONID FROM transaction"; 
	$ress = $mysqli->query($sq);
	$json = [];
	while($row = $ress->fetch_assoc()){
	     $json[] = ['kode'=>substr($row['TRANSACTIONID'], 2, 5)];
	}
	if($json != null){
		$res = json_encode(max($json));
		$res1 = json_decode($res, true);
		$res2 = $res1['kode'];
		$res3 = intval($res2);
		$res4 = $res3+1;
		$char = "TR";
		$resid = $char . sprintf("%05s", $res4);
	}else{
		$resid = "TR00001";
	}
	// End Create ID with 'TR'

	$post = $_POST;
	$sql = " INSERT INTO transaction ( 
		TRANSACTIONID,
		MAINCATEGORYID, 
		MAINCATEGORYNAME, 
		COLOR,
		GROUPS,
		CATEGORYID,
		CATEGORYNAME,
		TRANSACTIONTITLE,
		QUANTITY,
		AMOUNT,
		TYPE,
		CHEQUE,
		PROJECTID,
		PROJECTNAME,
		ACCOUNTID,
		ACCOUNTNAME,
		ACCOUNTBANKNO,
		ACCOUNTBANKNAME,
		DATE,
		CREATED,
		DESCRIPTION
	) VALUES ( 
		'".$resid."', 
		'".$post['maincategoryid']."', 
		'".$post['maincategoryname']."', 
		'".$post['maincategorycolor']."', 
		'".$post['maincategorygroups']."', 
		'".$post['categoryid']."', 
		'".$post['categoryname']."', 
		'".$post['title']."',
		'0',
		'".$post['amount']."',
		'".$post['type']."',
		'".$post['cheque']."',
		'".$post['projectid']."',
		'".$post['projectname']."',
		'".$post['accountid']."',
		'".$post['accountname']."',
		'".$post['accountbankno']."',
		'".$post['accountbankname']."',
		'".$post['date']."',
		'".$post['created']."',
		'".$post['description']."' 
	) ";
	$result = $mysqli->query($sql);
	$sql = "SELECT * FROM transaction Order by DATECREATE asc LIMIT 1";
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
	echo json_encode($data);
?>