<?php

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
if(isset($_POST['Decision']) && isset($_POST['DecisionReason']) && isset($_POST['Url']) && isset($_POST['Token_CSRF']) && isset($_POST['BrowserClientId1']) && isset($_POST['BrowserClientId2'])){
	
	// Verify data send from same page or not
	if($_SERVER['HTTP_REFERER'] === DomainName ."/Dashboard/Main/NewArticleRequest/NewArticleRequest.php?url=".$_POST['Url']){
		session_start();
		if($_POST['Token_CSRF'] === $_SESSION['Token_CSRF']){
			class NewArticleRequestBackend{
				public static function ValidateData($ValidateDataArray = array()){
					require_once (RootPath."Library/Apt/Php/Script/AptUtf8EncodeAndDecode/index.php");
					define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
					require_once (RootPath."Library/Apt/Php/Script/AptSafeText/index.php");

					foreach ($ValidateDataArray as $key => $value) {
						if($key != 'Decision' && $key != 'DecisionReason' && $key != 'Url' && $key != 'Token_CSRF' && $key != 'BrowserClientId1' && $key != 'BrowserClientId2'){
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

					if($Decision != 'Approve' && $Decision != 'Reject'){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid Decision Found [NewArticleRequestBackend]','status'=>'Error']); exit();
					}

					if($Decision == 'Reject'){
						if(strlen($DecisionReason) < 10){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Invalid DecisionReason Found [NewArticleRequestBackend]','status'=>'Error']); exit();
						}else if(preg_replace('/[^A-Za-z0-9 ]/', '', $DecisionReason) != $DecisionReason){
							foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
							AptPrint(['msg'=>'Invalid DecisionReason Found [NewArticleRequestBackend]','status'=>'Error']); exit();
						}
					}else{
						$DecisionReason = '';
					}

					if(strlen($Url) != 15 || $Url != preg_replace('/[^A-Za-z0-9]/', '', $Url)){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid Url detect [NewArticleRequestBackend]','status'=>'Error']); exit();
					}
					
					NewArticleRequestBackend::EncryptData($Decision,$DecisionReason,$Url,$BrowserClientId1,$BrowserClientId2);
				}
				private static function EncryptData($Decision,$DecisionReason,$Url,$BrowserClientId1,$BrowserClientId2){

					$EPass ='T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';

					NewArticleRequestBackend::CkeckLoginAndAuthenticate($Decision,$DecisionReason,$Url,$BrowserClientId1,$BrowserClientId2,$EPass);
				}

				private static function CkeckLoginAndAuthenticate($Decision,$DecisionReason,$Url,$BrowserClientId1,$BrowserClientId2,$EPass){

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

					// DbCon -> ($PdoTopicsterPostData)
					require_once (RootPath."Library/Database/SQL/Pdo/topicster_post_data.php");


					/******************************  Apt Library *******************************/
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoInsertWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoFetchWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoUpdateWithAes/index.php");
					require_once (RootPath."Library/Apt/Php/Script/EncodeAndEncrypt/AptEncodeAndEncryptWithAes.php");
					require_once (RootPath."Library/SiteComponents/IsLogin/index.php");
					
					# Is User NewArticleRequestBackend
					$IsLogin = IsLogin(['PdoTopicsterMain'=>$PdoTopicsterMain,'PdoTopicsterPartner'=>$PdoTopicsterPartner,'EPass'=>$EPass,'CheckType'=>'ClientAndServer','LClientId1'=>$BrowserClientId1,'LClientId2'=>$BrowserClientId2]);
					if($IsLogin['code'] != 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Client not logined [NewArticleRequestBackend]','status'=>'Error']); exit();
					}else if($IsLogin['LAS'] != 'Main'){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'You are not authenticat for write Article [NewArticleRequestBackend]','status'=>'Error']); exit();
					} 

					NewArticleRequestBackend::DoNewArticleRequestBackend($Decision,$DecisionReason,$Url,$EPass,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity,$PdoTopicsterPostData,$IsLogin);
				}

				private static function DoNewArticleRequestBackend($Decision,$DecisionReason,$Url,$EPass,$PdoTopicsterMain,$PdoTopicsterPartner,$PdoTopicsterUserActivity,$PdoTopicsterPostData,$IsLogin){
					date_default_timezone_set('Asia/Kolkata');
					$CurrentTime = time();

				  	// continue from here
				  	$result = AptPdoFetchWithAes(['Condtion'=> "Url::::$Url::,::Status::::UnderReview",'FetchData'=>'PublishTime', 'DbCon'=> $PdoTopicsterPostData,'TbName'=> 'post', 'EPass'=> $EPass]);

				  	if($result['code'] != 200){
				  		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['msg'=>'Invalid Url detect [NewArticleRequestBackend]','status'=>'Error']); exit();
				  	}

				  	if($Decision == 'Approve'){
				  		$Decision = 'Publish';
				  	}else{
				  		$Decision = 'Reject';
				  	}

				  	$UpdateData = "Status::::$Decision::,::UpdateTime::::$CurrentTime";
				  	if($result['msg']->PublishTime > $CurrentTime && $Decision == 'Publish'){
				  		#Continue
				  	}else{
				  		$UpdateData .= "::,::PublishTime::::$CurrentTime";
				  	}

				  	$Update = AptPdoUpdateWithAes(['Update'=>$UpdateData,'Condtion'=>"Status::::UnderReview::,::Url::::$Url",'DbCon'=>$PdoTopicsterPostData,'TbName'=>'post','EPass'=>$EPass]);
				  	
					if($Update['code'] === 200){
						foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
						AptPrint(['status'=>'Success','msg'=>'Post updated successfully','code'=>200]);
					}

					foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
					AptPrint(['msg'=>'Post can not updated due to technical error occur! Try again [NewArticleRequestBackend]']);
				}
			}

			NewArticleRequestBackend::ValidateData($_POST);
		}else{
			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
			AptPrint(['msg'=>'Invalid Token! Please refresh page to regenerate Token [NewArticleRequestBackend]']);
		}
	}else{
		AptPrint(['msg'=>'Authentication failed [NewArticleRequestBackend]']); exit();
		header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
	}
}else{
	AptPrint(['msg'=>'Invalid data sent [NewArticleRequestBackend]']); exit();
	header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
}	
?>  