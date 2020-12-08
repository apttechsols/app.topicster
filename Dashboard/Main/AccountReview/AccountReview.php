<?php 
/*
*@FileName AccountReviewBackend
*@Des Upload data to server for create user
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
if(isset($_POST['AccountUserUsrl']) && isset($_POST['Decision']) && isset($_POST['Reason']) && isset($_POST['SecurityCode']) && isset($_POST['Token_CSRF']) && isset($_POST['BrowserClientId1']) && isset($_POST['BrowserClientId2'])){
	
	// Verify data send from same page or not
	if($_SERVER['HTTP_REFERER'] === DomainName.'/Dashboard/Main/AccountReview/index.php'){
		session_start();
		if($_POST['Token_CSRF'] === $_SESSION['Token_CSRF']){

			class AccountReview{
				/*
				*@Method name - ValidateData
				*@Des - ValidateData all input data
				*/
				public static function ValidateData($ValidateDataArray = array()){

					foreach ($ValidateDataArray as $key => $value) {
						if($key != 'AccountUserUsrl' && $key != 'Decision' && $key != 'Reason' && $key != 'SecurityCode' && $key != 'BrowserClientId1' && $key != 'BrowserClientId2'){
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
					
					if($AccountUserUsrl != preg_replace("/[^A-Za-z0-9_]/", '', $AccountUserUsrl)){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>"Invalid Account details detect [AccountReview]"]); exit();
					}else if(strlen($AccountUserUsrl) != 43){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>"Invalid Account details detect [AccountReview]"]); exit();
					}

					// Decision Validate in backend
					if($Decision != 'Approve' && $Decision != 'Reject'){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid Decision detect [AccountReview]']); exit();

					}

					if($Decision == 'Reject'){
						if($Reason == ''){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Reason must required for reject request [AccountReview]']); exit();
						}else if($Reason != preg_replace("/[^A-Za-z0-9- _.|,'@&]/","",$Reason)){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>"Reason contain invalid characters [a-z0-9- _.|,'@&] [AccountReview]"]); exit();
						}else if(strlen($Reason) < 20 || strlen($Reason) > 150){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>"Reason must be between 20 to 150 characters [AccountReview]"]); exit();
						}

					}

					if($SecurityCode != preg_replace("/[^0-9]/", '', $SecurityCode)){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>"Invalid Security Code detect [AccountReview]"]); exit();
					}
					
					AccountReview::EncryptData($AccountUserUsrl,$Decision,$Reason,$SecurityCode,$BrowserClientId1,$BrowserClientId2);
				}
				private static function EncryptData($AccountUserUsrl,$Decision,$Reason,$SecurityCode,$BrowserClientId1,$BrowserClientId2){

					$EPass ='T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';

					// Create Hash Password
					$SecurityCode =  hash_hmac("sha256",hash_hmac("sha512",$SecurityCode,$EPass,true),$EPass,false);

					AccountReview::CkeckLoginAndAuthenticate($AccountUserUsrl,$Decision,$Reason,$SecurityCode,$BrowserClientId1,$BrowserClientId2,$EPass);
				}

				private static function CkeckLoginAndAuthenticate($AccountUserUsrl,$Decision,$Reason,$SecurityCode,$BrowserClientId1,$BrowserClientId2,$EPass){
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
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoDeleteWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoInsertWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Script/AptPhpScriptDirDelete/index.php");
					require_once (RootPath."Library/Apt/Php/Script/AptPhpScriptDeleteTable/index.php");
					require_once (RootPath."Library/SiteComponents/IsLogin/index.php");
					
					# Is User Login
					$IsLogin = IsLogin(['PdoTopicsterMain'=>$PdoTopicsterMain,'PdoTopicsterPartner'=>$PdoTopicsterPartner,'EPass'=>$EPass,'CheckType'=>'ClientAndServer','LClientId1'=>$BrowserClientId1,'LClientId2'=>$BrowserClientId2,'FetchDtls'=>'SecurityCode']);
					
					if($IsLogin['code'] != 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Client not Logined [Authentication failed] [Login]','status'=>'warning']); exit();
					}

					if($IsLogin['msg']['SecurityCode'] != $SecurityCode){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid Security Code detect [Authentication failed] [Security Code]','status'=>'warning']); exit();
					}
					
					AccountReview::DoAccountReview($AccountUserUsrl,$Decision,$Reason,$SecurityCode,$BrowserClientId1,$BrowserClientId2,$EPass,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity);
				}

				private static function DoAccountReview($AccountUserUsrl,$Decision,$Reason,$SecurityCode,$BrowserClientId1,$BrowserClientId2,$EPass,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity){
					date_default_timezone_set('Asia/Kolkata');
					$CurrentTime = time();

					$AccountDtls = AptPdoFetchWithAes(['Condtion'=> "UserUrl::::$AccountUserUsrl", 'FetchData'=>'Status::::AccountName','DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass]);
					if($AccountDtls['code'] != 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>"Invalid Account details detect [AccountReview]"]); exit();
					}else if($AccountDtls['msg']->Status != 'Review'){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>"Account not under in Review [AccountReview]",'code'=>404]); exit();
					}

					
					if($Decision == 'Approve'){
						$UpdateAccountStatus = AptPdoUpdateWithAes(['Update'=>"Status::::Active::,::UpdateTime::::$CurrentTime",'Condtion'=>"UserUrl::::$AccountUserUsrl",'DbCon'=>$PdoTopicsterMain,'TbName'=>'account','EPass'=>$EPass]);
						if($UpdateAccountStatus['code'] == 200){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account Partner request Approve successfully [AccountReview]','status'=>'Success','code'=>200]);
						}else if($UpdateAccountStatus['code'] == 404){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account Partner request already Approved [AccountReview]','status'=>'Success','code'=>201]);
						}else{
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account Partner request can not Approved due to technical error [AccountReview]','status'=>'Error','code'=>400]);
						}
					}else{
						$UpdateAccountStatus = AptPdoUpdateWithAes(['Update'=>"Status::::Reject::,::StatusReason::::$Reason::,::UpdateTime::::$CurrentTime",'Condtion'=>"UserUrl::::$AccountUserUsrl",'DbCon'=>$PdoTopicsterMain,'TbName'=>'account','EPass'=>$EPass]);
						if($UpdateAccountStatus['code'] == 200){
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$AccountUserUsrl",'DbCon'=>$PdoTopicsterPartner,'DbName'=>DatabaseNamePrefix.'topicster_partner','DefaultCheckType'=>'ValLike']);
							$DeleteTable = AptPhpScriptDeleteTable(['Table'=>"$AccountUserUsrl",'DbCon'=>$PdoTopicsterUserActivity,'DbName'=>DatabaseNamePrefix.'topicster_user_activity','DefaultCheckType'=>'ValLike']);
							$DeletePartnerProfile = AptPhpScriptDirDelete(['Dir'=>PartnerDir.$AccountDtls['msg']->AccountName]);
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
								AptPrint(['msg'=>'Account Partner request Reject successfully [AccountReview]','status'=>'Success','code'=>200]);
						}else if($UpdateAccountStatus['code'] == 404){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account Partner request already Rejected [AccountReview]','status'=>'Success','code'=>201]);
						}else{
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Account Partner request can not Approved due to technical error [AccountReview]','status'=>'Error','code'=>400]);
						}
					}
				}
			}
			
			// Call classname public function 
			AccountReview::ValidateData($_POST);
		}else{
			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
			AptPrint(['msg'=>'Invalid Token! Please refresh page to regenerate Token [AccountReview]']);
		}
	}else{
		AptPrint(['msg'=>'Authentication failed [AccountReview]']);
		header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
	}
}else{
	AptPrint(['msg'=>'Invalid data sent [AccountReview]']);
	header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
}	
?>