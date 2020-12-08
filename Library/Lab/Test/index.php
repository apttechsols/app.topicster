<?php
	// Not show any error
	#error_reporting(0);
	// Get server port type (exampale - http:// or https://)
	if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) {
		$HeaderSecureType = "https://";
	}else{
		$HeaderSecureType = "http://";
	}
	// Create Domain name and save it in const variable
	define("DomainName",  $HeaderSecureType.$_SERVER['HTTP_HOST']);
	define("RootPath", "../../../");
	define("HostedDomainName",  'localhost');
    define("DatabaseNamePrefix",  'topicst1_');
    define('AptSafeTextDecodeEWords',array('$','=','(',')','[',']','*','/','<','>','~','!','@','^','-','_','+','|',':','.',',','`'));
    define('AptSafeTextDecodeEWordsAll',array('$','=','(',')','[',']','?','*','/','{','}','<','>','~','!','@','%','^','-','_','+','|',':','.',',','`'));
    define('AptSafeTextDecodeEWordsAllEncode',array('$','=','(',')','[',']','?','*','/','{','}','<','>','~','!','@','%','^','-','_','+','|',':','.',',','`'));
	header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
	require_once (RootPath."Library/Apt/Php/AptPrint/index.php");
	AptPrint(['msg'=>'Authentication failed [Lab]']); exit();

	define('DatabaseAccessCode', 'T@6Ug5t_u56t*P_B&B@Kl7U_v8N_xN7b_Z&B@Kl75t_u56@6Ug5t_u56t*P_B&Ap');
	define('FileAccessCode', 'T@6B&Apu56t*P_N_xN5_u56@6U&B@K75tUg5t_u56t7b_Z&Bg*@Bt_P_l7U_v8Kl');
	$EPass = 'T@K2YeD*4s_4q-F5m&R6@Wp7Wu2Xw#_-qJ8c^?#h6v_hW-3uY3q%h&4N#hV8k@Ca';

	/****************************** Database Connections *******************************/

	// DbCon -> ($PdoTopicsterMain)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_main.php");

	// DbCon -> ($PdoTopicsterPartner)
	require_once (RootPath."Library/Database/SQL/Pdo/topicster_partner.php");


	/******************************  Apt Library *******************************/
	require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoFetchWithAes/index.php");
	require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoUpdateWithAes/index.php");
	require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoDeleteWithAes/index.php");
	require_once (RootPath."Library/Apt/Php/Pdo/Aes/AptPdoInsertWithAes/index.php");
	require_once (RootPath."Library/Apt/Php/Script/AptPhpScriptDirDelete/index.php");
	require_once (RootPath."Library/Apt/Php/Script/AptPhpScriptDeleteTable/index.php");
	require_once (RootPath."Library/Apt/Php/Script/EncodeAndEncrypt/AptEncodeAndEncryptWithAes.php");
	require_once (RootPath."Library/SiteComponents/IsLogin/index.php");
	$PdoTest = new PDO("mysql:host=localhost;dbname=Test",'topicste_Ap9919t','_L6sTh-FD2*hPpSjDeWSF5tMy-7D8ct:FfMSE@,-*VZ9EP_BvJSVe-4u*PhUJuWr');
	$PdoTest->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

	#$GetAvailablePlan = AptPdoFetchWithAes(['AcceptNullCondtion'=> true, 'FetchData'=>'Status::::AccountType::::AccountName', 'DbCon'=> $PdoTopicsterMain, 'TbName'=> 'account', 'EPass'=> $EPass,'FetchRowNo'=>'All']);
	#AptPrint(['msg'=>json_encode(AptEncodeAndEncryptWithAes::AptEncodeAndEncryptWithAesRun(['Task'=>'decrypt' ,'data'=>'sOpiToel28qF+pepv+PL9g==', 'key'=>$EPass,'padding'=>false]))]);

	//AptPrint(['msg'=>json_encode(IsLogin(['PdoTopicsterMain'=>$PdoTopicsterMain,'PdoTopicsterPartner'=>$PdoTopicsterPartner,'EPass'=>$EPass]))]);
	/*$name = $_POST['data'];
	echo json_encode( AptPdoInsertWithAes(['InsertData'=>"roll::::123::,::name::::".$name,'DbCon'=>$PdoTest,'TbName'=> 'st', 'EPass'=> $EPass]));

	$var = AptPdoFetchWithAes(['AcceptNullCondtion'=> true, 'FetchData'=>'name', 'DbCon'=> $PdoTest, 'TbName'=> 'st', 'EPass'=> $EPass]);

	echo $var;
	echo $var['msg']->name;
	echo gettype($var['msg']->name);*/


?>