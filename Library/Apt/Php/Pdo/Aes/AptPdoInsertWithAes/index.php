<?php
	/*
	*@filename AptPdoInsertWithAes/index.php
	*@des --- 
	*@Author Arpit sharma
	*/

	// Not show Any error
	error_reporting(0);
	if(!DomainName){
		// Get server port type (exampale - http:// or https://)
		if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
			$HeaderSecureType = "https://";
		}else{
			$HeaderSecureType = "http://";
		}
		// Create Domain name and save it in const variable
		define("DomainName",  $HeaderSecureType.$_SERVER['HTTP_HOST']);
	}
	
	if($FileAccessCode != 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl' && FileAccessCode != 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl'){
		header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
		exit();
	}
	
	function AptPdoInsertWithAes($Data=array()){
		$AcceptNullValue = False;
		foreach ($Data as $key=>$value){
			${ $key } = $value;
		}
		
		if($InsertData == '' || $DbCon == '' || $TbName == '' || $EPass == '' || ($AcceptNullValue != False && $AcceptNullValue != true)){
			return ["status"=>"Error","msg"=>"Invalid Data format detect [Apt Insert Data With Aes]","code"=>400];
		}
		
		$InsertDataArray = explode("::,::",$InsertData);
		$StmtPreapredData = array();
		$InsertDataOptions = array();
		foreach ($InsertDataArray as $value) {
			
			if(strpos($value, "::::") != false || $AcceptNullValue=true){
			   $TmpInsertDataArray = explode("::::",$value);
			} else{
			   return ["status"=>"Error","msg"=>"Null Insert Value not support without AcceptNullValue enable Code -1 [Apt Insert Data With Aes]","code"=>400]; exit();
			}
			
			if(preg_replace("/[^A-Za-z0-9_]/","",$TmpInsertDataArray[0]) !== ""){
				if(preg_replace("/^[ ]/","",$TmpInsertDataArray[1]) != "" || $AcceptNullValue === true){
					if(strtolower($TmpInsertDataArray[1]) == ''){
						$StmtInsertKey .= $TmpInsertDataArray[0]." is null";
					}else{
						$StmtInsertKey .= ', '.$TmpInsertDataArray[0];
						$StmtInsertVal .= ', AES_ENCRYPT(:'.$TmpInsertDataArray[0].'InsertKey, :EPass)';
						$StmtPreapredData[$TmpInsertDataArray[0].'InsertKey'] = $TmpInsertDataArray[1];
					}
				}else{
					return ["status"=>"Error","msg"=>"Null Insert Value not support without AcceptNullValue enable Code -2 [Apt Insert Data With Aes]","code"=>400]; exit();
				}
			}else{
				return ["status"=>"Error","msg"=>"Invalid Insert Key detect [Apt Insert Data With Aes]","code"=>400]; exit();
			}
		}
		$StmtInsertKey = trim($StmtInsertKey,', ');
		$StmtInsertVal = trim($StmtInsertVal,', ');

		// Check and remove user if account created but Status is pending
		$stmt = $DbCon->prepare("INSERT INTO $TbName ($StmtInsertKey) VALUES ($StmtInsertVal)");

		$stmt->bindValue(":EPass", $EPass, PDO::PARAM_STR);
		foreach ($StmtPreapredData as $key=>$value) {
			$stmt->bindValue(":".$key, $value, PDO::PARAM_STR);
		}

		if($stmt->execute()){
			if($stmt->rowCount() > 0){
				return ["status"=>"Success","msg"=>'Data Insert Successfully [Apt Insert Data With Aes]',"code"=>200];
			}else{
				return ["status"=>"Success","msg"=>'Data Insert Proccess done but data not inserted [Apt Insert Data With Aes]','reason'=>json_encode($stmt->errorinfo()),"code"=>404];
			}
		}else{
			return ["status"=>"Error","msg"=>"Data Not Insert due to technical error [Apt Insert Data With Aes]",'reason'=>json_encode($stmt->errorinfo()),"code"=>400];
		}
	}
?>