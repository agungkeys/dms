<?php
	require '../../engine/db_config.php';

	$post = $_POST;
	if($post == null){
		$sql = "SELECT ACCOUNTID, CONCAT(ACCOUNTNAME,' ',ACCOUNTBANKNO) AS ACCOUNTNAMES, ACCOUNTNAME, ACCOUNTBANKNO, ACCOUNTBANKNAME FROM account";
		// $sql = "SELECT IDKATSKPD, NAMEKATSKPD FROM kategori_skpd WHERE NAMEKATSKPD LIKE '%".$_GET['q']."%' LIMIT 50";
		$result = $mysqli->query($sql);

		$json = [];
		while($row = $result->fetch_assoc()){
		    $json[] = ['id'=>$row['ACCOUNTID'], 'text'=>$row['ACCOUNTNAMES'], 'accountname'=>$row['ACCOUNTNAME'], 'accountbankno'=>$row['ACCOUNTBANKNO'], 'accountbankname'=>$row['ACCOUNTBANKNAME'],];
		}
	}else{
		$resid  = $post['1'];
		$sql = "SELECT ACCOUNTID, CONCAT(ACCOUNTNAME,' ',ACCOUNTBANKNO) AS ACCOUNTNAMES, ACCOUNTNAME, ACCOUNTBANKNO, ACCOUNTBANKNAME FROM account WHERE ACCOUNTID = '".$resid."'";
		// $sql = "SELECT IDKATSKPD, NAMEKATSKPD FROM kategori_skpd WHERE NAMEKATSKPD LIKE '%".$_GET['q']."%' LIMIT 50";
		$result = $mysqli->query($sql);

		$json = [];
		while($row = $result->fetch_assoc()){
		    $json[] = ['id'=>$row['ACCOUNTID'], 'text'=>$row['ACCOUNTNAMES'], 'accountname'=>$row['ACCOUNTNAME'], 'accountbankno'=>$row['ACCOUNTBANKNO'], 'accountbankname'=>$row['ACCOUNTBANKNAME'],];
		}
	}
	

	echo json_encode($json);
?>