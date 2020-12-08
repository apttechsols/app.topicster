<?php 
/*
*@FileName Logout/index.php
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
if(isset($_POST['Token_CSRF']) && isset($_POST['BrowserClientId1']) && isset($_POST['BrowserClientId2'])){
	
	// Verify data send from same page or not
	if(str_replace('www.','',DomainName) === $HeaderSecureType.HostedDomainName){
		if(strpos($_SERVER['HTTP_REFERER'], DomainName.'/Dashboard/') !== false){
			$GLOBALS['NeedRefresh'] = true;
		}else{
			$GLOBALS['NeedRefresh'] = false;
		}
		session_start();
		if($_POST['Token_CSRF'] === $_SESSION['Token_CSRF']){

			function LogoutDoLogOut(){
				setcookie( 'LUID', NULL, time()-1, '/', false, false, true);
				setcookie( 'LAS', NULL, time()-1, '/', false, false, true);
				setcookie( 'LURL', NULL, time()-1, '/', false, false, true);
				setcookie( 'LFR', NULL, time()-1, '/', false, false, true);
				setcookie( 'LSignature', NULL, time()-1, '/', false, false, true);
			}

			class Logout{
				/*
				*@Method name - ValidateData
				*@Des - ValidateData all input data
				*/
				public static function ValidateData($ValidateDataArray = array()){

					foreach ($ValidateDataArray as $key => $value) {
						if($key != 'BrowserClientId1' && $key != 'BrowserClientId2'){
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

					Logout::EncryptData($BrowserClientId1,$BrowserClientId2);
				}
				private static function EncryptData($BrowserClientId1,$BrowserClientId2){

					$EPass ='T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';

					Logout::CkeckLoginAndAuthenticate($BrowserClientId1,$BrowserClientId2,$EPass);
				}

				private static function CkeckLoginAndAuthenticate($BrowserClientId1,$BrowserClientId2,$EPass){

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
					require_once (RootPath."Library/SiteComponents/IsLogin/index.php");
					
					# Is User Login
					$IsLogin = IsLogin(['PdoTopicsterMain'=>$PdoTopicsterMain,'PdoTopicsterPartner'=>$PdoTopicsterPartner,'EPass'=>$EPass,'CheckType'=>'ClientAndServer','LClientId1'=>$BrowserClientId1,'LClientId2'=>$BrowserClientId2]);
					if($IsLogin['code'] == 200){
						date_default_timezone_set('Asia/Kolkata');
						$CurrentTime = time();
						$FetchDtls = 'LoginData::::PassUpdateTime::::UserUrl::::Profile';
						
						if(!function_exists('AptPdoFetchWithAes') || !function_exists('AptPdoUpdateWithAes') || !method_exists('AptEncodeAndEncryptWithAes', 'AptEncodeAndEncryptWithAesRun')){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Required function not found [Logout]']);
						}

						$LUID = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>"decrypt" ,'data'=>$_COOKIE['LUID'], 'key'=>$EPass]);
						
						if($LUID['code'] === 200){
							$LUID = $LUID['msg'];
						}else{
							LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Client logout successfully [E] [Logout]','status'=>'info','code'=>404]);
						}

						$LAS = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>"decrypt" ,'data'=>$_COOKIE['LAS'], 'key'=>$EPass]);
						if($LAS['code'] === 200){
							$LAS = $LAS['msg'];
						}else{
							LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Client logout successfully [E] [Logout]','status'=>'info','code'=>404]);
						}

						$LURL = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>"decrypt" ,'data'=>$_COOKIE['LURL'], 'key'=>$EPass]);
						if($LURL['code'] === 200){
							$LURL = $LURL['msg'];
						}else{
							LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Client logout successfully [E] [Logout]','status'=>'info','code'=>404]);
						}

						$LFR = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>"decrypt" ,'data'=>$_COOKIE['LFR'], 'key'=>$EPass]);
						if($LFR['code'] === 200){
							$LFR = $LFR['msg'];
						}else{
							LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Client logout successfully [E] [Logout]','status'=>'info','code'=>404]);
						}

						$LSignature = AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>"decrypt" ,'data'=>$_COOKIE['LSignature'], 'key'=>$EPass]);
						if($LSignature['code'] === 200){
							$LSignature = $LSignature['msg'];
						}else{
							LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Client logout successfully [E] [Logout]','status'=>'info','code'=>404]);
						}

						if(hash_hmac("sha256",hash_hmac("sha512",$LUID.'|'.$LAS.'|'.$LURL.'|'.$LFR,$EPass,true),$EPass,false) != $LSignature){
							LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Client logout successfully [E] [Logout]','status'=>'info','code'=>404]);
						}
						
						if(strlen($LUID) > 0 &&  strlen($LAS) > 0 &&  strlen($LURL) > 0 && strlen($LFR) > 0){
							if($LAS === 'Main' || $LAS === 'Partner' || $LAS === 'Subscriber'){
								if($LAS === 'Main'){
									$AccountDbCon = $PdoTopicsterMain;
									$AccountTbName = 'main_account';
									$GetMainAccountDtls = AptPdoFetchWithAes(['Condtion'=> "AccountType::::Main::,::UserUrl::::$LFR::,::Status::::Active::,::AccountAs::::Main::,::IsVerifyed::::true", 'FetchData'=>'AccountName', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass]);
									if($GetMainAccountDtls['code'] != 200){
										LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>'Client logout successfully [MA] [Logout]','status'=>'info','code'=>404]);
									}
									$MainAccountName = $GetMainAccountDtls['msg']->AccountName;
									$MainAccountAccountAs = 'Main';
									$MainAccounIsVerifyed = true;
									$GetLgAccountDtls = AptPdoFetchWithAes(['Condtion'=> "Status::::Active::,::UserUrl::::$LURL", 'FetchData'=>$FetchDtls, 'DbCon'=> $AccountDbCon, 'TbName'=> $AccountTbName, 'EPass'=> $EPass]);
								}else if($LAS === 'Partner'){
									$AccountDbCon = $PdoTopicsterPartner;
									$AccountTbName = $LFR.'_account';
									$GetMainAccountDtls = AptPdoFetchWithAes(['Condtion'=> "AccountType::::Partner::,::UserUrl::::$LFR::,::Status::::Active", 'FetchData'=>'AccountName::::AccountAs::::IsVerifyed', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass]);
									
									if($GetMainAccountDtls['code'] != 200){
										LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>'Client logout successfully [MA] [Logout]','status'=>'info','code'=>404]);
									}
									$MainAccountName = $GetMainAccountDtls['msg']->AccountName;
									$MainAccountAccountAs = $GetMainAccountDtls['msg']->AccountAs;
									$MainAccounIsVerifyed = $GetMainAccountDtls['msg']->IsVerifyed;
									$GetLgAccountDtls = AptPdoFetchWithAes(['Condtion'=> "Status::::Active::,::UserUrl::::$LURL::,::LoginData::::LUID::::LikeValLike", 'FetchData'=>$FetchDtls, 'DbCon'=> $AccountDbCon, 'TbName'=> $AccountTbName, 'EPass'=> $EPass]);
								}else{
									$AccountDbCon = $PdoTopicsterMain;
									$AccountTbName = 'subscriber_account';
									$MainAccountName = 'Subscriber';
									$MainAccountAccountAs = 'Subscriber';
									$MainAccounIsVerifyed = false;
									if(stripos(preg_replace("/[^A-Za-z]/","",strtolower($FetchDtls)),"::::position") !== false){
										$FetchDtls = str_replace('::::position', '', $FetchDtls);
									}
									if(stripos(preg_replace("/[^A-Za-z]/","",strtolower($FetchDtls)),"position::::") !== false){
										$FetchDtls = str_replace('position::::', '', $FetchDtls);
									}
									if(stripos(preg_replace("/[^A-Za-z]/","",strtolower($FetchDtls)),"position") !== false){
										$FetchDtls = str_replace('position', '', $FetchDtls);
									}
									$GetLgAccountDtls = AptPdoFetchWithAes(['Condtion'=> "Status::::Active::,::UserUrl::::$LURL::,::LoginData::::LUID::::LikeValLike", 'FetchData'=>$FetchDtls, 'DbCon'=> $AccountDbCon, 'TbName'=> $AccountTbName, 'EPass'=> $EPass]);
								}
								
								if($GetLgAccountDtls['code'] != 200){
									LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>['msg'=>'Client logout successfully [LA] [Logout]','NeedRefresh'=>$GLOBALS['NeedRefresh']],'status'=>'info','code'=>404]);
								}

								$GetLoginData = unserialize($GetLgAccountDtls['msg']->LoginData);
								$NewLoginData = array();
								$PassUpdateTime = $GetLgAccountDtls['msg']->PassUpdateTime;
								foreach ($GetLoginData as $value) {
									if($value['LUID'] != $LUID && $value['LClientId1'] != $BrowserClientId1 && $value['LClientId2'] != $BrowserClientId2){
										array_push($NewLoginData, $value);
									}
								}

								if(sizeof($NewLoginData) != sizeof($GetLoginData)){
									$NewLoginData = serialize($NewLoginData);
									$UpdateLoginData = AptPdoUpdateWithAes(['Update'=>"LoginData::::$NewLoginData::,::ActiveTime::::$CurrentTime",'Condtion'=>"UserUrl::::$LURL",'DbCon'=>$AccountDbCon,'TbName'=>$AccountTbName,'EPass'=>$EPass]);
									if($UpdateLoginData['code'] == 200){
										LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>['msg'=>'Client logout successfully [Logout]','NeedRefresh'=>$GLOBALS['NeedRefresh']],'status'=>'Success','code'=>200]);
									}else{
										LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
										AptPrint(['msg'=>['msg'=>'Client logout successfully [ULD] [Logout]','NeedRefresh'=>$GLOBALS['NeedRefresh']],'status'=>'info','code'=>404]);
									}
								}

								if(($BrowserClientId1 == '' || $BrowserClientId2 == '') && $CheckType != 'Server'){
									LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
									AptPrint(['msg'=>['msg'=>'Client logout successfully [CID] [Logout]','NeedRefresh'=>$GLOBALS['NeedRefresh']],'status'=>'info','code'=>404]);
								}
								LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>['msg'=>'Client logout successfully [UA] [Logout]','NeedRefresh'=>$GLOBALS['NeedRefresh']],'status'=>'info','code'=>404]);
							}else{
								LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>['msg'=>'Client logout successfully [LAS] [Logout]','NeedRefresh'=>$GLOBALS['NeedRefresh']],'status'=>'info','code'=>404]);
							}
						}else{
							LogoutDoLogOut(); foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>['msg'=>'Client logout successfully [E] [Logout]','NeedRefresh'=>$GLOBALS['NeedRefresh']],'status'=>'info','code'=>404]);
						}
					}else if($IsLogin['code'] == 404){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						LogoutDoLogOut();  AptPrint(['msg'=>['msg'=>'Client logout successfully [Already] [Logout]','NeedRefresh'=>$GLOBALS['NeedRefresh']],'status'=>'info','code'=>404]); exit();
					}else{
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						LogoutDoLogOut(); AptPrint(['msg'=>['msg'=>'Client logout successfully [LDT] [Logout]','NeedRefresh'=>$GLOBALS['NeedRefresh']],'status'=>'info','code'=>404]); exit();
					}
				}
			}
			
			// Call classname public function 
			Logout::ValidateData($_POST);
		}else{
			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
			AptPrint(['msg'=>'Invalid Token! Please refresh page to regenerate Token [Logout]']);
		}
	}else{
		AptPrint(['msg'=>'Authentication failed [Logout]']);
		header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
	}
}else{
	AptPrint(['msg'=>'Invalid data sent [Logout]']);
	header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
}	
?>