<?php 
/*
*@FileName LoginBackend
*@Des ---
*@Author arpit sharma
*/

// Not show any error
error_reporting(0);
// Get server port type (exampale - http:// or https://)
if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) {
	$HeaderSecureType = "https://";
}else{
	$HeaderSecureType = "http://";
}
// Create Domain name and save it in const variable
define("DomainName",  $HeaderSecureType.$_SERVER['HTTP_HOST']);
define("RootPath", "../../../");
define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
require(RootPath."Library/SiteComponents/BackEndControlPage/index.php");
require(RootPath."Library/SiteComponents/FrontAndBackEndControlPage/index.php");

// Get all requested data
if(isset($_POST['AccountType']) && isset($_POST['AccountName']) && isset($_POST['LoginData']) && isset($_POST['Password']) && isset($_POST['Token_CSRF']) && isset($_POST['BrowserClientId1']) && isset($_POST['BrowserClientId2'])){
	
	// Verify data send from same page or not
	if(str_replace('www.','',DomainName) === $HeaderSecureType.HostedDomainName){
		session_start();
		if($_POST['Token_CSRF'] === $_SESSION['Token_CSRF']){
			class Login{
				/*
				*@Method name - ValidateData
				*@Des - ValidateData all input data
				*/
				public static function ValidateData($ValidateDataArray = array()){
					foreach ($ValidateDataArray as $key => $value) {
						if($key != 'AccountType' && $key != 'AccountName' && $key != 'LoginData' && $key != 'Password' && $key != 'Token_CSRF' && $key != 'BrowserClientId1' && $key != 'BrowserClientId2'){
							unset($key);
						}else{
							${$key} = preg_replace('!\s+!', ' ',strip_tags($value));
						}
					}

					if(strlen($BrowserClientId1) < 130 || strlen($BrowserClientId2) < 130){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Oops! we can not recognize client [System][0.1]']); exit();
					}else{

						$ExtBrowserClientId1 = str_replace($_SESSION['RandomPass2'], '', str_replace($_SESSION['RandomPass1'], '', $BrowserClientId1));						
						$ExtBrowserClientId2 = str_replace($_SESSION['RandomPass4'], '', str_replace($_SESSION['RandomPass3'], '', $BrowserClientId2));

						if(strlen($ExtBrowserClientId1) != 128 || strlen($ExtBrowserClientId2) != 128){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Oops! we can not recognize client [System][0.2]']); exit();
						}

						$BrowserClientId1 = hash_hmac("sha512",$ExtBrowserClientId1,'Tm2M@#Wv4rt!U2aO!5h^8rA4e+$wY2_aK!yQ'.$ExtBrowserClientId1);

						$BrowserClientId2 = hash_hmac("sha512",$ExtBrowserClientId2,'TpK_W94aPIy3fC6cuKoMt8_yC*E4x*!7eQ8L$re'.$ExtBrowserClientId2);
					}

					// AccountType Validate in backend
					if($AccountType != 'Main' && $AccountType != 'Partner' && $AccountType != 'Subscriber'){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid Login Type detect [Login]']); exit();

					}

					if($AccountType != 'Subscriber'){

						// AccountName Validate in backend
						if($AccountName != preg_replace("/[^A-Za-z0-9_]/","",$AccountName)){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Inavlid Login for detect [Login]']); exit();

						}else if(strlen($AccountName) < 4 || strlen($AccountName) > 18){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Inavlid Login For detect [Login]']); exit();
						}
					}

					// LoginData Validate in backend
					if(strlen($LoginData) < 1){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid LoginId Or Password [Login]']); exit();
					}

					// Password Validate in backend
					if(strlen($Password) < 8 || strlen($Password) > 40){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid LoginId Or Password [Login]']); exit();

					}

					# LoginData Use as email or password for Subscriber
					if($LoginData == preg_replace("/[^0-9]/","",$LoginData)){
						// MobileNo  Validate in backend
						if($LoginData != preg_replace("/[^0-9]/","",$LoginData)){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Mobile number contains invalid characters [Login]']); exit();

						}else if(strlen($LoginData) != 10){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Mobile number must be 10 digit long [Login]']); exit();
						}
						$LoginData = "Mobile::::$LoginData";
					}else{
						if (!filter_var($LoginData, FILTER_VALIDATE_EMAIL)) {
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Invalid email id detect [Login]']); exit();
						}
						$LoginData = "Email::::$LoginData";
					}

					Login::EncryptData($AccountType,$AccountName,$LoginData,$Password,$BrowserClientId1,$BrowserClientId2);
				}
				private static function EncryptData($AccountType,$AccountName,$LoginData,$Password,$BrowserClientId1,$BrowserClientId2){

					$EPass ='T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';

					// Create Hash Password
					$Password = hash_hmac("sha256",hash_hmac("sha512",$Password,$EPass,true),$EPass,false);

					Login::CkeckLoginAndAuthenticate($AccountType,$AccountName,$LoginData,$Password,$BrowserClientId1,$BrowserClientId2,$EPass);
				}

				private static function CkeckLoginAndAuthenticate($AccountType,$AccountName,$LoginData,$Password,$BrowserClientId1,$BrowserClientId2,$EPass){
					/************************************* File Access Code ***********************************/
					define('DatabaseAccessCode', 'T@6Ug5t_u56t*P_B&B@Kl7U_v8N_xN7b_Z&B@Kl75t_u56@6Ug5t_u56t*P_B&Ap');
					define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
					
					/****************************** Database Connections *******************************/

					// DbCon -> ($PdoTopicsterMain)
					require_once (RootPath."Library/Database/SQL/Pdo/topicster_main.php");

					// DbCon -> ($PdoTopicsterPartner)
					require_once (RootPath."Library/Database/SQL/Pdo/topicster_partner.php");

					// DbCon -> ($PdoTopicsterUserActivity)
					require_once (RootPath."Library/Database/SQL/Pdo/topicster_user_activity.php");


					/******************************  Apt Library *******************************/
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoFetchWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoUpdateWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Script/EncodeAndEncrypt/AptEncodeAndEncryptWithAes.php");
					require_once (RootPath."Library/SiteComponents/IsLogin/index.php");
					
					# Is User Login
					$IsLogin = IsLogin(['PdoTopicsterMain'=>$PdoTopicsterMain,'PdoTopicsterPartner'=>$PdoTopicsterPartner,'EPass'=>$EPass,'CheckType'=>'ClientAndServer','LClientId1'=>$BrowserClientId1,'LClientId2'=>$BrowserClientId2]);
					if($IsLogin['code'] == 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Client Already Login [Already] [Login]','status'=>'Already']); exit();
					}

					Login::DoLogin($AccountType,$AccountName,$LoginData,$Password,$BrowserClientId1,$BrowserClientId2,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity,$EPass);
				}

				private static function DoLogin($AccountType,$AccountName,$LoginData,$Password,$BrowserClientId1,$BrowserClientId2,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity,$EPass){
					date_default_timezone_set('Asia/Kolkata');
					$CurrentTime = time();

					if($AccountType != 'Subscriber'){
						if($AccountType == 'Main'){
							$ValidateAccount = AptPdoFetchWithAes(['Condtion'=> "AccountType::::$AccountType",'FetchData'=>'Status::::UserUrl::::StatusReason', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass]);
						}else{
							$ValidateAccount = AptPdoFetchWithAes(['Condtion'=> "AccountType::::$AccountType::,::AccountName::::$AccountName",'FetchData'=>'Status::::UserUrl::::StatusReason::::UpdateTime', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass]);
						}
						
						if($ValidateAccount['code'] == 200 || $ValidateAccount['code'] == 404){
							if($ValidateAccount['code'] == 404){
								if($AccountType == 'Main'){
									foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>'Invalid LoginId or Password [Login]']); exit();
								}else{
									foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>'Invalid Login For detect [Login]']); exit();
								}
							}else{
								if($ValidateAccount['msg']->Status != 'Active'){
									if($ValidateAccount['msg']->Status == 'Review'){
										foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>'Your account currently under review! Please wait until our team verify your account [Login]','status'=>'warning']); exit();
									}else if($ValidateAccount['msg']->Status == 'Hold'){
										$TmpStatusReason = $ValidateAccount['msg']->StatusReason;
										foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ if($SetVarKey != 'TmpStatusReason'){ unset($$SetVarKey); }} unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>'Your account currently on hold! ('.$TmpStatusReason.') [Login]']); exit();
									}else if($ValidateAccount['msg']->Status == 'Reject'){
										$TmpStatusReason = $ValidateAccount['msg']->StatusReason;
										$TmpUpdateTime = $ValidateAccount['msg']->UpdateTime;
										foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ if($SetVarKey != 'TmpStatusReason' && $SetVarKey != 'TmpUpdateTime'){ unset($$SetVarKey); }} unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>"Your partner request (Rejected) beacuse ($TmpStatusReason), You can resubmit again after ".date('d-M-Y, h:i:s A',($TmpUpdateTime+86400)).' [Login]','status'=>'warning']); exit();
									}else{
										$TmpStatus = $ValidateAccount['msg']->Status;
										foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ if($SetVarKey != 'TmpStatus'){ unset($$SetVarKey); }} unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>'Your account currently current status is '.$TmpStatus.' [Login]']); exit();
									}
								}

								if($AccountType == 'Main'){
									$AccountTbName = 'main_account';
									$AccountDb = $PdoTopicsterMain;
									$LFR = $ValidateAccount['msg']->UserUrl;
								}else{
									$AccountTbName = $ValidateAccount['msg']->UserUrl.'_account';
									$AccountDb = $PdoTopicsterPartner;
									$LFR = $ValidateAccount['msg']->UserUrl;
								}
							}
						}else{
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account data can not fetch due to technical error [1] [Login]']); exit();
						}
					}else{
						$AccountTbName = 'subscriber_account';
						$AccountDb = $PdoTopicsterMain;
						$LFR = 'Subscriber';
					}

					$VerifyLogin = AptPdoFetchWithAes(['Condtion'=> "$LoginData::,::Password::::$Password",'FetchData'=>'Status::::StatusReason::::UserUrl::::LoginData', 'DbCon'=> $AccountDb, 'TbName'=> $AccountTbName, 'EPass'=> $EPass]);
						//AptPrint(['msg'=>$VerifyLogin]); exit();
					
					if($VerifyLogin['code'] == 200 || $VerifyLogin['code'] == 404){
							if($VerifyLogin['code'] == 404){
								foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Invalid LoginId or Password [Login]']); exit();
							}else{
								if($VerifyLogin['msg']->Status != 'Active'){
									if($VerifyLogin['msg']->Status == 'Review'){
										foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>'Your account currently under review! Please wait until our team verify your account [Login]']); exit();
									}else if($VerifyLogin['msg']->Status == 'Hold'){
										$TmpStatusReason = $VerifyLogin['msg']->StatusReason;
										foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ if($SetVarKey != 'TmpStatusReason'){ unset($$SetVarKey); }} unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>'Your account currently on hold! ('.$TmpStatusReason.') [Login]']); exit();
									}else{
										$TmpStatus = $VerifyLogin['msg']->Status;
										foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ if($SetVarKey != 'TmpStatus'){ unset($$SetVarKey); }} unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>'Your account currently current status is '.$TmpStatus.' [Login]']); exit();
									}
								}
								$LgUserUrl = $VerifyLogin['msg']->UserUrl;
							}
					}else{
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Account data can not fetch due to technical error [2] [Login]']); exit();
					}

					$GetLoginData = array_reverse(unserialize($VerifyLogin['msg']->LoginData));
					$NewLoginData = array();
					foreach ($GetLoginData as $value) {
						if($value != ''){ $i++; if($i > 5 || $i > sizeof($GetLoginData)){ break; }else{ array_push($NewLoginData, $value); } }
					}

					function rand_string($length){
						$RandStr = "";
						$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
						$size = strlen( $chars ); 
						for( $i = 0; $i < $length; $i++ ) {  
						$RandStr = $RandStr . "" . $chars[ rand( 0, $size - 1 ) ];   
						} 
						return $RandStr;
					}

					$LUID = 'LUID:'.rand_string(15).$CurrentTime.rand_string(15);

					$EncryptLUID = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>'encrypt' ,'data'=>$LUID, 'key'=>$EPass]);
					if($EncryptLUID['code'] == 200){ $EncryptLUID = $EncryptLUID['msg']; }else{ foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); AptPrint(['msg'=>'Login can not process due to an technical error [E] [Login]','status'=>'Error','code'=>400]); }

					$EncryptLAS = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>'encrypt' ,'data'=>$AccountType, 'key'=>$EPass]);
					if($EncryptLAS['code'] == 200){ $EncryptLAS = $EncryptLAS['msg']; }else{ foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); AptPrint(['msg'=>'Login can not process due to an technical error [E] [Login]','status'=>'Error','code'=>400]); }

					$EncryptLURL = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>'encrypt' ,'data'=>$LgUserUrl, 'key'=>$EPass]);
					if($EncryptLURL['code'] == 200){ $EncryptLURL = $EncryptLURL['msg']; }else{ foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); AptPrint(['msg'=>'Login can not process due to an technical error [E] [Login]','status'=>'Error','code'=>400]); }

					$EncryptLFR = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>'encrypt' ,'data'=>$LFR, 'key'=>$EPass]);
					if($EncryptLFR['code'] == 200){ $EncryptLFR = $EncryptLFR['msg']; }else{ foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); AptPrint(['msg'=>'Login can not process due to an technical error [E] [Login]','status'=>'Error','code'=>400]); }

					$EncryptLSignature = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>'encrypt' ,'data'=> hash_hmac("sha256",hash_hmac("sha512",$LUID.'|'.$AccountType.'|'.$LgUserUrl.'|'.$LFR,$EPass,true),$EPass,false), 'key'=>$EPass]);
					
					if($EncryptLSignature['code'] == 200){ $EncryptLSignature = $EncryptLSignature['msg']; }else{ foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); AptPrint(['msg'=>'Login can not process due to an technical error [E] [Login]','status'=>'Error','code'=>400]); }

					array_push($NewLoginData, ['LUID'=>$LUID,'Time'=>$CurrentTime,'ExpTime'=>-1,'LClientId1'=>$BrowserClientId1,'LClientId2'=>$BrowserClientId2]);
					$NewLoginData = serialize($NewLoginData);
					
					$UpdateLoginData = AptPdoUpdateWithAes(['Update'=>"LoginData::::$NewLoginData::,::LoginTime::::$CurrentTime::,::ActiveTime::::$CurrentTime",'Condtion'=>"UserUrl::::$LgUserUrl",'DbCon'=>$AccountDb,'TbName'=>$AccountTbName,'EPass'=>$EPass]);
					if($UpdateLoginData['code'] == 200){
						setcookie( 'LUID', $EncryptLUID, $CurrentTime+(86000*30*12), '/', false, false, true);
						setcookie( 'LAS', $EncryptLAS, $CurrentTime+(86000*30*12), '/', false, false, true);
						setcookie( 'LURL', $EncryptLURL, $CurrentTime+(86000*30*12), '/', false, false, true);
						setcookie( 'LFR', $EncryptLFR, $CurrentTime+(86000*30*12), '/', false, false, true);
						setcookie( 'LSignature', $EncryptLSignature, $CurrentTime+(86000*30*12), '/', false, false, true);
						setcookie( 'LT', base64_encode($AccountType), $CurrentTime+(86000*30*12), '/');
						setcookie( 'LANM', base64_encode($AccountName), $CurrentTime+(86000*30*12), '/');
						setcookie( 'LID', base64_encode(explode('::::', $LoginData)[1]), $CurrentTime+(86000*30*12), '/');
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Client Login successfully [Login]','status'=>'Success','code'=>200]);
					}else{
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Login can not process due to an technical error [Login]','status'=>'Error','code'=>400]);
					}
				}
			}
			
			Login::ValidateData($_POST);
		}else{
			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
			AptPrint(['msg'=>'Invalid Token! Please refresh page to regenerate Token [Login]']);
		}
	}else{
		AptPrint(['msg'=>'Authentication failed [Login]']);
		header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
	}
}else{
	AptPrint(['msg'=>'Invalid data sent [Login]']);
	header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
}	
?>