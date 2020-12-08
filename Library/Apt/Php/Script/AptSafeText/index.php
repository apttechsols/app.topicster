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
	define('AptSafeTextDecodeEWords',array('$','=','(',')','[',']','*','/','<','>','~','!','@','^','-','_','+','|',':','.',',','`'));
	require_once (RootPath."Library/Apt/Php/Script/AptUtf8EncodeAndDecode/index.php");
	function AptSafeText($Data){
		foreach ($Data as $key => $value) {
			if($key != 'Str' && $key != 'EWords'){
				continue;
			}
			${$key} = $value;
		}
		if(!function_exists('AptUtf8Encode')){
			return ["status"=>"Error","msg"=>"Required function not found [AptSafeText]","code"=>400];
		}
  		$ExceptWords = $EWords;
		$data = '';
		foreach (str_split($Str) as $key => $value) {
			if(in_array($value, $ExceptWords)){
				$data .= AptUtf8Encode($value);
			}else{
				$data .= $value;
			}
		}
		return ["status"=>"Success","msg"=>$data,"code"=>200];
	}

	function AptSafeTextDecode($Data){
		foreach ($Data as $key => $value) {
			if($key != 'Str' && $key != 'EWords'){
				continue;
			}
			${$key} = $value;
		}
		if(!function_exists('AptUtf8Encode')){
			return ["status"=>"Error","msg"=>"Required function not found [AptSafeTextDecode]","code"=>400];
		}
  		$ExceptWords = $EWords;
		foreach ($ExceptWords as $key => $value) {
			$Str = str_replace(AptUtf8Encode($value), $value, $Str);
		}
		return ["status"=>"Success","msg"=>$Str,"code"=>200];
	}
?>