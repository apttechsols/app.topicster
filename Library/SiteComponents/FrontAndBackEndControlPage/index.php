<?php
	error_reporting(0);
	if(!defined('DomainName')){
		if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) {
			$HeaderSecureType = "https://";
		}else{
			$HeaderSecureType = "http://";
		}
		define("DomainName",  $HeaderSecureType.$_SERVER['HTTP_HOST']);
	}
	if(!defined('RootPath')){
		require_once ($_SERVER['DOCUMENT_ROOT']."Library/Apt/Php/AptPrint/index.php");
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		AptPrint(['msg'=>'Invalid Page Creation [Root]']); exit();
	}

	if($FileAccessCode != 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl' && FileAccessCode != 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl'){
		if(!defined('DomainName')){
			if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) {
				$HeaderSecureType = "https://";
			}else{
				$HeaderSecureType = "http://";
			}
			define("DomainName",  $HeaderSecureType.$_SERVER['HTTP_HOST']);
		}
		header("Location:".DomainName); exit();
	}
	define("HostedSiteName",  'topicster.live');
	define("HostedDomainName",  'topicster.live');
	define("DatabaseNamePrefix",  'topicst1_');
	define('PartnerDir',RootPath."Partner/");
	define('MainDir',RootPath."Main/");
	define('AptSafeTextDecodeEWords',array('$','=','(',')','[',']','*','/','<','>','~','!','@','^','-','_','+','|',':','.',',','`'));
	define('AptSafeTextDecodeEWordsAll',array('$','=','(',')','[',']','?','*','/','{','}','<','>','~','!','@','%','^','-','_','+','|',':','.',',','`'));
	define('AptSafeTextDecodeEWordsAllEncode',array('$','=','(',')','[',']','?','*','/','{','}','<','>','~','!','@','%','^','-','_','+','|',':','.',',','`'));
	require_once (RootPath."Library/Apt/Php/AptPrint/index.php");
	date_default_timezone_set('Asia/Kolkata');
?>