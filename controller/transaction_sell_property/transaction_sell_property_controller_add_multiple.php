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

	$data = $_REQUEST['data'];

	if(is_array($data)){
		$sql = "INSERT INTO transaction (
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
		SELLID,
		PROJECTID,
		PROJECTNAME,
		ACCOUNTID,
		ACCOUNTNAME,
		ACCOUNTBANKNO,
		ACCOUNTBANKNAME,

		CLUSTERID,
		KAVBLOK,
		KAVNO,
		TYPELB,
		TYPELT,
		EXCESSLAND,
		CUSTOMERID,
		FULLNAME,
		KTP,

		DATE,
		CREATED,
		DESCRIPTION ) values ";

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

		//proses input multiple
		$valuesArr = array();
	    foreach($data as $row){
	        $idTransaction = mysqli_real_escape_string( $mysqli, $resid );
	        $mainCategoryId = mysqli_real_escape_string( $mysqli, $row['maincategoryid'] );
	        $mainCategoryName = mysqli_real_escape_string( $mysqli, $row['maincategoryname'] );
	        $color = mysqli_real_escape_string( $mysqli, $row['maincategorycolor'] );
	        $groups = mysqli_real_escape_string( $mysqli, $row['maincategorygroups'] );
	        $categoryId = mysqli_real_escape_string( $mysqli, $row['categoryid'] );
	        $categoryName = mysqli_real_escape_string( $mysqli, $row['categoryname'] );
	        $transactionTitle = mysqli_real_escape_string( $mysqli, $row['title'] );
	        $quantity = 0;
	        $amount = mysqli_real_escape_string( $mysqli, $row['amount'] );
	        $type = mysqli_real_escape_string( $mysqli, $row['type'] );
	        $cheque = mysqli_real_escape_string( $mysqli, $row['cheque'] );
	        $sellid = mysqli_real_escape_string( $mysqli, $se_resid );
	        $projectid = mysqli_real_escape_string( $mysqli, $row['projectid'] );
	        $projectname = mysqli_real_escape_string( $mysqli, $row['projectname'] );
	        $accountId = mysqli_real_escape_string( $mysqli, $row['accountid'] );
	        $accountName = mysqli_real_escape_string( $mysqli, $row['accountname'] );
	        $accountBankNo = mysqli_real_escape_string( $mysqli, $row['accountbankno'] );
	        $accountBankName = mysqli_real_escape_string( $mysqli, $row['accountbankname'] );

	        $clusterId = mysqli_real_escape_string( $mysqli, $row['clusterid'] );
	        $kavBlok = mysqli_real_escape_string( $mysqli, $row['kavblok'] );
	        $kavNo = mysqli_real_escape_string( $mysqli, $row['kavno'] ); 
	        $typeLB = mysqli_real_escape_string( $mysqli, $row['typelb'] );
	        $typeLT = mysqli_real_escape_string( $mysqli, $row['typelt'] ); 
	        $excessLand = mysqli_real_escape_string( $mysqli, $row['excessland'] ); 
	        $customerId = mysqli_real_escape_string( $mysqli, $row['customerid'] );
	        $fullName = mysqli_real_escape_string( $mysqli, $row['fullname'] );
	        $ktp = mysqli_real_escape_string( $mysqli, $row['ktp'] );

	        $dateCreate = mysqli_real_escape_string( $mysqli, $row['date'] );
	        $created = mysqli_real_escape_string( $mysqli, $row['created'] );
	        $description = mysqli_real_escape_string( $mysqli, $row['description'] );

	        $valuesArr[] = "('$idTransaction','$mainCategoryId','$mainCategoryName','$color','$groups','$categoryId','$categoryName','$transactionTitle','$quantity','$amount','$type','$cheque','$sellid','$projectid','$projectname','$accountId','$accountName','$accountBankNo','$accountBankName','$clusterId','$kavBlok','$kavNo','$typeLB','$typeLT','$excessLand','$customerId','$fullName','$ktp','$dateCreate','$created','$description')";
	        $resid++;
	    }
	    $sql .= implode(',', $valuesArr);
	    // mysql_query($sql) or exit(mysql_error()); 
	    $mysqli->query($sql);
	    // $result = $mysqli->query($sql);
	    // echo json_encode($result);
		$sqll = "SELECT * FROM transaction Order by DATECREATE desc LIMIT 1"; 
		$resultt = $mysqli->query($sqll);
		$printdata = [];
		while($rowz = $resultt->fetch_assoc()){
			$printdata[] = [
				'TransactionID'=>$rowz['TRANSACTIONID'], 
				'Title'=>$rowz['TRANSACTIONTITLE'], 
				'Amount'=>$rowz['AMOUNT']
			];
		}
		// $data = $result->fetch_assoc();
		echo json_encode($printdata);
	}
?>