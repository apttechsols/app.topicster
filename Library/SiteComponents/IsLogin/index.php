<?php
	error_reporting(0);
	if($FileAccessCode != 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl' && FileAccessCode != 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl'){
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
		header("Location: " . DomainName . "Library/SiteComponents/PageNotFound/index.php"); die();
		exit();
	}

	if(!defined('DatabaseAccessCode')){
		define('DatabaseAccessCode', 'T@6Ug5t_u56t*P_B&B@Kl7U_v8N_xN7b_Z&B@Kl75t_u56@6Ug5t_u56t*P_B&Ap');
	}
	if(!defined('DatabaseAccessCode')){
		define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	}
	if(!isset($EPass)){
		$EPass = 'T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';
	}

	/****************************** Database Connections *******************************/

	// DbCon -> ($PdoTopicsterMain)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_main.php");

	// DbCon -> ($PdoTopicsterPartner)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_partner.php");

	/******************************  Apt Library *******************************/
	require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoFetchWithAes/index.php");
	require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoUpdateWithAes/index.php");
	require_once (RootPath."Library/Apt/Php/Script/EncodeAndEncrypt/AptEncodeAndEncryptWithAes.php");
	
	function IsLoginDoLogOut(){
		setcookie( 'LUID', NULL, time()-1, '/', false, false, true);
		setcookie( 'LAS', NULL, time()-1, '/', false, false, true);
		setcookie( 'LURL', NULL, time()-1, '/', false, false, true);
		setcookie( 'LFR', NULL, time()-1, '/', false, false, true);
		setcookie( 'LSignature', NULL, time()-1, '/', false, false, true);
	}

	function IsLogin($IsLoginData = array()){
		$CheckType='Server';
		foreach ($IsLoginData as $IsLoginDatakey => $IsLoginDatavalue){ ${$IsLoginDatakey} = $IsLoginDatavalue; }
		date_default_timezone_set('Asia/Kolkata');
		$ExtCurrentTime = time();
		$CheckType = strtolower($CheckType);
		if($FetchDtls != ''){
			$FetchDtls .= '::::FullName::::UserUrl::::Position::::Profile::::LoginData::::PassUpdateTime';
		}else{
			$FetchDtls .= 'FullName::::UserUrl::::Position::::Profile::::LoginData::::PassUpdateTime';
		}
		if($PdoTopicsterMain == '' || $PdoTopicsterPartner == '' || $FetchDtls == '' || ($CheckType != 'server' && $CheckType != 'client' && $CheckType != 'serverandclient' && $CheckType != 'clientandserver') || $EPass == ''){
			return ["status"=>"Error","msg"=>"Invalid Data format detect [IsLogin]",json_encode($CheckType),"code"=>400];
		}
		
		if(!function_exists('AptPdoFetchWithAes') || !function_exists('AptPdoUpdateWithAes') || !method_exists('AptEncodeAndEncryptWithAes', 'AptEncodeAndEncryptWithAesRun')){
			return ["status"=>"Error","msg"=>"Required function not found [IsLogin]","code"=>400];
		}

		$LUID = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>"decrypt" ,'data'=>$_COOKIE['LUID'], 'key'=>$EPass]);
		
		if($LUID['code'] === 200){
			$LUID = $LUID['msg'];
		}else{
			IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined [E] [IsLogin]',"code"=>404];
		}

		$LAS = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>"decrypt" ,'data'=>$_COOKIE['LAS'], 'key'=>$EPass]);
		if($LAS['code'] === 200){
			$LAS = $LAS['msg'];
		}else{
			IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined [E] [IsLogin]',"code"=>404];
		}

		$LURL = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>"decrypt" ,'data'=>$_COOKIE['LURL'], 'key'=>$EPass]);
		if($LURL['code'] === 200){
			$LURL = $LURL['msg'];
		}else{
			IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined [E] [IsLogin]',"code"=>404];
		}

		$LFR = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>"decrypt" ,'data'=>$_COOKIE['LFR'], 'key'=>$EPass]);
		if($LFR['code'] === 200){
			$LFR = $LFR['msg'];
		}else{
			IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined [E] [IsLogin]',"code"=>404];
		}

		$LSignature = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>"decrypt" ,'data'=>$_COOKIE['LSignature'], 'key'=>$EPass]);
		if($LSignature['code'] === 200){
			$LSignature = $LSignature['msg'];
		}else{
			IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined [E] [IsLogin]',"code"=>404];
		}

		if(hash_hmac("sha256",hash_hmac("sha512",$LUID.'|'.$LAS.'|'.$LURL.'|'.$LFR,$EPass,true),$EPass,false) != $LSignature){
			IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined [SV] [IsLogin]',"code"=>404];
		}
		
		if(strlen($LUID) > 0 &&  strlen($LAS) > 0 &&  strlen($LURL) > 0 && strlen($LFR) > 0){
			if($LAS === 'Main' || $LAS === 'Partner' || $LAS === 'Subscriber'){
				if($LAS === 'Main'){
					$AccountDbCon = $PdoTopicsterMain;
					$AccountTbName = 'main_account';
					$GetMainAccountDtls = AptPdoFetchWithAes(['Condtion'=> "AccountType::::Main::,::UserUrl::::$LFR::,::Status::::Active::,::AccountAs::::Main::,::IsVerifyed::::true", 'FetchData'=>'AccountName', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass]);
					if($GetMainAccountDtls['code'] != 200){
						IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined  [MA] [IsLogin]',"code"=>404];
					}
					$MainAccountName = $GetMainAccountDtls['msg']->AccountName;
					$MainAccounIsVerifyed = true;
					$GetLgAccountDtls = AptPdoFetchWithAes(['Condtion'=> "Status::::Active::,::UserUrl::::$LURL::,::LoginData::::LUID::::LikeValLike", 'FetchData'=>$FetchDtls, 'DbCon'=> $AccountDbCon, 'TbName'=> $AccountTbName, 'EPass'=> $EPass]);
				}else if($LAS === 'Partner'){
					$AccountDbCon = $PdoTopicsterPartner;
					$AccountTbName = $LFR.'_account';
					$GetMainAccountDtls = AptPdoFetchWithAes(['Condtion'=> "AccountType::::Partner::,::UserUrl::::$LFR::,::Status::::Active", 'FetchData'=>'AccountName::::AccountAs::::IsVerifyed', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass]);
					
					if($GetMainAccountDtls['code'] != 200){
						IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined  [MA] [IsLogin]',"code"=>404];
					}
					$MainAccountName = $GetMainAccountDtls['msg']->AccountName;
					$MainAccounIsVerifyed = $GetMainAccountDtls['msg']->IsVerifyed;
					$GetLgAccountDtls = AptPdoFetchWithAes(['Condtion'=> "Status::::Active::,::UserUrl::::$LURL::,::LoginData::::LUID::::LikeValLike", 'FetchData'=>$FetchDtls, 'DbCon'=> $AccountDbCon, 'TbName'=> $AccountTbName, 'EPass'=> $EPass]);
				}else{
					$AccountDbCon = $PdoTopicsterMain;
					$AccountTbName = 'subscriber_account';
					$MainAccountName = 'Subscriber';
					$MainAccounIsVerifyed = false;
					$FetchDtls = str_replace('::::Position', '', $FetchDtls);
					$FetchDtls = str_replace('Position::::', '', $FetchDtls);
					$FetchDtls = str_replace('Position', '', $FetchDtls);
					$GetLgAccountDtls = AptPdoFetchWithAes(['Condtion'=> "Status::::Active::,::UserUrl::::$LURL::,::LoginData::::LUID::::LikeValLike", 'FetchData'=>$FetchDtls, 'DbCon'=> $AccountDbCon, 'TbName'=> $AccountTbName, 'EPass'=> $EPass]);
				}
				
				if($GetLgAccountDtls['code'] != 200){
					IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined  [LA] [IsLogin]',"code"=>404];
				}

				$IsLogined = false;
				$GetLoginData = unserialize($GetLgAccountDtls['msg']->LoginData);
				$PassUpdateTime = $GetLgAccountDtls['msg']->PassUpdateTime;
				foreach ($GetLoginData as $value) {
					if($value['LUID'] == $LUID){
						if($CheckType == 'server'){
							if(($value['ExpTime'] == -1 || $value['ExpTime'] > $ExtCurrentTime)){
								$IsLogined = true;
							}
						}else if($CheckType == 'client'){
							if($LClientId1 != '' && $LClientId2 != '' && ($value['ExpTime'] == -1 || $value['ExpTime'] > $ExtCurrentTime) && $value['LClientId1'] == $LClientId1 && $value['LClientId2'] == $LClientId2){
								$IsLogined = true;
							}
						}else{
							if($LClientId1 != '' && $LClientId2 != '' && ($value['ExpTime'] == -1 || $value['ExpTime'] > $ExtCurrentTime) && $value['LClientId1'] == $LClientId1 && $value['LClientId2'] == $LClientId2){
								$IsLogined = true;
							}
						}

					}
				}

				if($IsLogined === true){
					$UpdateLoginData = AptPdoUpdateWithAes(['Update'=>"ActiveTime::::$ExtCurrentTime",'Condtion'=>"UserUrl::::$LURL",'DbCon'=>$AccountDbCon,'TbName'=>$AccountTbName,'EPass'=>$EPass]);
					if($UpdateLoginData['code'] != 200 && $UpdateLoginData['code'] != 404){
						IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined [UAT] [IsLogin]',"code"=>404];
					}
					if(stripos(preg_replace("/[^A-Za-z]/","",strtolower($FetchDtls)),"::::LoginData") !== false){
						$FetchDtls = str_replace('::::LoginData', '', $FetchDtls);
					}
					if(stripos(preg_replace("/[^A-Za-z]/","",strtolower($FetchDtls)),"LoginData::::") !== false){
						$FetchDtls = str_replace('LoginData::::', '', $FetchDtls);
					}
					if(stripos(preg_replace("/[^A-Za-z]/","",strtolower($FetchDtls)),"LoginData") !== false){
						$FetchDtls = str_replace('LoginData', '', $FetchDtls);
					}
					$FetchDtlsArray = explode('::::', $FetchDtls);
					$FetchDtls=array();
					foreach ($FetchDtlsArray as $key){
						$FetchDtls[$key] = $GetLgAccountDtls['msg']->$key;
					}
					return ['status'=>'Success','msg'=>$FetchDtls,'LAS'=>$LAS,'LURL'=>$LURL,'LFR'=>$LFR,'LMAN'=>$MainAccountName,'LMAIV'=>$MainAccounIsVerifyed,"code"=>200];
				}

				if(($LClientId1 == '' || $LClientId2 == '') && $CheckType != 'Server'){
					IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined [CID] [IsLogin]',"code"=>404];
				}
				IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined  [UA] [IsLogin]',"code"=>404];
			}else{
				IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined [LAS] [IsLogin]',"code"=>404];
			}
		}else{
			IsLoginDoLogOut(); return ['status'=>'Error','msg'=>'Oops! Client currently not logined [E] [IsLogin]',"code"=>404];
		}
	}
?>