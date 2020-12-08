<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/Library/SiteComponents/FrontAndBackEndControlPage/index.php");
	session_start();
	$Token_CSRF = md5(rand(1345694, 9893456));
	$RandomPass1 = md5(rand(13456, 9893456));
	$RandomPass2 = md5(rand(13456, 9893456));
	$RandomPass3 = md5(rand(13456, 9893456));
	$RandomPass4 = md5(rand(13456, 9893456));
	$RandomPass5 = md5(rand(13456, 9893456));
	$_SESSION['Token_CSRF'] = $Token_CSRF;
	$_SESSION['RandomPass1'] = $RandomPass1;
	$_SESSION['RandomPass2'] = $RandomPass2;
	$_SESSION['RandomPass3'] = $RandomPass3;
	$_SESSION['RandomPass4'] = $RandomPass4;
	$_SESSION['RandomPass5'] = $RandomPass5;

	define('DatabaseAccessCode', 'T@6Ug5t_u56t*P_B&B@Kl7U_v8N_xN7b_Z&B@Kl75t_u56@6Ug5t_u56t*P_B&Ap');
	$EPass = 'T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';

	/****************************** Database Connections *******************************/

	// DbCon -> ($PdoTopicsterMain)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_main.php");

	// DbCon -> ($PdoTopicsterPartner)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_partner.php");

	/******************************* Include requirement *******************************/
	require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoFetchWithAes/index.php");
	require_once (RootPath."Library/SiteComponents/IsLogin/index.php");
	
	if(defined('IsLoginSetting')){
		$IsLogin = IsLogin(['PdoTopicsterMain'=>$PdoTopicsterMain,'PdoTopicsterPartner'=>$PdoTopicsterPartner,'EPass'=>$EPass,'FetchDtls'=>IsLoginSetting['FetchDtls']]);
	}else{
		$IsLogin = IsLogin(['PdoTopicsterMain'=>$PdoTopicsterMain,'PdoTopicsterPartner'=>$PdoTopicsterPartner,'EPass'=>$EPass]);
	}
	require_once (RootPath."Library/Apt/Php/Script/AptFullScreenMsg/index.php");
?>