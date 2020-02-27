<?php
	require '../../engine/db_config.php';
	$id  = $_POST["id"];
	$sql = "SELECT * FROM transaction WHERE TRANSACTIONID = '".$id."'"; 
	$result = $mysqli->query($sql);
	$json = [];
	while($row = $result->fetch_assoc()){
		$json[] =[
			'TRANSACTIONID'=>$row['TRANSACTIONID'], 
			'MAINCATEGORYID'=>$row['MAINCATEGORYID'], 
			'MAINCATEGORYNAME'=>$row['MAINCATEGORYNAME'], 
			'COLOR'=>$row['COLOR'], 
			'GROUPS'=>$row['GROUPS'], 
			'CATEGORYID'=>$row['CATEGORYID'], 
			'CATEGORYNAME'=>$row['CATEGORYNAME'], 
			'TRANSACTIONTITLE'=>$row['TRANSACTIONTITLE'], 
			'QUANTITY'=>$row['QUANTITY'], 
			'AMOUNT'=>$row['AMOUNT'], 
			'TYPE'=>$row['TYPE'], 
			'CHEQUE'=>$row['CHEQUE'], 
			'PROJECTID'=>$row['PROJECTID'], 
			'PROJECTNAME'=>$row['PROJECTNAME'], 
			'ACCOUNTID'=>$row['ACCOUNTID'], 
			'ACCOUNTNAME'=>$row['ACCOUNTNAME'], 
			'ACCOUNTBANKNO'=>$row['ACCOUNTBANKNO'], 
			'ACCOUNTBANKNAME'=>$row['ACCOUNTBANKNAME'], 
			// 'ACCOUNTBANKTYPE'=>$row['ACCOUNTBANKTYPE'], 
			'DATE'=>date( 'd-m-Y', strtotime($row['DATE'])), 
			'CREATED'=>$row['CREATED'], 
			'DESCRIPTION'=>$row['DESCRIPTION']
		];
	}
	echo json_encode($json);
?>