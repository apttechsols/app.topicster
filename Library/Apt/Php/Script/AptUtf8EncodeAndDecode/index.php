<?php
	/*
	*@filename AptSpecialCharacterEncode/index.php
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

	function AptUtf8Decode($str){
		$data = '';
		foreach (explode(';', $str) as $key1 => $value1) {
			$tmp = preg_replace("/[^0-9]/", '',$value1);
			if($tmp != '' ){
				$data .= chr($tmp);
			}
		}
		return $data;

	}

	function AptUtf8Encode($str) {
	    $str = mb_convert_encoding($str , 'UTF-32', 'UTF-8');
	    $t = unpack("N*", $str);
	    $t = array_map(function($n) { return "&#$n;"; }, $t);
	    return implode("", $t);
	}
?>