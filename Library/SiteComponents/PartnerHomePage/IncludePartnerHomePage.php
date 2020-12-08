<?php
	error_reporting(0);
	// Get server port type (exampale - http:// or https://)
	if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) {
		$HeaderSecureType = "https://";
	}else{
		$HeaderSecureType = "http://";
	}
	// Create Domain name and save it in const variable
	define("DomainName",  $HeaderSecureType.$_SERVER['HTTP_HOST']);
	//require_once ($_SERVER['DOCUMENT_ROOT']."/Library/SiteComponents/PartnerHomePage/index.php");
?>
<?php foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal); ?>