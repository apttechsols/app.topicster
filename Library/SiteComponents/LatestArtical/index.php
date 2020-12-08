<?php 
/*
*@FileName LatestArticalBackend
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


// Verify data send from same page or not
if(str_replace('www.','',DomainName) === $HeaderSecureType.HostedDomainName){
	session_start();
	class LatestArtical{
		/*
		*@Method name - ValidateData
		*@Des - ValidateData all input data
		*/
		public static function ValidateData($ValidateDataArray = array()){
			LatestArtical::EncryptData();
		}
		private static function EncryptData(){
			$EPass ='T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';
			LatestArtical::CkeckLoginAndAuthenticate($EPass);
		}

		private static function CkeckLoginAndAuthenticate($EPass){
			/************************************* File Access Code ***********************************/
			define('DatabaseAccessCode', 'T@6Ug5t_u56t*P_B&B@Kl7U_v8N_xN7b_Z&B@Kl75t_u56@6Ug5t_u56t*P_B&Ap');
			define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
			
			/****************************** Database Connections *******************************/

			
			// DbCon -> ($PdoTopicsterPostData)
			require_once (RootPath."Library/Database/SQL/Pdo/topicster_post_data.php");
			// DbCon -> ($PdoTopicsterMain)
			require_once (RootPath."Library/Database/SQL/Pdo/topicster_main.php");

			require_once (RootPath."Library/Apt/Php/Script/AptSafeText/index.php");
			require_once (RootPath."Library/Apt/Php/Script/AptUtf8EncodeAndDecode/index.php");

			/******************************  Apt Library *******************************/
			require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoFetchWithAes/index.php");
			
			LatestArtical::DoLatestArtical($EPass,$PdoTopicsterPostData,$PdoTopicsterMain);
		}

		private static function DoLatestArtical($EPass,$PdoTopicsterPostData,$PdoTopicsterMain){
			date_default_timezone_set('Asia/Kolkata');
			$CurrentTime = time();

			$GetArticle = AptPdoFetchWithAes(['Condtion'=> "Status::::Publish",'FetchData'=>'Url::::Title::::ModTitle::::Author::::FUrl', 'DbCon'=> $PdoTopicsterPostData, 'TbName'=> 'post', 'EPass'=> $EPass,'FetchRowNo'=>'All','Limit'=>3,'DataOrder'=>'DESC|PublishTime']);
			if($GetArticle['code'] == 200){
				$LatestArticalDtls = array();
				$i=0;
				foreach ($GetArticle['msg'] as $key => $value) {
					$LatestArticalDtls[$i] = array();
					$LatestArticalDtls[$i]['Title'] = AptSafeTextDecode(['Str'=>$value->Title,'EWords'=>AptSafeTextDecodeEWords])['msg'];
					$LatestArticalDtls[$i]['href'] = DomainName."/Article/index.php?".$value->FUrl;
					$i++;
				}
				foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ if($SetVarKey != 'LatestArticalDtls'){ unset($$SetVarKey); }} unset($SetVarKey,$SetVarVal);
				AptPrint(['status'=>'Success','msg'=>$LatestArticalDtls,'code'=>200]); exit();
			}else if($GetArticle['code'] == 404){
				$LatestArticalDtls = array();
				$LatestArticalDtls[0] = array();
				$LatestArticalDtls[0]['Title'] = 'No Article Found';
				$LatestArticalDtls[0]['href'] = "#";
				foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ if($SetVarKey != 'LatestArticalDtls'){ unset($$SetVarKey); }} unset($SetVarKey,$SetVarVal);
				AptPrint(['status'=>'Success','msg'=>$LatestArticalDtls,'code'=>200]); exit();
			}else{
				foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
				AptPrint(['msg'=>'Article Not Fetched due to technical error']); exit();
			}
		}
	}
	
	// Call classname public function 
	LatestArtical::ValidateData($_POST);
}else{
	AptPrint(['msg'=>'Authentication failed [LatestArtical]']);
	header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
}	
?>