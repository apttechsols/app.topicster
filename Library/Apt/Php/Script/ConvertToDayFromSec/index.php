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
	function ConvertToDayFromSec($seconds){
		$dt1 = new DateTime("@0");
		$dt2 = new DateTime("@$seconds");
		return $dt1->diff($dt2)->format('%a Day : %h Hour : %i Min : %s sec');
	}
?>